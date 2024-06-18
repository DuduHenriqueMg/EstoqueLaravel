<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\AbstractPaginator as Paginator;

abstract class BaseRepository
{
    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass;
    public $relacao = "";

    public function find($id)
    {
        return $this->modelClass->find($id);
    }

    public function count()
    {
        return $this->modelClass::count();
    }

    public function select($data)
    {
//        dd($data);
        return $this->modelClass->select($data);
    }

    public function where($data)
    {
        //return($data);
        return $this->modelClass->where($data)->get();
    }


    public function paginate($data, $qtd, $filtros = null)
    {
        return $this->modelClass::select($data)->orderBy('id', 'asc')->paginate($qtd);
    }

    public function create($data)
    {
        return $this->modelClass->create($data);
    }

    public function save($data)
    {
        return $this->modelClass->save($data);
    }

    public function fill($data)
    {
        return $this->modelClass->fill($data);
    }

    public function all($del=0)
    {
        if($del)
            return $this->modelClass::withTrashed()->get();
        return $this->modelClass::all();
    }

    public function filter($atributes)
    {
        return $this->modelClass::select($atributes)->get();
    }

    public function restore($id)
    {
        if($id)
            return $this->modelClass::withTrashed()->find($id)->restore();
        return 'nao encontrado';
    }

    public function findOne($r){
        $aux = $this->modelClass::find($r);
        return $aux;
    }

    public function filtro($filtros){
        $filtros = explode(';', $filtros);
        foreach($filtros as $key => $condicao) {
            $c = explode(':', $condicao);
            return $this->modelClass->where($c[0], $c[1], $c[2]);
        }

    }

}
