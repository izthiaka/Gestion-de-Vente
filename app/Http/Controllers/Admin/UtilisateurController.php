<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UtilisateurController extends Controller
{

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $users = User::paginate(10);

        if($request->ajax()){
            $query = $request->recherche;
            $users = User::join('roles', 'users.role_id', 'roles.id')
                ->where('name', 'like', '%'.$query.'%')
                ->orWhere('login', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%')
                ->orWhere('numero_telephone', 'like', '%'.$query.'%')
                ->orWhere('roles.nom_role', 'like', '%'.$query.'%')
                ->select('users.*')
                ->paginate(10);
            return view('admin.users.liste-users', compact('users'))->render();
        }
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function statut($id)
    {
        $user_statut = User::find($id);

        if($user_statut != null)
        {
            $user_statut->is_active = !$user_statut->is_active;

            $user_statut->save();

            if($user_statut->is_active == 1)
            {
                Session::flash('success', 'l\'utilisateur a été activé avec succès');
            }
            elseif($user_statut->is_active == 0){
                Session::flash('success', 'l\'utilisateur a été désactivé avec succès');
            }
            return redirect()->route('admin.user-list');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'numero_telephone' => 'required|unique:users,numero_telephone',
            'email' => 'required|unique:users,email',
            'login' => 'required|unique:users,login',
            'role_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'numero_telephone' => $request->numero_telephone,
            'login' => $request->login,
            'role_id' => $request->role_id,
            'password' => Hash::make(123456),
            'photo_profil' => 'https://ui-avatars.com/api/?name='.$request['prenom'].'+'.$request['nom'],
            'is_active' => true,
        ]);

        if($request->hasFile('photo_profil')){
            $photo = $request->photo_profil;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/users/', $image_new_name);
            $user->photo_profil = '/storage/users/'.$image_new_name;
        }

        if($user != null)
        {
            Session::flash('success', 'l\'utilisateur a été crée avec succès');
            $user->save();
            return redirect()->route('admin.user-list');
        }
        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.users.edit',compact('roles', 'user'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            'numero_telephone' => "required|unique:users,numero_telephone, $user->id",
            'email' => "required|unique:users,email, $user->id",
            'login' => "required|unique:users,login, $user->id",
            'role_id' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->numero_telephone = $request->numero_telephone;
        $user->login = $request->login;
        $user->role_id = $request->role_id;

        if($request->hasFile('photo_profil')){
            $photo = $request->photo_profil;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/users/', $image_new_name);
            $user->photo_profil = '/storage/users/'.$image_new_name;
        }

        if($user != null)
        {
            Session::flash('success', 'l\'utilisateur a été modifié avec succès');
            $user->save();
            return redirect()->route('admin.user-list');
        }
        return redirect()->back();
    }
}
