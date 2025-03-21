<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use OwenIt\Auditing\Contracts\Auditable;

class Processo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table ='processo';    

    protected $fillable = [

        'numero',
        'valor',    
        'descricao',
        'item',
       'quantidade',
        'id_fornecedor',
        'numero_of',
    ];

   
    public function Processo(){
        return $this->hasMany(Processo::class)->withDefault();
    }

    public function Fornecedores(){
        return $this->belongsTo(Fornecedores::class,'id_fornecedor','id')->withDefault([
            'nome_fantasia' => 'Fornecedor excluído']);
}

}
