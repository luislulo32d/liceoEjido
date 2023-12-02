<?php

require '../../../includes/conexion.php';
$sql = "SELECT * FROM tercer_año as tp INNER JOIN alumnos as al ON tp.alumno_id = al.alumno_id INNER JOIN periodos as pe ON tp.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND (statustr = 1 OR statustr = 2) ORDER BY aula_id";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();

$contarLetras = 64;
$seccionAnterior = 1;
$seccionActual = 1;
$textoFinal = "";



$m11 = 0;
$f11 = 0;

$m12 = 0;
$f12 = 0;

$m13 = 0;
$f13 = 0;

$m14 = 0;
$f14 = 0;

$m15 = 0;
$f15 = 0;

$m16 = 0;
$f16 = 0;

$m17 = 0;
$f17 = 0;

$m18 = 0;
$f18 = 0;


if ($row > 0) {
    while($separador = $query->fetch()) {
        
        $seccionActual = $separador['aula_id'];        
        if ($seccionAnterior != $seccionActual) {
            $seccionAnterior = $seccionActual;
            $contarLetras++;
            $nombreSeccion = chr($contarLetras);

            $textoFinal = $textoFinal.'!'.$nombreSeccion.'_11m'.$m11.'f'.$f11.';12m'.$m12.'f'.$f12.';13m'.$m13.'f'.$f13.';14m'.$m14.'f'.$f14.';15m'.$m15.'f'.$f15.';16m'.$m16.'f'.$f16.';17m'.$m17.'f'.$f17.';18m'.$m18.'f'.$f18;

            $m11 = 0;
            $f11 = 0;

            $m12 = 0;
            $f12 = 0;

            $m13 = 0;
            $f13 = 0;

            $m14 = 0;
            $f14 = 0;

            $m15 = 0;
            $f15 = 0;

            $m16 = 0;
            $f16 = 0;

            $m17 = 0;
            $f17 = 0;

            $m18 = 0;
            $f18 = 0;
            

            
          }
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
            if ($separador['sexo'] == 'M') {
                $m11++;
            }if ($separador['sexo'] == 'F') {
                $f12++;
            }
        }elseif ($edad == 12) {
            if ($separador['sexo'] == 'M') {
                $m12++;
            }if ($separador['sexo'] == 'F') {
                $f12++;
            }
        }elseif ($edad == 13) {
            if ($separador['sexo'] == 'M') {
                $m13++;
            }if ($separador['sexo'] == 'F') {
                $f13++;
            }
        }elseif ($edad == 14) {
            if ($separador['sexo'] == 'M') {
                $m14++;
            }if ($separador['sexo'] == 'F') {
                $f14++;
            }
        }elseif ($edad == 15) {
            if ($separador['sexo'] == 'M') {
                $m15++;
            }if ($separador['sexo'] == 'F') {
                $f15++;
            }
        }elseif ($edad == 16) {
            if ($separador['sexo'] == 'M') {
                $m16++;
            }if ($separador['sexo'] == 'F') {
                $f16++;
            }
        }elseif ($edad == 17) {
            if ($separador['sexo'] == 'M') {
                $m17++;
            }if ($separador['sexo'] == 'F') {
                $f17++;
            }
        }elseif ($edad == 18) {
            if ($separador['sexo'] == 'M') {
                $m18++;
            }if ($separador['sexo'] == 'F') {
                $f18++;
            }
        }
        


    }
    $contarLetras++;
    $nombreSeccion = chr($contarLetras);

    $textoFinal = $textoFinal.'!'.$nombreSeccion.'_11m'.$m11.'f'.$f11.';12m'.$m12.'f'.$f12.';13m'.$m13.'f'.$f13.';14m'.$m14.'f'.$f14.';15m'.$m15.'f'.$f15.';16m'.$m16.'f'.$f16.';17m'.$m17.'f'.$f17.';18m'.$m18.'f'.$f18;

}
$data = '<input type="text" class="form-control" value="'.$textoFinal.'" readonly>';
echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>