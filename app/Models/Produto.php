<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Produto extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $table = 'produtos';

    protected $fillable = [
        'id', 'nome', 'lote', 'valor', 'quantidade', 'descricao', 'categoria', 'fornecedor_id', 'venda_id'
    ];


    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class);
    }

    public function vendas() {
        return $this->belongsToMany(Venda::class,  'venda_produto', 'produto_id', 'venda_id')>withPivot(['quantidade', 'valor']);
    }
    
}
