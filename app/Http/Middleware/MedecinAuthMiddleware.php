<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class MedecinAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // ✅ Liste des routes accessibles sans authentification
        $routesPubliques = [
            'client/login',
            'client/register',
            'client/password/reset',
            'client/password/email',
            'medecin/register',
            'login/docteur',
            'logout/docteur',
            'login',
            'register',
            'password/reset',
            'password/email',
        ];

        // ✅ Autoriser l'accès aux routes publiques sans authentification
        if (in_array($request->path(), $routesPubliques)) {
            return $next($request);
        }

        // ✅ Vérifier si l'utilisateur est un médecin connecté
        if (!Auth::guard('medecin')->check()) {
            // Protection contre trop de tentatives de connexion
            $this->ensureIsNotRateLimited($request);

            return redirect()->route('medecin.login')->with('error', 'Vous devez être connecté en tant que médecin.');
        }

        // ✅ Si l'utilisateur est déjà connecté en tant que médecin, le rediriger vers son espace
        if ($request->routeIs('medecin.login')) {
            return redirect()->route('medecins.accueil');
        }

        // ✅ Réinitialiser le compteur si authentifié
        RateLimiter::clear($this->throttleKey($request));

        return $next($request);
    }

    /**
     * Vérifie si l'utilisateur a dépassé le nombre de tentatives autorisées.
     */
    protected function ensureIsNotRateLimited(Request $request)
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Génère une clé unique pour limiter les tentatives de connexion.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email', '')) . '|' . $request->ip();
    }
}
