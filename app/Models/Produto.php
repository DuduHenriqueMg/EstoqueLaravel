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
        'id', 'lote', 'valor', 'quantidade', 'descricao', 'categoria', 'fornecedor_id'
    ];


    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class);
    }

    public function funcao() {
        return $this->belongsTo(Funcao::class);
    }
    
}
