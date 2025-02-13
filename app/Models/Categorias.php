<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Categorias extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table ='categorias';

    protected $fillable = [ 'id','nome_categoria'];

    public function produtos()
     { 
        return $this->hasMany(Produto::class); 
     }
}
