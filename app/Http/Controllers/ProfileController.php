<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     //funcao para redirecionar para users.edit

     public function edit($id): View
     {
         $user = User::findOrFail($id);
         return view('users.edit', compact('user'));
     }

     //edit especifo para o user autenticado

     public function editProfile(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'document' => 'required|numeric|digits:11|unique:users,document,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->document = $request->document;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function index(Request $request): View
    {
        if ($request->has('trashed')) {
            $users = User::onlyTrashed()->get();
            $showTrashed = true;
        } else {
            $users = User::whereNull('deleted_at')->get();
            $showTrashed = false;
        }
    
        // Verifica se há usuários desativados
        $trashedCount = User::onlyTrashed()->count();
    
        return view('users.index', compact('users', 'showTrashed', 'trashedCount'));
    }
    
    public function restore($id): RedirectResponse
    {
        // Restaura o usuário deletado
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')->with('success', 'Usuário reativado com sucesso!');
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'document' => 'required|numeric|digits:11|unique:users,document',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->document = $request->document; // Salvando o documento
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function destroyUser($id): RedirectResponse
    {
        // Verifica se o usuário autenticado está tentando excluir a própria conta
        if (Auth::id() == $id) {
            return redirect()->route('users.index')->with('error', 'Você não pode excluir sua própria conta!');
        }

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
