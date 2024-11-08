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
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     //funcao para redirecionar para users.edit

     public function edit($id): View
     {
        Gate::authorize('admin', Auth::user());
         $user = User::findOrFail($id);
         return view('users.edit', compact('user'));
     }

     //edit especifo para o user autenticado

     public function editProfile(Request $request): View
    {
        Gate::authorize('admin', Auth::user());
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function updateUser(Request $request, User $user)
    {
        Gate::authorize('admin', Auth::user());
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'document' => 'required|numeric|digits:11|unique:users,document,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->document = $request->document;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function index(Request $request): View
    {
        Gate::authorize('admin', Auth::user());

        $query = $request->input('query');
        $showTrashed = $request->has('trashed');

        $usersQuery = $showTrashed ? User::onlyTrashed() : User::whereNull('deleted_at');

        if ($query) {
            $usersQuery->where(function($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('email', 'LIKE', '%' . $query . '%');
            });
        }

        $users = $usersQuery->get();
        $trashedCount = User::onlyTrashed()->count();

        return view('users.index', compact('users', 'showTrashed', 'trashedCount'));
    }

    public function restore($id): RedirectResponse
    {
         Gate::authorize('admin', Auth::user());
        // Restaura o usuário deletado
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')->with('success', 'Usuário reativado com sucesso!');
    }

    public function create(): View
    {
        Gate::authorize('admin', Auth::user());
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('admin', Auth::user());
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|confirmed',
            'document' => 'required|numeric|digits:11|unique:users,document',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->document = $request->document; // Salvando o documento
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
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
        Gate::authorize('admin', Auth::user());

        if (Auth::id() == $id) {
            return redirect()->route('users.index')->with('error', 'Você não pode excluir sua própria conta!');
        }

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
