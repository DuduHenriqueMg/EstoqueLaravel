<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use \Exception;

class CrudController extends Controller
{

    protected $class, $route, $atributes, $titulos, $acao, $msg;

    //View principal
    public function index(Request $request, $msg = "") : Response
    {
        $msg = session()->get('mensagem');
        $data = $this->class->paginate($this->atributes, 5);

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

    //Mostra os dados de um registro
    public function show($id)
    {
        $relacao = $this->class->relacao;
        $data = $this->class->find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => "$relacao nao encontrado "
            ], 400);
        }

        return $data;
    }


    //Cria um novo registro no bd ou atualiza 
    public function store(Request $request)
    {   
        
        $relacao = $this->class->relacao;
        
        if ($request->id) {
            $data = $this->class->find($request->id);
            $data->fill($request->all());
            $data->save();
            return redirect()->route("$relacao.index")->with('mensagem', 'Registro atualizado com sucesso!');
        }else{
           
            $relacao = $this->class->relacao;
            $data = $this->class->fill($request->all());
            $this->class->save([$data]);
            return redirect()->route("$relacao.index")->with('mensagem', 'Registro inserido com sucesso!');
        }  
    }

    //Deleta um registro
    public function destroy($id)
    {
        $relacao = $this->class->relacao;
        $data = $this->class->find($id);

        if (!$data) {
            return redirect()->route("$relacao.index")->with('mensagem', "Não encontrado");
        }
        
        try {
            $data->delete();
            return redirect()->route("$relacao.index")->with('mensagem', "Excluído com sucesso");
        } catch (\Exception $e) {
            
            return redirect()->route("$relacao.index")->with('mensagem', "Não foi excluído");
        }


        // if ($data->delete()){
            
        //     return redirect()->route("$relacao.index")->with('mensagem', "Excluído com sucesso");
        // }else{

        //     return redirect()->route("$relacao.index")->with('mensagem', "Não foi excluído");
        // }

    }

    //View de inserir
    public function inserir($id=0) 
    {
        $data =[];
        if($id){
            $data = $this->class->find($id);
            $relacao = $this->class->relacao;
        }
        return Inertia::render($this->route.'/Store',[
                'item'=>$data]);
    }

}
