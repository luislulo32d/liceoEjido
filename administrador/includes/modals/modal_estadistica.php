<!-- MODAL ESTADISTICA-->

<div class="modal fade" id="modalEstadistica" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Registro Estadistico</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEstadistica" name="formEstadistica">

        <input type="hidden" name="estadistica_id" id="estadistica_id" value="">

        
        <div class="form-group">
            <label for="e_1">Primer Año</label>
            <div name="e_1" id="e_1"> <!-- CONTENIDO AJAX --> </div>
                
          </div>
          
          <div class="form-group">
            <label for="e_2">Segundo Año</label>
            <div name="e_2" id="e_2"> <!-- CONTENIDO AJAX --> </div>
                
          </div>

          <div class="form-group">
            <label for="e_3">Tercer Año</label>
            <div name="e_3" id="e_3"> <!-- CONTENIDO AJAX --> </div>
                
          </div>
          
          <div class="form-group">
            <label for="e_4">Cuarto Año</label>
            <div name="e_4" id="e_4"> <!-- CONTENIDO AJAX --> </div>
                
          </div>

          <div class="form-group">
            <label for="e_5">Quinto Año</label>
            <div name="e_5" id="e_5"> <!-- CONTENIDO AJAX --> </div>
                
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