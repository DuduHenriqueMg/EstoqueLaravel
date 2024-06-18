<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cliente extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $table = 'clientes';

    protected $fillable = [
        'id', 'nome', 'emal', 'orgao_origem', 'cpf', 'telefone'
    ];



    public function endereco() {
        return $this->belongsToMany(Endereco::class);
    }

    public function funcao() {
        return $this->belongsTo(Funcao::class);
    }
    
}
