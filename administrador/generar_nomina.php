<?php 
        require_once '../includes/conexion.php';
        require_once '../vendor/autoload.php';


        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\IOFactory;

        //establecer parametros de la tabla excel

        $el_año_seleccion = $_POST['el_año_seleccion'];
        $la_seccion_seleccion = $_POST['listAula'];
        $periodo_seleccion = $_POST['listPeriodo'];
        $notasTipo = $_POST['tipoNota'];
        $notasTipo = $notasTipo + 1;
        $notasTipo = $notasTipo - 1;
        $siglas_seleccion = $_POST['siglas_seleccion'];
        $numeroDeMaterias = strlen($siglas_seleccion);
        $numeroDeMaterias = $numeroDeMaterias / 3;
        $fecha = date("n");
        $fechaAño = date("Y");

        if ($fecha == 1) {
            $fecha = "Enero";
        }elseif ($fecha == 2) {
            $fecha = "Febrero";
        }elseif ($fecha == 3) {
            $fecha = "Marzo";
        }elseif ($fecha == 4) {
            $fecha = "Abril";
        }elseif ($fecha == 5) {
            $fecha = "Mayo";
        }elseif ($fecha == 6) {
            $fecha = "Junio";
        }elseif ($fecha == 7) {
            $fecha = "Julio";
        }elseif ($fecha == 8) {
            $fecha = "Agosto";
        }elseif ($fecha == 9) {
            $fecha = "Septiembre";
        }elseif ($fecha == 10) {
            $fecha = "Octubre";
        }elseif ($fecha == 11) {
            $fecha = "Noviembre";
        }elseif ($fecha == 12) {
            $fecha = "Diciembre";
        }


        if ($el_año_seleccion == 1) {
            $tablaAño = "primer_año";
            $estadoAño = "statuspr";
            $nombreTabla = "1ero";
        }elseif ($el_año_seleccion == 2) {
            $tablaAño = "segundo_año";
            $estadoAño = "statussg";
            $nombreTabla = "2do";

        }elseif ($el_año_seleccion == 3) {
            $tablaAño = "tercer_año";
            $estadoAño = "statustr";
            $nombreTabla = "3ro";

        }elseif ($el_año_seleccion == 4) {
            $tablaAño = "cuarto_año";
            $estadoAño = "statuscr";
            $nombreTabla = "4to";

        }elseif ($el_año_seleccion == 5) {
            $tablaAño = "quinto_año";
            $estadoAño = "statusqn";
            $nombreTabla = "5to";

        }else {
            $tablaAño = "quinto_año";
            $estadoAño = "statusqn";
            $nombreTabla = "5to";

        }
        
        
        if($notasTipo == 1){
            $nombre_notas = "REMEDIAL";
            $comparativoEstadoAño = "ta.$estadoAño = 3";
            $nombreTabla = "R ".$fecha." (".$nombreTabla.")";
            $posibleRemedial = 0;

        }elseif ($notasTipo == 2) {
            $nombre_notas = "NORMAL";
            $comparativoEstadoAño = "(ta.$estadoAño = 1 OR ta.$estadoAño = 2)";
            $nombreTabla = "N ".$fecha." (".$nombreTabla.")";
            $posibleRemedial = 1;

        }else {
            $nombre_notas = "MATERIA PENDIENTE";
            $comparativoEstadoAño = "ta.$estadoAño = 4";
            $nombreTabla = "PEN ".$fecha."(".$nombreTabla.")";
            $posibleRemedial = 2;

        }
        

        $sql = "SELECT * FROM notas as nt INNER JOIN alumnos as al ON nt.alumno_id = al.alumno_id INNER JOIN $tablaAño as ta ON nt.alumno_id = ta.alumno_id INNER JOIN materias as mt ON nt.materia_id = mt.materia_id INNER JOIN grupos as gp ON ta.grupo_id = gp.grupo_id INNER JOIN periodos as pe ON nt.periodo_id = pe.periodo_id  WHERE mt.año_seleccion = $el_año_seleccion AND $comparativoEstadoAño AND ta.aula_id = $la_seccion_seleccion AND nt.periodo_id = $periodo_seleccion ORDER BY nt.alumno_id, nt.materia_id";
        $query = $pdo->prepare($sql);
        $query->execute();
        $row = $query->rowCount();


        $excel = new Spreadsheet();
        $hojaActiva = $excel->getActiveSheet();
        $hojaActiva->setTitle("".$nombreTabla."");
        $filaNumero = 0;

        
        $periodoActivo = $fechaAño;
        $nombresMaterias = "MA";
        $fechaNota = "XXXX";
        $añoNota = "XXXX";
        $ini=65;
        $i = 0;

        //bordes de la tabla
            
            $borders = [
                'borders' => [
                'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000'],
                ],
                ],
            ];
            
            $hojaActiva->setCellValue('A1', '                                                                       ');
        
        //anchura de cada celda de la tabla
        $hojaActiva->getColumnDimension('A')->setWidth(3);
        $hojaActiva->getColumnDimension('B')->setWidth(18);
        $hojaActiva->getColumnDimension('C')->setWidth(23);
        $hojaActiva->getColumnDimension('D')->setWidth(23);
        $hojaActiva->getColumnDimension('E')->setWidth(20);
        $hojaActiva->getColumnDimension('F')->setWidth(4);
        $hojaActiva->getColumnDimension('G')->setWidth(5);
        $hojaActiva->getColumnDimension('H')->setWidth(7);
        $hojaActiva->getColumnDimension('I')->setWidth(7);
        $hojaActiva->getColumnDimension('J')->setWidth(7);
        $i=$ini + 10;
            //materias
            if ($numeroDeMaterias > 0) {
                $maximaterias= $numeroDeMaterias + $ini + 10;
                for ($i=$i; $i < $maximaterias ; $i++) { 
                    $columnaLetra = chr($i);
                    $hojaActiva->getColumnDimension(''.$columnaLetra.'')->setWidth(6);
                    
                }
            }else {
                $i++;
            }
        $columnaLetra = chr($i);
        $hojaActiva->getColumnDimension(''.$columnaLetra.'')->setWidth(80);
        
        
        //Identificacion del liceo
            //linea 1
            $filaNumero++;
            $i = $ini;
            $filaNumeroz = $filaNumero + 4;
            
            
                $iz = $i + 7;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '  ');
                $i=$iz;
                $i++;
                
                $iz = $i + 9;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'RESUMEN FINAL DEL RENDIMIENTO ESTUDIANTIL');
                $filaNumero++;

                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Código del formato:  ');
                $filaNumero++;

                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'I. Año Escolar: '.$periodoActivo.'');
                $filaNumero++;

                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Tipo de Evaluación: '.$nombre_notas.'');
                $i = $iz + 1;
                $iz = $i +5;
                
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Mes y Año: '.$fecha.' '.$fechaAño.'');

        //Datos del Liceo
            $filaNumero++;
            $i = $ini;
                
                $iz = $i + 1;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'II. Datos del Plantel: ');
                

                $filaNumero++;
                $iz++;
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Código del Plantel: ');
                $i = $iz + 1;
                $iz = $i +1;
                
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nombre: LICEO BOLIVARIANO EJIDO');


                $filaNumero++;
                $i = $ini;
                $iz = $i + 4;
                
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Dirección: ');

                $i = $iz + 1;
                $iz = $i + 4;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'TELÉFONO: ');


                $filaNumero++;
                $i = $ini;
                $iz = $i + 2;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');

                $i = $iz + 1;
                $iz = $i + 1;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ENTIDAD FEDERAL:  MERIDA');

                $i = $iz + 1;
                $iz = $i + 4;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Zona Educativa: ');


                $filaNumero++;
                $i = $ini;
                $iz = $i + 4;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Director(a):  ');

                $i = $iz + 1;
                $iz = $i + 4;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Cédula de Identidad:  ');

        //cabecera de la tabla
            //linea 1
            $filaNumero++;
            $i = $ini;
                
                $iz = $i + $numeroDeMaterias;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'III. identificación');
                $i=$iz + 1;

                 
                $iz = $i + 9;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'IV. Resumen Final de Rendimiento');
                $i=$iz + 1;

            //linea 2
            $filaNumero++;
            $i = $ini;
            $filaNumeroz = $filaNumero+5;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nº');
                $i++;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Cédula de Identidad'); //agregar salto de linea despues de "de "
                $i++;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Apellidos');
                $i++;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nombres');
                $i++;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Lugar de Nacimiento');
                $i++;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'EF');
                $i++;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'SEXO');

                //A partir de aquí se dividen las casillas en 2 partes
                $fila1de2 = $filaNumero + 2;
                $fila2de2 = $fila1de2 + 3;
                $i++;


                $iz = $i + 2;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($iz);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$fila1de2.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$fila1de2.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$fila1de2.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'FECHA DE NACIMIENTO');
                $fila1de2++;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$fila1de2.':'.$columnaLetra.''.$fila2de2.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$fila1de2.':'.$columnaLetra.''.$fila2de2.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$fila1de2.':'.$columnaLetra.''.$fila2de2.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$fila1de2.'', 'DIA');
                $i++;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$fila1de2.':'.$columnaLetra.''.$fila2de2.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$fila1de2.':'.$columnaLetra.''.$fila2de2.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$fila1de2.':'.$columnaLetra.''.$fila2de2.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$fila1de2.'', 'MES');
                $i++;

                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$fila1de2.':'.$columnaLetra.''.$fila2de2.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$fila1de2.':'.$columnaLetra.''.$fila2de2.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$fila1de2.':'.$columnaLetra.''.$fila2de2.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$fila1de2.'', 'AÑO');
                
                //A partir de aquí se dividen las casillas en 4 partes
                $fila1de4 = $filaNumero + 1;
                $fila2de4 = $fila1de4 + 2;
                $fila3de4 = $fila2de4 + 2;
                $i++;
                
                $iz = $i + $numeroDeMaterias - 1;
                if ($iz > $i) {
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$fila1de4.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$fila1de4.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$fila1de4.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ÁREAS DE FORMACIÓN');
                    $fila1de4++;

                    $hojaActiva->mergeCells(''.$columnaLetra.''.$fila1de4.':'.$columnaLetra2.''.$fila2de4.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$fila1de4.':'.$columnaLetra2.''.$fila2de4.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$fila1de4.':'.$columnaLetra2.''.$fila2de4.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$fila1de4.'', 'ÁREA COMÚN');
                    $fila2de4++;
                    $contador = 0;
                    //materias
                    for ($materiaz=$i; $materiaz <= $iz; $materiaz++) { 
                        $columnaLetra = chr($materiaz);
                        //siglas
                        $calculo = $contador * 3;
                        $nombresMaterias=substr($siglas_seleccion, $calculo, 3);
                        $hojaActiva->mergeCells(''.$columnaLetra.''.$fila3de4.':'.$columnaLetra.''.$fila3de4.'');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$fila3de4.':'.$columnaLetra.''.$fila3de4.'')->applyFromArray($borders);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$fila3de4.':'.$columnaLetra.''.$fila3de4.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaActiva->setCellValue(''.$columnaLetra.''.$fila3de4.'', ''.$nombresMaterias.'');
                        
                        
                        //numeros
                        $contador++;
                        $hojaActiva->mergeCells(''.$columnaLetra.''.$fila2de4.':'.$columnaLetra.''.$fila2de4.'');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$fila2de4.':'.$columnaLetra.''.$fila2de4.'')->applyFromArray($borders);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$fila2de4.':'.$columnaLetra.''.$fila2de4.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaActiva->setCellValue(''.$columnaLetra.''.$fila2de4.'', ''.$contador.'');
                    }    
                    
                    $i = $materiaz;
                    $fila2de4 = $fila2de4 - 1;

                }
                //ultima columna del cabecero
               
                $columnaLetra = chr($i);
                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$fila2de4.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$fila2de4.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$fila2de4.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'PARTICIPACIÓN EN GRUPOS DE CREACIÓN, RECREACIÓN Y PRODUCCIÓN'); //agregar saltos de linea
                $fila2de4++;

                $hojaActiva->mergeCells(''.$columnaLetra.''.$fila2de4.':'.$columnaLetra.''.$fila3de4.'');
                $hojaActiva->getStyle(''.$columnaLetra.''.$fila2de4.':'.$columnaLetra.''.$fila3de4.'')->applyFromArray($borders);
                $hojaActiva->getStyle(''.$columnaLetra.''.$fila2de4.':'.$columnaLetra.''.$fila3de4.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaActiva->setCellValue(''.$columnaLetra.''.$fila2de4.'', 'GRUPO');
                
                $columnaGr = $i;

        //cuerpo de la tabla
                
            if ($row > 0) {
                    $empiezaMateria = 75;
                    $conMateria = 0;
                    $ini=65;
                    $contador = 0;
                    $filaNumero=$fila3de4;
                    $conNuevoAlumno = 0;
                    $conAntiguoAlumno = 0;
                    
                        while($data = $query->fetch()) {
                               $i=$ini;
                        
                           
                                
                                $conNuevoAlumno = $data['alumno_id'];

                                //para poder imprimir solo una vez por alumno su información
                                if ($conNuevoAlumno != $conAntiguoAlumno) {
                                    
                                    $filaNumero++;
                                    $contador++;
                                    
                                    $conAntiguoAlumno = $conNuevoAlumno;
                                    
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    
                                    if ($contador < 10) {
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '0'.$contador.'');
                                    }else{
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$contador.'');
                                    }
                                    
                                    $i++;
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['nacionalidad'].''.$data['cedulaes'].'');
                                    
                                    $i++;
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['apellido_alumno'].'');
                                    
                                    $i++;
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['nombre_alumno'].'');

                                    $i++;
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['lugarNac'].'');

                                    $i++;
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['entidadFederal'].'');

                                    $i++;
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['sexo'].'');

                                    $i++;
                                    $dia=substr($data['fecha_nac'], -2, 2);
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$dia.'');

                                    $i++;
                                    $dia=substr($data['fecha_nac'], -5, 2);
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$dia.'');

                                    $i++;
                                    $dia=substr($data['fecha_nac'], -10, 4);
                                    $columnaLetra = chr($i);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$dia.'');
                                    
                                    $empiezaMateria=$i;
                                    
                                    //Grupo Estable
                                    $columnaLetra = chr($columnaGr);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['nombre_grupo'].'');
                                }
                                //Cada nota
                                $empiezaMateria++;
                                if ($data[$estadoAño] == 2) {
                                    if ($data['estadonota'] == 4) {
                                        $columnaLetra = chr($empiezaMateria);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['promedio'].'');
                                    }else {
                                        $columnaLetra = chr($empiezaMateria);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'NC');
                                    }
                                }else {
                                    if ($data['estadonota'] == $notasTipo) {
                                        $columnaLetra = chr($empiezaMateria);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['promedio'].'');
                                    }else {
                                        $columnaLetra = chr($empiezaMateria);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*');
                                    }
                                }
                                

                            


                        /*
                        for ($columnaGrupos=$fila3de4; $columnaGrupos <= $filaNumero; $columnaGrupos++) { 
                                    $columnaLetra = chr($materiaz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$columnaGrupos.':'.$columnaLetra.''.$columnaGrupos.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$columnaGrupos.':'.$columnaLetra.''.$columnaGrupos.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$columnaGrupos.':'.$columnaLetra.''.$columnaGrupos.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$columnaGrupos.'', '****');
                        }*/
                    }
                    for ($k=0; $k < 15 ; $k++) { 
                        $filaNumero++;
                        $i = $ini;
                        $contador++;
                        $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                
                                                if ($contador < 10) {
                                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '0'.$contador.'');
                                                }else{
                                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$contador.'');
                                                }
                                                
                                                $i++;
                                                $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                                
                                                $i++;
                                                $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                                
                                                $i++;
                                                $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
            
                                                $i++;
                                                $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
            
                                                $i++;
                                                $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**');
            
                                                $i++;
                                                $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*');
            
                                                $i++;
                                                $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*');
            
                                                $i++;
                                                $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*');
            
                                                $i++;
                                                $columnaLetra = chr($i);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*');
                                                $i++;
                                                
                                            
                                            //Cada nota
                                                for ($empiezaMateria=$i; $empiezaMateria <= $materiaz ; $empiezaMateria++) { 
                                                    
                                           
                                                    $columnaLetra = chr($empiezaMateria);
                                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*');
                                                }
                                                
                                            
                                            
            
                                        
            
            /*                        for ($columnaGrupos=$fila3de4; $columnaGrupos <= $filaNumero; $columnaGrupos++) { 
                                                $columnaLetra = chr($materiaz);
                                                $hojaActiva->mergeCells(''.$columnaLetra.''.$columnaGrupos.':'.$columnaLetra.''.$columnaGrupos.'');
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$columnaGrupos.':'.$columnaLetra.''.$columnaGrupos.'')->applyFromArray($borders);
                                                $hojaActiva->getStyle(''.$columnaLetra.''.$columnaGrupos.':'.$columnaLetra.''.$columnaGrupos.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                                $hojaActiva->setCellValue(''.$columnaLetra.''.$columnaGrupos.'', '****');
                                    }*/
                                }
                }
        //espacios extra
       
                    

        
/*
        $hojaActiva->setCellValue('B2', 'aNOMBRES');
        $hojaActiva->setCellValue('C2', 'AaPELLIDOS');
        $hojaActiva->setCellValue('D2', 'aCEDULA');
        $hojaActiva->setCellValue('E2', 'SaECCION');
        $hojaActiva->setCellValue('F2', 'aESTADO');*/
        /*if ($row > 0) {
            while($data = $query->fetch()) {
            $nacimientofe = date("d-m-Y", strtotime($data['fecha_nac']));*/

            
            

            //header phpspreadsheet
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="resumenFinal.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($excel, 'Xlsx');
            $writer->save('php://output');

            exit
?>