<?php




namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Affiche le formulaire de connexion admin
    public function showLoginForm()
    {
        return view('auth.login-admin'); // crée cette vue
    }

    // Gère la tentative de connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard'); // Assure-toi que cette route existe
        }

        return back()->withErrors([
            'email' => 'Les informations fournies sont incorrectes.',
        ]);
        
    }

    // Déconnexion de l'admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
