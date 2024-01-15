<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Fornecedores;

class Processo extends Model
{
    use HasFactory;

    protected $table ='processo';

    protected $fillable = [

        'numero',
        'valor',    
        
    ];

   
    public function Processo(){
        return $this->hasMany(Processo::class,'id_processo','id');
    }
}
	
