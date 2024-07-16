<div class="modal fade" id="show-{{$rs->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Todos os detalhes do material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              
                
            <label class="control-label mb-1" >Nome</label>
            <input type="text" class= "form-control"  name="nome" id="nome" value="{{$rs->nome}}" readonly >  
            <label class="control-label mb-1" >Data de Vencimento</label>
            <input type="date" class= "form-control"  name="vencimento" id="vencimento" value="{{$rs->vencimento}}"readonly >  
            
            <label class="control-label mb-1">Quantidade</label>
            <input type="number" step="0.01"  class= "form-control" name="quant_total" id="quant_total"  value="{{$rs->quant_total}}" readonly  >
            <label class="control-label mb-1">Local de recebimento</label>    
            <input type="text"  class= "form-control"   name="local" id="local"  value="{{$rs->local}}"  readonly > 
       
            <label class="control-label mb-1">Estoque minimo</label>
            <input type="number" step="0.01"   class= "form-control" name="estoque_min"   id="estoque_min"  value="{{$rs->estoque_min}}" readonly >
            
            <label class="control-label mb-1">Estoque ideal</label>
            <input type="number" step="0.01"   class= "form-control" name="estoque_ideal" id="estoque_ideal"  value="{{$rs->estoque_ideal}}" readonly >
                    
            <label class="control-label mb-1">Valor saida</label>
            <input type="number" step="0.01"   class= "form-control" name="valor_saida"  id="valor_saida"  value="{{$rs->valor_saida}}" readonly >
            <label class="control-label mb-1">Código de barras</label>
            <input type="text"   class= "form-control" name="codigobarras"  id="codigobarras"  value="{{$rs->codigobarras}}" readonly>
             
            <label class="control-label mb-1">Foto</label><br>
            <a href="{{ asset ($rs->foto) }}" data-fancybox   data-caption="{{$rs->nome}}"><img src="{{ asset($rs->foto) }}" style="width: 100px; height: 100px;" alt="img"/></a><br>               
            <label class="control-label mb-1">Observação</label>
            <textarea  class= "form-control" name="observacao" id="observacao" readonly >{{$rs->observacao}}</textarea>
            
    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              
            </div>     
                   

     