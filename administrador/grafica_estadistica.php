<?php
    require_once 'includes/header.php';
    
    require '../includes/conexion.php';

    //Consulta Femeninas de primero a quinto año
    $sql = "SELECT * FROM primer_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statuspr = 1 AND al.sexo = 'F'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $primerofem = $query->rowCount();

    $sql = "SELECT * FROM segundo_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statussg = 1 AND al.sexo = 'F'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $segundofem = $query->rowCount();

    $sql = "SELECT * FROM tercer_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statustr = 1 AND al.sexo = 'F'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $tercerofem = $query->rowCount();

    $sql = "SELECT * FROM cuarto_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statuscr = 1 AND al.sexo = 'F'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $cuartofem = $query->rowCount();

    $sql = "SELECT * FROM quinto_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statusqn = 1 AND al.sexo = 'F'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $quintofem = $query->rowCount();

    //Consulta Masculinos de primero a quinto año
    $sql = "SELECT * FROM primer_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statuspr = 1 AND al.sexo = 'M'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $primeromas = $query->rowCount();

    $sql = "SELECT * FROM segundo_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statussg = 1 AND al.sexo = 'M'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $segundomas = $query->rowCount();

    $sql = "SELECT * FROM tercer_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statustr = 1 AND al.sexo = 'M'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $terceromas = $query->rowCount();

    $sql = "SELECT * FROM cuarto_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statuscr = 1 AND al.sexo = 'M'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $cuartomas = $query->rowCount();
    
    $sql = "SELECT * FROM quinto_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statusqn = 1 AND al.sexo = 'M'  ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $quintomas = $query->rowCount();
    

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
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
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
	</head>
	<body>
<script src="../Highcharts-10.3.2/code/highcharts.js"></script>
<script src="../Highcharts-10.3.2/code/modules/exporting.js"></script>
<script src="../Highcharts-10.3.2/code/modules/export-data.js"></script>
<script src="../Highcharts-10.3.2/code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    
</figure>



		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Cantidad de estudiantes Masculinos y Femeninos del Liceo Del Periodo Activo'
    },
    subtitle: {
        text: 'De Primero A Quinto Año'
    },
    xAxis: {
        categories: [
            'Primer Año',
            'Segundo Año',
            'Tercer Año',
            'Cuarto Año',
            'Quinto Año',
            'Total'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Cantidad de Alumnos'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Femenino',
        data: [
                <?php echo $primerofem;?>, 
                <?php echo $segundofem;?>,
                <?php echo $tercerofem;?>,
                <?php echo $cuartofem;?>,
                <?php echo $quintofem;?>,
                <?php echo $primerofem+$segundofem+$tercerofem+$cuartofem+$quintofem?>
            ]

    }, {
        name: 'Masculino',
        data: [
                <?php echo $primeromas;?>,
                <?php echo $segundomas;?>,
                <?php echo $terceromas;?>,
                <?php echo $cuartomas;?>,
                <?php echo $quintomas;?>,
                <?php echo $primeromas+$segundomas+$terceromas+$cuartomas+$quintomas;?>
            ]

    },{
        name: 'Total',
        data: [
                <?php echo $primerofem+$primeromas;?>,
                <?php echo $segundofem+$segundomas;?>,
                <?php echo $tercerofem+$terceromas;?>,
                <?php echo $cuartofem+$cuartomas;?>,
                <?php echo $quintofem+$quintomas;?>,
                <?php echo $primerofem+$primeromas+$segundofem+$segundomas+$tercerofem+$terceromas+$cuartofem+$cuartomas+$quintofem+$quintomas;?>]
    }]
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
