<?php
    require_once 'includes/header.php';
    
    require '../includes/conexion.php';

    //variables necesarias para el grafico
    $pA11 = 0;
    $pA12 = 0;
    $pA13 = 0;
    $pA14 = 0;
    $pA15 = 0;
    $pA16 = 0;
    $pA17 = 0;
    $pA18 = 0;

    $sA11 = 0;
    $sA12 = 0;
    $sA13 = 0;
    $sA14 = 0;
    $sA15 = 0;
    $sA16 = 0;
    $sA17 = 0;
    $sA18 = 0;

    $tA11 = 0;
    $tA12 = 0;
    $tA13 = 0;
    $tA14 = 0;
    $tA15 = 0;
    $tA16 = 0;
    $tA17 = 0;
    $tA18 = 0;

    $cA11 = 0;
    $cA12 = 0;
    $cA13 = 0;
    $cA14 = 0;
    $cA15 = 0;
    $cA16 = 0;
    $cA17 = 0;
    $cA18 = 0;

    $qA11 = 0;
    $qA12 = 0;
    $qA13 = 0;
    $qA14 = 0;
    $qA15 = 0;
    $qA16 = 0;
    $qA17 = 0;
    $qA18 = 0;


    //consulta de edades de alumnos de primer a quinto año
    $sql = "SELECT * FROM primer_año as tp INNER JOIN alumnos as al ON tp.alumno_id = al.alumno_id INNER JOIN periodos as pe ON tp.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND (statuspr = 1 OR statuspr = 2) ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();


    //Sumar en la edad correspondiente
    if ($row > 0) {
        while($separador = $query->fetch()) {
            $nacimientofe = date("Y-m-d", strtotime($separador['fecha_nac']));
            list ($ano, $mes, $dia) = explode("-",$nacimientofe);
    
                $anoDif = date("Y") - $ano;
                $mesDif = date("m") - $mes;
                $diaDif = date("d") - $dia;
                $edad = $anoDif;
                if ($mesDif < 0) {
                    $edad--;
                }elseif ($mesDif == 0 && $diaDif < 0) {
                    $edad--;
                }
                if ($edad == 11) {
                    $pA11++;
                }elseif ($edad == 12) {
                    $pA12++;
                }elseif ($edad == 13) {
                    $pA13++;
                }elseif ($edad == 14) {
                    $pA14++;
                }elseif ($edad == 15) {
                    $pA15++;
                }elseif ($edad == 16) {
                    $pA16++;
                }elseif ($edad == 17) {
                    $pA17++;
                }elseif ($edad < 11) {
                    $pA11++;
                }else {
                    $pA18++;
                }

            
        }
        
    }    

    $sql = "SELECT * FROM segundo_año as tp INNER JOIN alumnos as al ON tp.alumno_id = al.alumno_id INNER JOIN periodos as pe ON tp.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND (statussg = 1 OR statussg = 2) ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

    if ($row > 0) {
        while($separador = $query->fetch()) {
            $nacimientofe = date("Y-m-d", strtotime($separador['fecha_nac']));
            list ($ano, $mes, $dia) = explode("-",$nacimientofe);
    
                $anoDif = date("Y") - $ano;
                $mesDif = date("m") - $mes;
                $diaDif = date("d") - $dia;
                $edad = $anoDif;
                if ($mesDif < 0) {
                    $edad--;
                }elseif ($mesDif == 0 && $diaDif < 0) {
                    $edad--;
                }
                if ($edad == 11) {
                    $sA11++;
                }elseif ($edad == 12) {
                    $sA12++;
                }elseif ($edad == 13) {
                    $sA13++;
                }elseif ($edad == 14) {
                    $sA14++;
                }elseif ($edad == 15) {
                    $sA15++;
                }elseif ($edad == 16) {
                    $sA16++;
                }elseif ($edad == 17) {
                    $sA17++;
                }else {
                    $sA18++;
                }

            
        }
        
    }    

    $sql = "SELECT * FROM tercer_año as tp INNER JOIN alumnos as al ON tp.alumno_id = al.alumno_id INNER JOIN periodos as pe ON tp.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND (statustr = 1 OR statustr = 2) ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

    if ($row > 0) {
        while($separador = $query->fetch()) {
            $nacimientofe = date("Y-m-d", strtotime($separador['fecha_nac']));
            list ($ano, $mes, $dia) = explode("-",$nacimientofe);
    
                $anoDif = date("Y") - $ano;
                $mesDif = date("m") - $mes;
                $diaDif = date("d") - $dia;
                $edad = $anoDif;
                if ($mesDif < 0) {
                    $edad--;
                }elseif ($mesDif == 0 && $diaDif < 0) {
                    $edad--;
                }
                if ($edad == 11) {
                    $tA11++;
                }elseif ($edad == 12) {
                    $tA12++;
                }elseif ($edad == 13) {
                    $tA13++;
                }elseif ($edad == 14) {
                    $tA14++;
                }elseif ($edad == 15) {
                    $tA15++;
                }elseif ($edad == 16) {
                    $tA16++;
                }elseif ($edad == 17) {
                    $tA17++;
                }else {
                    $tA18++;
                }

            
        }
        
    }   
   
    $sql = "SELECT * FROM cuarto_año as tp INNER JOIN alumnos as al ON tp.alumno_id = al.alumno_id INNER JOIN periodos as pe ON tp.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND (statuscr = 1 OR statuscr = 2) ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

    if ($row > 0) {
        while($separador = $query->fetch()) {
            $nacimientofe = date("Y-m-d", strtotime($separador['fecha_nac']));
            list ($ano, $mes, $dia) = explode("-",$nacimientofe);
    
                $anoDif = date("Y") - $ano;
                $mesDif = date("m") - $mes;
                $diaDif = date("d") - $dia;
                $edad = $anoDif;
                if ($mesDif < 0) {
                    $edad--;
                }elseif ($mesDif == 0 && $diaDif < 0) {
                    $edad--;
                }
                if ($edad == 11) {
                    $cA11++;
                }elseif ($edad == 12) {
                    $cA12++;
                }elseif ($edad == 13) {
                    $cA13++;
                }elseif ($edad == 14) {
                    $cA14++;
                }elseif ($edad == 15) {
                    $cA15++;
                }elseif ($edad == 16) {
                    $cA16++;
                }elseif ($edad == 17) {
                    $cA17++;
                }else {
                    $cA18++;
                }

            
        }
        
    }  

    $sql = "SELECT * FROM quinto_año as tp INNER JOIN alumnos as al ON tp.alumno_id = al.alumno_id INNER JOIN periodos as pe ON tp.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND (statusqn = 1 OR statusqn = 2) ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();    

    if ($row > 0) {
        while($separador = $query->fetch()) {
            $nacimientofe = date("Y-m-d", strtotime($separador['fecha_nac']));
            list ($ano, $mes, $dia) = explode("-",$nacimientofe);
    
                $anoDif = date("Y") - $ano;
                $mesDif = date("m") - $mes;
                $diaDif = date("d") - $dia;
                $edad = $anoDif;
                if ($mesDif < 0) {
                    $edad--;
                }elseif ($mesDif == 0 && $diaDif < 0) {
                    $edad--;
                }
                if ($edad == 11) {
                    $qA11++;
                }elseif ($edad == 12) {
                    $qA12++;
                }elseif ($edad == 13) {
                    $qA13++;
                }elseif ($edad == 14) {
                    $qA14++;
                }elseif ($edad == 15) {
                    $qA15++;
                }elseif ($edad == 16) {
                    $qA16++;
                }elseif ($edad == 17) {
                    $qA17++;
                }else {
                    $qA18++;
                }

            
        }
        
    }  
?>

<main class="app-content">
  <div class="row">
      <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4 text-center">SISTEMA ESCOLAR - LICEO BOLIVARIANO EJIDO</h3>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>ESTADISTICAS GENERADAS</h4>
    </div>
  </div>

  <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
          <style type="text/css">
.highcharts-figure,
.highcharts-data-table table {
    min-width: 360px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
<script src="../Highcharts-10.3.2/code/highcharts.js"></script>
<script src="../Highcharts-10.3.2/code/modules/series-label.js"></script>
<script src="../Highcharts-10.3.2/code/modules/exporting.js"></script>
<script src="../Highcharts-10.3.2/code/modules/export-data.js"></script>
<script src="../Highcharts-10.3.2/code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>

</figure>





		<script type="text/javascript">
Highcharts.chart('container', {

    title: {
        text: 'Edades de los estudiantes del Liceo en Periodo Activo'
    },

    subtitle: {
        text: 'De Primero A Quinto Año'
    },

    yAxis: {
        title: {
            text: 'Cantidad de Estudiantes'
        }
    },

    xAxis: {
        accessibility: {
            rangeDescription: 'Range: 11 to 18'
        }
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 11
        }
    },

    series: [{
        name: 'Primer Año',
        data: [<?php echo $pA11.', '.$pA12.', '.$pA13.', '.$pA14.', '.$pA15.', '.$pA16.', '.$pA17.', '.$pA18; ?>]
    }, {
        name: 'Segundo Año',
        data: [<?php echo $sA11.', '.$sA12.', '.$sA13.', '.$sA14.', '.$sA15.', '.$sA16.', '.$sA17.', '.$sA18; ?>]
    }, {
        name: 'Tercer Año',
        data: [<?php echo $tA11.', '.$tA12.', '.$tA13.', '.$tA14.', '.$tA15.', '.$tA16.', '.$tA17.', '.$tA18; ?>]
    }, {
        name: 'Cuarto  Año',
        data: [<?php echo $cA11.', '.$cA12.', '.$cA13.', '.$cA14.', '.$cA15.', '.$cA16.', '.$cA17.', '.$cA18; ?>]
    }, {
        name: 'Quinto  Año',
        data: [<?php echo $qA11.', '.$qA12.', '.$qA13.', '.$qA14.', '.$qA15.', '.$qA16.', '.$qA17.', '.$qA18; ?>]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
		</script>
        </div>
          </div>
        </div>
      </div>
    

    
</main>
<script src="js/functions-grafica-genero.js"></script>

<?php
require_once 'includes/footer.php';

?>
