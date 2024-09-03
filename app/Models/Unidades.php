<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\PedidosController;
class Unidades extends Model
{
    use HasFactory;

    protected $table ='unidades';

    protected $fillable = [ 
        'nome',	      
      ];
      public function Unidades(){
        return $this->hasOne(unidades::class,'id_unidades','id');
    }
}
