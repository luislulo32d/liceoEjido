<!-- MODAL ALUMNOS-->


<div class="modal fade" id="modalAlumno" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Alumno</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAlumno" name="formAlumno">
        <input type="hidden" name="idalumno" id="idalumno" value="">
          <div class="form-group">
            <label for="control-label">Apellidos:</label>
            <input type="text" class="form-control" name="apellido" id="apellido" maxlength="50" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
          </div>

          <div class="form-group">
            <label for="control-label">Nombres:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
          </div>

          <div class="form-group">
            <label for="control-label">Lugar de Nacimiento:</label>
            <input type="text" class="form-control" name="lugarNac" id="lugarNac" maxlength="50" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
          </div>

          <div class="form-group">
            <label for="control-label">Entidad Federal (2 letras):</label>
            <input type="text" class="form-control" name="entidadFederal" id="entidadFederal" maxlength="2" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
          </div>

          <div class="form-group">
            <label for="listNacionalidad">Nacionalidad</label>
            <select class="form-control" name="listNacionalidad" id="listNacionalidad">
                <option value="V-">VENEZOLANO</option>
                <option value="E-">EXTRANJERO</option>

            </select>
          </div>
          
          <div class="form-group">
            <label for="control-label">Cedula:</label>
            <input type="number" class="form-control" name="cedulaes" id="cedulaes">
          </div>

          <div class="form-group">
            <label for="listSexo">Sexo: </label>
              <select class="form-control" name="listSexo" id="listSexo">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>       
          </div>

          <div class="form-group">
            <label for="control-label">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" name="fecha_nac" id="fecha_nac">
          </div>

          <div class="form-group">
            <label for="listEstado">Estado</label>
            <select class="form-control" name="listEstado" id="listEstado">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
                <option value="3">Graduado</option>

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