<!-- MODAL PROFESORES-->


<div class="modal fade" id="modalProfesor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Profesor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProfesor" name="formProfesor">
        <input type="hidden" name="idprofesor" id="idprofesor" value="">
        <div class="form-group">
            <label for="control-label">Apellidos:</label>
            <input type="text" class="form-control" name="apellido" id="apellido" maxlength="50" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
          </div>
          <div class="form-group">
            <label for="control-label">Nombres:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
          </div>
          <div class="form-group">
            <label for="control-label">Cedula:</label>
            <input type="number" class="form-control" name="cedula" id="cedula">
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