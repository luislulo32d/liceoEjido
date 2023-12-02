<!-- MODAL MATERIA-->


<div class="modal fade" id="modalMateria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nueva Materia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formMateria" name="formMateria">
        <input type="hidden" name="idmateria" id="idmateria" value="">
          <div class="form-group">
            <label for="control-label">Nombre de la materia:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
          </div>
          <div class="form-group">
            <label for="control-label">Siglas de la materia:</label>
            <input type="text" class="form-control" name="siglas" id="siglas" maxlength="3" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
          </div>
          <div class="form-group">
            <label for="listAño">Año de la Materia</label>
            <select class="form-control" name="listAño" id="listAño">
                <option value="1">Primer Año</option>
                <option value="2">Segundo Año</option>
                <option value="3">Tercer Año</option>
                <option value="4">Cuarto Año</option>
                <option value="5">Quinto Año</option>
            </select>         
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