<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;
use Maatwebsite\Excel\Facades\Excel;




class ClienteController extends CrudController
{

    public function __construct(ClienteRepository $class, EnderecoRepository $endereco)
    {   
        $this->class = $class;
        $this->route = 'Funcionario';
        $this->atributes = ['id', 'nome', 'funcao', 'telefone', 'email', 'cpf'];
        $this->titulos = [ 'id', 'Nome', 'Função', 'Telefone', 'Email', 'CPF'];
        $this->acao = ['detalhe'];
       
              
    }

    public function index(Request $request, $msg = null) : Response
    {   
        $msg = session()->get('mensagem');
        $data = $this->class->paginate($this->atributes, 10);
        
   
        return Inertia::render($this->route.'/Index',
                                [  
                                    'itens'=>$data,
                                    'titulos'=>$this->titulos,
                                    'atributes'=>$this->atributes,
                                    'acao'=>$this->acao,
                                    'rota'=>$this->route,
                                    
                                    'msg'=>$msg
                                    
                                ]);
    }




}
