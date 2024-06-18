<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Funcionario extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $table = 'funcionarios';

    protected $fillable = [
        'id', 'nome', 'funcao', 'telefone', 'email', 'cpf', 'user_id'
    ];

 


    public function endereco() {
        return $this->belongsToMany(Endereco::class);
    }

    public function funcao() {
        return $this->belongsTo(Funcao::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }
    
}
