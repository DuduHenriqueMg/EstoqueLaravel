<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Fornecedor extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $table = 'fornecedores';

    protected $fillable = [
        'id', 'nome_fantasia', 'cnpj'
    ];



    public function produto() {
        return $this->hasMany(Produto::class);
    }

    public function endereco() {
        return $this->belongsToMany(Endereco::class);
    }
}
