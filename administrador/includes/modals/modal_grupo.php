<!-- MODAL GRUPO-->


<div class="modal fade" id="modalGrupo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Grupo</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formGrupo" name="formGrupo">
        <input type="hidden" name="idgrupo" id="idgrupo" value="">
          <div class="form-group">
            <label for="control-label">Nombre del Grupo:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
          </div>
          
          <div class="form-group">
            <label for="listEstado">Estado</label>
            <select class="form-control" name="listEstado" id="listEstado">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
            </select>         
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id ="action">Guardar</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>