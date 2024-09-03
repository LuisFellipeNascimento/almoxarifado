<div class="modal fade" id="mediumModal-{{$rs->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Confirmação de exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
               
                  <p>  Tem certeza que deseja apagar o item <strong> {{$rs->descricao}}</strong> do  processo<strong> {{$rs->codigo_pedido}}</strong>  ?</p>
                   <p>  Essa operação não poderá ser desfeita. </p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('unidades.destroy', $rs->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary" type="submit">Apagar</button>

                </form>