<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Endereco extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $table = 'enderecos';

    protected $fillable = [
        'id', 'cidade', 'numero', 'uf', 'cep'
    ];



    public function funcionario() {
        return $this->belongsToMany(Funcionario::class);
    }

    public function fornecedor() {
        return $this->belongsToMany(Fornecedor::class);
    }

    public function cliente() {
        return $this->belongsToMany(Cliente::class);
    }
}
