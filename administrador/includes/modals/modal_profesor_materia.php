<!-- MODAL PROFESOR MATERIA-->


<div class="modal fade" id="modalProfesorMateria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Registro Profesor-Materia</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProfesorMateria" name="formProfesorMateria">

        <input type="hidden" name="idprofesormateria" id="idprofesormateria" value="">

        <div class="form-group">
            <label for="listProfesor">Seleccione el Profesor</label>
            <select class="form-control" name="listProfesor" id="listProfesor">
                <!-- CONTENIDO AJAX -->
            </select>         
          </div>


          <div class="form-group">
            <label for="listAula">Seleccione el Aula</label>
            <select class="form-control" name="listAula" id="listAula">
                <!-- CONTENIDO AJAX -->
            </select>         
          </div>

          <div class="form-group">
            <label for="listMateriaProfesor">Seleccione la materia</label>
            <select class="form-control" name="listMateriaProfesor" id="listMateriaProfesor">
                <!-- CONTENIDO AJAX -->
            </select>         
          </div>
         
          <div class="form-group">
            <label for="listEvaluaciones">Cantidad de evaluaciones</label>
            <select class="form-control" name="listEvaluaciones" id="listEvaluaciones">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
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