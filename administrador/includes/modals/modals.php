<!-- MODAL USUARIOS-->


<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" name="formUsuario">
        <input type="hidden" name="idusuario" id="idusuario" value="">
          <div class="form-group" id="grupo__nombre">
            <label for="control-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="20" minlength="3" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
            

          </div>
          <div class="form-group" id="grupo__usuario">
            <label for="control-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario" maxlength="30" minlength="3" required>
          </div>
          
          <div class="form-group" id="grupo__contraseña">
            <label for="control-label">Contraseña <br>(Debe contener al menos un número y una letra mayúscula y minúscula, y un mínimo de 8 caracteres)</label>
            <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="clave" id="clave" maxlength="30" minlength="8" required>
          </div>
          
          
          <div class="form-group" id="grupo__rol">
            <label for="listRol">Rol</label>
            <select class="form-control" name="listRol" id="listRol">
                <option value="1">Administrador</option>
                <option value="2">Asistente</option>
                <?php if ($privilegios == 3) {?>
                  <option value="3">MaxiAdmin</option>
                <?php } ?>
            </select>  
            </div>
          <div class="form-group" id="grupo__estado">
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

