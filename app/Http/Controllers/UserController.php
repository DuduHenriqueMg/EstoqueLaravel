<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;

class UserController extends CrudController
{

    public function __construct(UserRepository $class, RoleRepository $roles)
    {   
        $this->class = $class;
        $this->route = 'user';
        $this->atributes = ['users.id', 'name', 'email', 'roles.role_name', 'role_id'];
        $this->roles = $roles->all();
        $this->acao = ['editar', 'apagar'];
               
    }

    public function index(Request $request, $msg="") : Response
    
    {
        $data = $this->class->select($this->atributes);

        return Inertia::render('User/UserIndex', 
                                [   
                                    'canCreateUsers' => Auth::user()->can('create', $this->class->modelClass),
                                    'canDeleteUsers' => Auth::user()->can('destroy', $this->class->modelClass),
                                    'users'=> $data,
                                    'acao' => $this->acao,
                                    'msg' => $msg,
                                    'roles'=> $this->roles,
                                ]);
    }
    

    public function create() : Response
    {   
       
        $this->authorize('create', $this->class->modelClass);

        return Inertia::render('User/UserForm', 
                                [   
                                    'roles'=> $this->roles,
                                    
                                ]);
  
    }

    public function destroy($id)
    {   
        $this->authorize('destroy', $this->class->modelClass);

        if (auth()->user()->id == $id) {
            return $this->index("Usuário logado");
        }
        
        $relacao = $this->class->relacao;
        $data = $this->class->find($id);

        if (!$data) {
            return $this->index("$relacao NÃO FOI ENCONTRADO");
        }

        if ($data->delete()){
            //return redirect()->route( $relacao.'.index');
            return $this->index("$relacao FOI EXCLUÍDO");
        }
        else{
            redirect()->back();
            return $this->index("$relacao NÃO FOI EXCLUÍDO");
        }   
    }
  
    public function obterRole(Request $r){
        return $this->class->findOneRole($r->id);
    }

    

}
