<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Profiles\StoreRequest;
use App\Http\Requests\Profiles\UpdateRequest;
use App\Models\Profile;

class ProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = new Profile();
        $listProfiles = $profiles->paginate(15);

        return view('profiles.index', compact('listProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Profiles\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $profile = new Profile();
            $profile->setName($request->get('name'));
            $profile->setDescription($request->get('description'));
            $profile->setCreatedAt(new \DateTime());
            $profile->setUpdatedAt(new \DateTime());
            $profile->save();

            return redirect('/perfis')
                ->with('success', 'Registro criado com sucesso!');
        } catch (\Exception $ex) {
            return redirect('/perfil/novo')
                ->with('error', 'Não foi possível criar o registro!' . $ex->getMessage())
                ->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profiles = new Profile();
        $profile = $profiles->find($id);

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Profiles\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $profiles = new Profile();
            $profile = $profiles->find($request->input('id'));
            $profile->setName($request->get('name'));
            $profile->setDescription($request->get('description'));
            $profile->setUpdatedAt(new \DateTime());
            $profile->save();

            return redirect('/perfis')
                ->with('success', 'Registro alterado com sucesso!');
        } catch (\Exception $ex) {
            return redirect('/perfil/editar/' . $request->input('id'))
                ->with('error', 'Não foi possível alterar o registro!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $profiles = new Profile();
            $profile = $profiles->find($request->input('id'));
            $profile->delete();

            return redirect('/perfis')
                ->with('success', 'Registro excluído com sucesso!');
        } catch (\Exception $ex) {
            return redirect('/perfis')
                ->with('error', 'Não foi possível excluir o registro, pois este perfil tem vínculo com algum usuário!');
        }
    }
}
