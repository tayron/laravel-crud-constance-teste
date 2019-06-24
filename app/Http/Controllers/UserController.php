<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;

use App\Models\User;
use App\Models\Profile;
use App\Http\Traits\PhotoManipulation;

class UserController extends Controller
{
    use PhotoManipulation;

    public function __construct()
    {
        $this->setUploadPath('upload/img/users');
        $this->setListExtensionAllowed(['png', 'jpg', 'jpeg']);
        $this->setFileWidth('250');
        $this->setFileHeight('250');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = new User();
        $listUsers = $users->paginate(15);

        return view('users.index', compact('listUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $listUsers = $user->all();
        $profile = new Profile();
        $listProfiles = $profile->all();

        if (!$listProfiles->count()) {
            $message = 'Não há nenhum Perfil de Usuário cadastrado, '
                . 'para se criar usuário, cadastre um perfil antes.';

            return redirect('/perfil/novo')->with('error', $message);
        }

        return view('users.create', compact('listUsers', 'listProfiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Users\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $photoName = null;

        try {
            $photoName = $this->executeUploadPhoto($request);

            $user = new User();
            $user->profile_id = $request->get('profile_id');
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->birthdate = \DateTime::createFromFormat('d/m/Y', $request->get('birthdate'));
            $user->occupation = $request->get('occupation');
            $user->salary = $this->formatSalaryToDatabase($request->get('salary'));
            $user->photo = $photoName;
            $user->created_at = new \DateTime();
            $user->updated_at = new \DateTime();
            $user->save();

            return redirect('/usuarios')
                ->with('success', 'Registro criado com sucesso!');
        } catch (\Exception $ex) {
            if ($photoName) {
                $this->removePhoto($photoName);
            }
            return redirect('/usuario/novo')
                ->with('error', 'Não foi possível criar o registro!')
                ->withInput($request->input());
        }
    }

    private function formatSalaryToDatabase($price)
    {
        return str_replace(['.', ','], ['', '.'], $price);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = new User();
        $user = $users->find($id);
        $profile = new Profile();
        $listProfiles = $profile->all();

        return view('users.edit', compact('user', 'listProfiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Users\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        $namePhotoFile = null;

        try {
            $namePhotoFile = $request->get('name_photo_old');

            if ($request->hasFile('photo')) {
                $namePhotoFile = $this->executeUploadPhoto($request);

                $this->removePhoto($request->get('name_photo_old'));
            }

            $users = new User();
            $user = $users->find($request->input('id'));
            $user->profile_id = $request->get('profile_id');
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->birthdate = \DateTime::createFromFormat('d/m/Y', $request->get('birthdate'));
            $user->occupation = $request->get('occupation');
            $user->salary = $this->formatSalaryToDatabase($request->get('salary'));
            $user->photo = $namePhotoFile;
            $user->updated_at = new \DateTime();
            $user->save();

            return redirect('/usuarios')
                ->with('success', 'Registro alterado com sucesso!');
        } catch (\Exception $ex) {
            if ($namePhotoFile) {
                $this->removePhoto($namePhotoFile);
            }
            return redirect('/usuario/editar/' . $request->input('id'))
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
            $users = new User();
            $user = $users->find($request->input('id'));
            $photoName = $user->photo;
            $user->delete();

            if ($photoName) {
                $this->removePhoto($photoName);
            }

            return redirect('/usuarios')
                ->with('success', 'Registro excluído com sucesso!');
        } catch (\Exception $ex) {
            return redirect('/usuarios')
                ->with('error', 'Não foi possível excluir o registro!');
        }
    }
}
