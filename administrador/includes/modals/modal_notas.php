<!-- MODAL NOTAS-->


<div class="modal fade" id="modalNotas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nueva Nota</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formNotas" name="formNotas">

        <input type="hidden" name="idnotas" id="idnotas" value="">

        <input type="hidden" name="idcursante" id="idcursante" value="<?php echo $cursante; ?>">

        <input type="hidden" name="idcurso" id="idcurso" value="<?php echo $curso; ?>">


          <div class="form-group">
            <label for="listMateria">Seleccione la materia</label>
            <select class="form-control" name="listMateria" id="listMateria">
                <!-- CONTENIDO AJAX -->
            </select>         
          </div>
          
          <div class="form-group">
            <label for="listPeriodo">Seleccione el Periodo</label>
            <select class="form-control" name="listPeriodo" id="listPeriodo">
                <!-- CONTENIDO AJAX -->
            </select>         
          </div>

          <div class="form-group">
            <label for="listNota1">Nota Primer Lapso:</label>
            <select class="form-control" name="nota1" id="nota1">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
            </select>         
          </div>

          <div class="form-group">
            <label for="listNota2">Nota Segundo Lapso:</label>
            <select class="form-control" name="nota2" id="nota2">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
            </select>         
          </div>

          <div class="form-group">
            <label for="listNota3">Nota Tercer Lapso:</label>
            <select class="form-control" name="nota3" id="nota3">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
            </select>         
          </div>
          <div class="form-group">
            <label for="tipoNota">Tipo de Nota</label>
            <select class="form-control" name="estadonota" id="estadonota">
                <option value="2">NORMAL</option>
                <option value="1">REMEDIAL</option>
                <option value="4">REPITENTE</option>
                <option value="3">MATERIA PENDIENTE</option>
                <option value="0">EN OTRA INSTITUCIÓN</option>
            </select>         
          </div>
          <div class="form-group">
            <label for="momento_nota">Momento (solo en caso de ser materia pendiente)</label>
            <select class="form-control" name="momento_nota" id="momento_nota">
                <option value="1">Momento 1</option>
                <option value="2">Momento 2</option>
                <option value="3">Momento 3</option>
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