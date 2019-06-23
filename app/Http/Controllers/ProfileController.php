<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Profile;


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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->executeDataValidateOnStore($request);
        
        try{                    
            $profile = new Profile();
            
            $profile->name = $request->get('name');
            $profile->description = $request->get('description');
            $profile->created_at = new \DateTime();
            $profile->updated_at = new \DateTime();
            $profile->save();
        
            return redirect('/perfis')
                ->with('success', 'Registro criado com sucesso!');            
            
        } catch (\Exception $ex) {
            return redirect('/perfil/novo')
                ->with('error', 'Não foi possível criar o registro!')
                ->withInput($request->input());
        }
    }
    
    private function executeDataValidateOnStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:profiles|max:255',
            'description' => 'required|max:255'
        ], [
            'name.required' => 'O campo Nome do Perfil não pode ser vazio',
            'name.unique' => 'O Nome do Perfil já existe cadastrado no sistema',
            'name.max' => 'O Nome do Perfil não pode ter mais de 255 caracteres',
            'description.required' => 'O campo Descrição do Perfil não pode ser vazio',
            'description.max' => 'O Nome do Descrição não pode ter mais de 255 caracteres',            
        ]);        
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->executeDataValidateOnUpdate($request);
        
        try{
            $profiles = new Profile();
            $profile = $profiles->find($request->input('id'));            
            $profile->name = $request->get('name');
            $profile->description = $request->get('description'); 
            $profile->updated_at = new \DateTime();
            $profile->save();
        
            return redirect('/perfis')
                ->with('success', 'Registro alterado com sucesso!');            
            
        } catch (\Exception $ex) {
            return redirect('/perfil/editar/' . $request->input('id'))
                ->with('error', 'Não foi possível alterar o registro!');
        }
    }
    
    private function executeDataValidateOnUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:profiles|max:255',
            'description' => 'required|max:255'
        ], [
            'name.required' => 'O campo Nome do Perfil não pode ser vazio',
            'name.max' => 'O Nome do Perfil não pode ter mais de 255 caracteres',
            'description.required' => 'O campo Descrição do Perfil não pode ser vazio',
            'description.max' => 'A Descrição do Perfil não pode ter mais de 255 caracteres',            
        ]);         
    }        
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
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
