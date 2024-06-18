<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Venda extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $table = 'vendas';

    protected $fillable = [
        'id', 'data', 'valor', 'funcionario_id', 'cliente_id'
    ];


    
    public function getValorTotalAttribute()
    {
        return $this->produtos->sum(function ($produto) {
            return $produto->pivot->quantidade * $produto->pivot->preco;
        });
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function funcionario() {
        return $this->belongsTo(Funcionario::class);
    }
    
}
