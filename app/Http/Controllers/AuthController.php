<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
public function login(LoginRequest $req)
{
    $data = $req->validated();
    $user = User::firstWhere('email', $data['email']);
    if (!$user) {
        return back()->withErrors([
            "compte" => "Ce compte n'existe pas,create account"
        ])->withInput();
    }

    if (!Hash::check($data['password'], $user->password)) {
        return back()->withErrors([
            "password" => "Mot de passe incorrect"
        ])->withInput($req->only('email'));
    }

    Auth::login($user);
    $req->session()->regenerate();

    session([
        'role'    => $user->role,
        'nom'    => $user->nom,
        'user_id' => $user->id,
    ]);



    return redirect()->route('index');
}
  
public function logout()
{
        Auth::logout();
        return to_route('index');
}
public function create(){
    return view('auth.register');
}
public function register(Request $req)
{
    $validated = $req->validate([
        'nom' => 'required|string|max:50',
        'prenom' => 'required|string|max:50',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role' => 'required|in:client',
    ], [
        'nom.required' => 'Le nom est obligatoire',
        'prenom.required' => 'Le prenom est obligatoire',
        'email.required' => 'L\'email est obligatoire',
        'email.email' => 'L\'email n\'est pas valide',
        'email.unique' => 'Cet email est déjà utilisé',
        'password.required' => 'Le mot de passe est obligatoire',
        'password.min' => 'Le mot de passe doit contenir au moins 6 caractères',
        'password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
        'role.required' => 'Le rôle est obligatoire',
        'role.in' => 'Le rôle doit être client',
    ]);

    User::create([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'email' => $validated['email'],
        'role' => 'client',
        'password' => Hash::make($validated['password']),
    ]);
    
    return redirect()->route('showLogin')
        ->with('success', 'Account created successfully');
}
public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $user = User::firstwhere('email', $request->email);

    if (!$user) {
        return back()->with('error', 'Email introuvable');
    }

    $token = bin2hex(random_bytes(32));

    DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => now()
    ]);
    $link = url("/reset-password/$token");

    Mail::raw("Clique ici pour réinitialiser votre mot de passe: $link", function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Réinitialisation du mot de passe');
    });

    return back()->with('success', 'Email envoyé');
}

}
