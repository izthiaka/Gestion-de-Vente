<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $clients = Client::where('agent_id', Auth::user()->id)->paginate(10);
        return view('agent.clients.index', compact('clients'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store_client(Request $request)
    {
        $this->validate($request, [
            'prenom_nom' => 'required',
            'telephone' => 'required',
        ]);

        Client::create([
            'prenom_nom' => $request->prenom_nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'agent_id' => Auth::user()->id,
        ]);

        Session::flash('success', 'le client a été crée avec succès');
        return redirect()->route('agent.client-list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update_client(Request $request, $id)
    {
        $client = Client::find($id);
        $this->validate($request, [
            'prenom_nom' => 'required',
            'telephone' => 'required',
        ]);

        $client->prenom_nom = $request->prenom_nom;
        $client->telephone = $request->telephone;
        $client->adresse = $request->adresse;
        $client->save();

        Session::flash('success', 'le client a été modifié avec succès');
        return redirect()->route('agent.client-list');
    }

    /**
     * Show the password change form for new logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function profil()
    {
        $profile = Auth::user();
        return view('agent.profil', compact('profile'));
    }

    /**
     *
     * Update the user auth profile
     */

    public function update_profile(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'login' => "required|unique:users,login, $user->id",
            'email' => "required|email|unique:users,email, $user->id",
            'numero_telephone' => "required|unique:users,numero_telephone, $user->id",
        ]);

        $user->name = $request->name;
        $user->login = $request->login;
        $user->email = $request->email;
        $user->numero_telephone = $request->numero_telephone;

        if($request->hasFile('photo_profil')){
            $photo = $request->photo_profil;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/users/', $image_new_name);
            $user->photo_profil = '/storage/users/'.$image_new_name;
        }

        $user->save();
        Session::flash('success', 'votre profil a été modifié avec succès');

        return redirect()->to(route('agent.profil'));
    }

    public function update_password(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nouveau_mot_de_passe' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.profil').'#settings')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = Auth::user();
        if(Hash::check($request->nouveau_mot_de_passe, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();

            Session::flash('success', 'Le mot de passe a été mis à jour');
            return redirect()->to(route('admin.profil').'#settings');
        } else{
            Session::flash('warning', 'L\'ancien mot de passe ne correspond pas');
            return redirect()->to(route('agent.profil').'#settings');
        }
    }
}
