<?php 
        require_once '../includes/conexion.php';
        require_once '../vendor/autoload.php';


        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\IOFactory;

        //establecer parametros de la tabla excel

        $tipoLapso = $_POST['listLapso'];
        $fecha = date("n");
        $fechaAño = date("Y");
        $siglas_seleccion = $_POST['siglas_seleccion'];
        $numeroDeMaterias = strlen($siglas_seleccion);
        $numeroDeMaterias = $numeroDeMaterias / 3;
        $el_año_seleccion = $_POST['el_año_seleccion'];
        $la_seccion_seleccion = $_POST['listAula'];
        $periodo_seleccion = $_POST['listPeriodo'];

        if ($tipoLapso == 1) {
            $nombreLapso = "Primer Lapso";
            $nombre_notas = "nota1";
            
        }elseif ($tipoLapso == 2) {
            $nombreLapso = "Segundo Lapso";
            $nombre_notas = "nota2";


        }elseif ($tipoLapso == 3) {
            $nombreLapso = "Tercer Lapso";
            $nombre_notas = "nota3";


        }else {
            $nombreLapso = "Promedios";
            $nombre_notas = "promedio";


        }



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
            $nombreTabla = "1ero".$fecha;
            $nombre_año = "PRIMER AÑO";
            $estadoAño = "statuspr";

        }elseif ($curso == 2) {
            $tablaAño = "segundo_año";
            $nombreTabla = "2do".$fecha;
            $nombre_año = "SEGUNDO AÑO";
            $estadoAño = "statussg";

        }elseif ($el_año_seleccion == 3) {
            $tablaAño = "tercer_año";
            $nombreTabla = "3ro".$fecha;
            $nombre_año = "TERCER AÑO";
            $estadoAño = "statustr";

        }elseif ($el_año_seleccion == 4) {
            $tablaAño = "cuarto_año";
            $nombreTabla = "4to".$fecha;
            $nombre_año = "CUARTO AÑO";
            $estadoAño = "statuscr";

        }elseif ($el_año_seleccion == 5) {
            $tablaAño = "quinto_año";
            $nombreTabla = "5to".$fecha;
            $nombre_año = "QUINTO AÑO";
            $estadoAño = "statusqn";

        }else {
            $tablaAño = "quinto_año";
            $nombreTabla = "5to".$fecha;
            $nombre_año = "QUINTO AÑO";
            $estadoAño = "statusqn";

        }
        
        
        

        $sql = "SELECT * FROM notas as nt INNER JOIN alumnos as al ON nt.alumno_id = al.alumno_id INNER JOIN $tablaAño as ta ON nt.alumno_id = ta.alumno_id INNER JOIN materias as mt ON nt.materia_id = mt.materia_id INNER JOIN periodos as pe ON nt.periodo_id = pe.periodo_id  WHERE (ta.$estadoAño = 1 OR ta.$estadoAño = 2) AND mt.año_seleccion = $el_año_seleccion AND ta.aula_id = $la_seccion_seleccion AND nt.periodo_id = $periodo_seleccion ORDER BY nt.alumno_id, nt.materia_id";
        $query = $pdo->prepare($sql);
        $query->execute();
        $row = $query->rowCount();


        $excel = new Spreadsheet();
        $hojaNotasActiva = $excel->getActiveSheet();
        $hojaNotasActiva->setTitle("".$nombreTabla."");
        $filaNumero = 0;

        
        
        $periodoActivo = $fechaAño;
        $ini=65;
        $i = 0;
        $materiazas = $numeroDeMaterias + $ini + 4;

        //bordes de la tabla
            
            $borders = [
                'borders' => [
                'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000'],
                ],
                ],
            ];
            
        
        //anchura de cada celda de la tabla
        $hojaNotasActiva->getColumnDimension('A')->setWidth(3);
        $hojaNotasActiva->getColumnDimension('B')->setWidth(20);
        $hojaNotasActiva->getColumnDimension('C')->setWidth(23);
        $hojaNotasActiva->getColumnDimension('D')->setWidth(23);
        $i = $ini + 4;
        $contador = 0;
        $restarContador = 0;
            //materias
            for ($maximaterias=$i; $maximaterias < $materiazas; $maximaterias++) { 
                $calculo = $contador * 3;
                $nombresMaterias=substr($siglas_seleccion, $calculo, 3);
                if ($nombresMaterias != "OYC" && $nombresMaterias != "GP ") {
                    $letraMaximaterias = $maximaterias - $restarContador;
                    $columnaLetra = chr($letraMaximaterias);
                    $hojaNotasActiva->getColumnDimension(''.$columnaLetra.'')->setWidth(5);
    
                }else {
                    $restarContador++;
                }
                
                $contador++;
            }

        $letraMaximaterias++;
        $columnaLetra = chr($letraMaximaterias);
        $hojaNotasActiva->getColumnDimension(''.$columnaLetra.'')->setWidth(5);

        $letraMaximaterias++;
        $columnaLetra = chr($letraMaximaterias);
        $hojaNotasActiva->getColumnDimension(''.$columnaLetra.'')->setWidth(5);
          
        $letraMaximaterias++;
        $columnaLetra = chr($letraMaximaterias);
        $hojaNotasActiva->getColumnDimension(''.$columnaLetra.'')->setWidth(5);

        $letraMaximaterias++;
        $columnaLetra = chr($letraMaximaterias);
        $hojaNotasActiva->getColumnDimension(''.$columnaLetra.'')->setWidth(5);

        $letraMaximaterias++;
        $columnaLetra = chr($letraMaximaterias);
        $hojaNotasActiva->getColumnDimension(''.$columnaLetra.'')->setWidth(5);

        $i = $ini;
        $iz = $i + 3;
        $columnaLetra = chr($i);
        $columnaLetra2 = chr($iz);
        $filaNumero++;
        $filaNumeroz = $filaNumero + 4;
        $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');

            
        
        
        //cabecera de la tabla
            //linea 1
            $filaNumero = $filaNumeroz + 1;
            $filaNumeroz = $filaNumero + 1;
            
                $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$nombre_año.'');
                $i=$iz + 1;

                $limiteDeLaTabla = $maximaterias + 2;
                $columnaLetra = chr($i);
                $columnaLetra2 = chr($limiteDeLaTabla);
                $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$nombreLapso.' '.$fecha.' '.$fechaAño.'');                


            //linea 2
            $filaNumero = $filaNumeroz + 1;
            $i = $ini;
            $filaNumeroz = $filaNumero+1;

                $columnaLetra = chr($i);
                $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nº');
                $i++;

                $columnaLetra = chr($i);
                $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Cédula de Identidad'); //agregar salto de linea despues de "de "
                $i++;

                $columnaLetra = chr($i);
                $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Apellidos');
                $i++;

                $columnaLetra = chr($i);
                $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nombres');
                $i++;

                $empiezaMateria = $i;
                $contador = 0;
                $numeroDeMuestra = 0;
                $restarContador = 0;;
                $letraMaximaterias = 0;
                    //materias

                        for ($maximaterias=$i; $maximaterias < $materiazas; $maximaterias++) { 
                            $calculo = $contador * 3;
                            $nombresMaterias=substr($siglas_seleccion, $calculo, 3);
                            
                            
                            //siglas
                                if ($nombresMaterias != "OYC" && $nombresMaterias != "GP ") {
                                    
                                    $letraMaximaterias = $maximaterias - $restarContador;
                                    $columnaLetra = chr($letraMaximaterias);
                                    $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumeroz.':'.$columnaLetra.''.$filaNumeroz.'');
                                    $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumeroz.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumeroz.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumeroz.'', ''.$nombresMaterias.'');
                                    $numeroDeMuestra++;
                                }else {
                                    $restarContador++;
                                }
                            
                            $contador++;
                        
                             //numeros
                                if ($nombresMaterias != "OYC" && $nombresMaterias != "GP ") {
                                
                                    $columnaLetra = chr($letraMaximaterias);
                                    $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$numeroDeMuestra.'');
                                }
                        }
                        $i = $letraMaximaterias;
                        $i++;

                        $columnaLetra = chr($i);
                        $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'');
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'DEF');
                        $i++;

                        $columnaLetra = chr($i);
                        $i++;
                        $columnaLetra2 = chr($i);
                        $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'OYC');
                        $i++;

                        $columnaLetra = chr($i);
                        $i++;
                        $columnaLetra2 = chr($i);
                        $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'GP');

        //cuerpo de la tabla
            if ($row > 0) {
                    $conMateria = 0;
                    $ini=65;
                    $contador = 0;
                    $filaNumero = $filaNumeroz;
                    $conNuevoAlumno = 0;
                    $conAntiguoAlumno = 0;
                    $i=$ini;
                    $restarContador = 0;
                    $notaDef = 0;
                    $restarOtraNota = 0;



                    while ($data = $query->fetch()) {
                        $conNuevoAlumno = $data['alumno_id'];
                         //para poder imprimir solo una vez por alumno su información
                         if ($conNuevoAlumno != $conAntiguoAlumno) {
                            $i=$ini;        
                            $filaNumero++;
                            $contador++;
                            
                            $conAntiguoAlumno = $conNuevoAlumno;
                            
                            //Nº
                            $columnaLetra = chr($i);
                            $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                            
                            if ($contador < 10) {
                                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '0'.$contador.'');
                            }else{
                                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$contador.'');
                            }

                            //cedula
                            $i++;
                            $columnaLetra = chr($i);
                            $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                            $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['nacionalidad'].''.$data['cedulaes'].'');

                            //Apellido
                            $i++;
                            $columnaLetra = chr($i);
                            $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                            $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['apellido_alumno'].'');

                            //Nombre
                            $i++;
                            $columnaLetra = chr($i);
                            $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                            $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data['nombre_alumno'].'');
                            
                            $empiezaMateria = $i;
                            $imprimirEn = $materiazas - 2;
                            $restarContador = 0;

                            //imprimir definitiva en el alumno anterior si existe
                            if ($notaDef != 0) {
                                $divMaterias = $numeroDeMaterias - 2;
                                $divMaterias = $divMaterias - $restarOtraNota;
                                $notaDef = $notaDef / $divMaterias;
                                $filaNumeroz = $filaNumero - 1;
                                $columnaLetra = chr($letraMaximatera);
                                $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumeroz.':'.$columnaLetra.''.$filaNumeroz.'');
                                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumeroz.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumeroz.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumeroz.'', ''.$notaDef.'');
                                $notaDef = 0;
                                $restarOtraNota = 0;

                            }

                        }
                    
                    //cada nota
                    $empiezaMateria++;
                    $letraMaximatera = $empiezaMateria - $restarContador;
                    if ($data[$nombre_notas] != 0) {
                        if ($data['siglas'] != "OYC" && $data['siglas'] != "GP") {
                            //para repitentes
                            if ($data[$estadoAño] == 2) {
                                if ($data['estadonota'] == 4) {
                                    $columnaLetra = chr($letraMaximatera);
                                    $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data[$nombre_notas].'');

                                    $notaDef = $notaDef + $data[$nombre_notas];

                                }else {
                                    $columnaLetra = chr($letraMaximatera);
                                    $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                    $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'NC');

                                    $restarOtraNota++;
                                    
                                }
                            }else {
                                $columnaLetra = chr($letraMaximatera);
                                $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data[$nombre_notas].'');
    
                                $notaDef = $notaDef + $data[$nombre_notas];        
                            }
                            
                        }else{
                            $imprimirEn++;
                            $columnaLetra = chr($imprimirEn);
                            $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                            $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$data[$nombre_notas].'');
                            
                            if ($data[$nombre_notas] > 18) {
                                $literal = "A";
                            }elseif ($data[$nombre_notas] > 15) {
                                $literal = "B";
                            }elseif ($data[$nombre_notas] > 11) {
                                $literal = "C";
                            }elseif ($data[$nombre_notas] > 9) {
                                $literal = "D";
                            }else {
                                $literal = "IN";
                            }

                            $imprimirEn++;
                            $columnaLetra = chr($imprimirEn);
                            $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                            $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                            $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$literal.'');
                            
                            
                            $restarContador++;
                        }
                    }else {
                        $columnaLetra = chr($empiezaMateria);
                        $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'');
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->applyFromArray($borders);
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                    }


                    }
                    //nota definitiva del último alumno
                    if ($notaDef != 0) {
                        $divMaterias = $numeroDeMaterias - 2;
                        $divMaterias = $divMaterias - $restarOtraNota;
                        $notaDef = $notaDef / $divMaterias;
                        $filaNumeroz = $filaNumero;
                        $columnaLetra = chr($letraMaximatera);
                        $hojaNotasActiva->mergeCells(''.$columnaLetra.''.$filaNumeroz.':'.$columnaLetra.''.$filaNumeroz.'');
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumeroz.':'.$columnaLetra.''.$filaNumeroz.'')->applyFromArray($borders);
                        $hojaNotasActiva->getStyle(''.$columnaLetra.''.$filaNumeroz.':'.$columnaLetra.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaNotasActiva->setCellValue(''.$columnaLetra.''.$filaNumeroz.'', ''.$notaDef.'');
                        $notaDef = 0;
                        $restarOtraNota = 0;


                    }

            }
            

                        

            //header phpspreadsheet
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="notasGeneradas.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($excel, 'Xlsx');
            $writer->save('php://output');

            exit
?>