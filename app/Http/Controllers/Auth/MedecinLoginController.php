<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedecinLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-medecin'); // Créez cette vue
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Utilisation du guard 'medecin'
    if (Auth::guard('medecin')->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        
        // Redirigez vers le tableau de bord du médecin ou la page dédiée
        return redirect()->route('medecins.dashboard');
    }

    return back()->withErrors([
        'email' => 'Les informations fournies ne correspondent pas à nos enregistrements.',
    ]);
}

protected function authenticated(Request $request, $user)
{
    return redirect()->route('medecins.dashboard'); // Assurez-vous que cette route existe
}

    public function logout(Request $request)
    {
        Auth::guard('medecin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
