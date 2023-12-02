<!-- MODAL PERIODO-->


<div class="modal fade" id="modalPeriodo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Periodo</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPeriodo" name="formPeriodo">
        <input type="hidden" name="idperiodo" id="idperiodo" value="">
        <div class="form-group">
            <label for="listPeriodoInicial">Periodo Inicial</label>
            <select class="form-control" name="nombre" id="nombre">
                <option value="2016-2017">2016-2017</option>
                <option value="2017-2018">2017-2018</option>
                <option value="2018-2019">2018-2019</option>
                <option value="2019-2020">2019-2020</option>
                <option value="2020-2021">2020-2021</option>
                <option value="2021-2022">2021-2022</option>
                <option value="2022-2023">2022-2023</option>
                <option value="2023-2024">2023-2024</option>
                <option value="2024-2025">2024-2025</option>
                <option value="2025-2026">2025-2026</option>
                <option value="2026-2027">2026-2027</option>
                <option value="2027-2028">2027-2028</option>
                <option value="2028-2029">2028-2029</option>
                <option value="2029-2030">2029-2030</option>
                <option value="2030-2031">2030-2031</option>
                <option value="2031-2032">2031-2032</option>
                <option value="2032-2033">2032-2033</option>
                <option value="2033-2034">2033-2034</option>
                <option value="2034-2035">2034-2035</option>
                <option value="2035-2036">2035-2036</option>
                <option value="2036-2037">2036-2037</option>
                <option value="2037-2038">2037-2038</option>
                <option value="2038-2039">2038-2039</option>
                <option value="2039-2040">2039-2040</option>
                <option value="2040-2041">2040-2041</option>
                <option value="2041-2042">2041-2042</option>
                <option value="2042-2043">2042-2043</option>
                <option value="2043-2044">2043-2044</option>
                <option value="2044-2045">2044-2045</option>
                <option value="2045-2046">2045-2046</option>
                <option value="2046-2047">2046-2047</option>
                <option value="2047-2048">2047-2048</option>
                <option value="2048-2049">2048-2049</option>
                <option value="2049-2050">2049-2050</option>
                <option value="2050-2051">2050-2051</option>
                <option value="2051-2052">2051-2052</option>
                <option value="2052-2053">2052-2053</option>
                <option value="2053-2054">2053-2054</option>
                <option value="2054-2055">2054-2055</option>
                <option value="2054-2055">2055-2056</option>
                <option value="2054-2055">2056-2057</option>
                <option value="2054-2055">2057-2058</option>
                <option value="2054-2055">2058-2059</option>
                <option value="2054-2055">2059-2060</option>
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