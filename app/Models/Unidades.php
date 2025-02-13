<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\PedidosController;
use OwenIt\Auditing\Contracts\Auditable;

class Unidades extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table ='unidades';

    protected $fillable = [ 
        'nome_unidade',	      
      ];
      public function Unidades(){
        return $this->hasOne(unidades::class,'id_unidades','id');
    }
}
