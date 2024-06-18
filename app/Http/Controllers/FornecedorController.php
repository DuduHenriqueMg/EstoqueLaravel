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
use App\Repositories\FornecedorRepository;
use App\Repositories\EnderecoRepository;


class FornecedorController extends CrudController
{

    public function __construct(FornecedorRepository $class, EnderecoRepository $endereco)
    {   
        $this->class = $class;
        $this->route = 'Fornecedores';
        $this->atributes = ['id', 'nome_fantasia', 'cnpj'];
        $this->titulos = [ 'id', 'Nome Fantasia', 'CNPJ'];
        $this->acao = ['detalhe', 'editar', 'apagar'];
        $this->enderecos = $endereco->all();
        
    }

    public function index(Request $request, $msg = null) : Response
    {   
        $msg = session()->get('mensagem');
        $data = $this->class->paginate($this->atributes, 10);
       
        if ($request->hasAny(['busca'])) { 
            $data = $this->class->paginate($this->atributes, 10, $request->collect())->withQueryString();    
              
            if (!$data->items()) {
                $msg = "Nada encontrado";
            }
        }

        return Inertia::render($this->route.'/Index',
                                [  
                                    'itens'=>$data,
                                    'titulos'=>$this->titulos,
                                    'atributes'=>$this->atributes,
                                    'acao'=>$this->acao,
                                    'rota'=>$this->route,
                                    'enderecos'=>$this->enderecos,
                                    'msg'=>$msg
                                    
                                ]);
    }


    
}
