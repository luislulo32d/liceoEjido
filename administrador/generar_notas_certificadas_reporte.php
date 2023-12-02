<?php 
        require_once '../includes/conexion.php';
        require_once '../vendor/autoload.php';


        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\IOFactory;

        // Datos del alumno POST
            $anio = $_POST['el_año_seleccion'];
            $municipio = $_POST['municipio'];
            $efDelAlumno = $_POST['efDelAlumno'];
            $paiz = $_POST['paiz'];
            $fechaDelAlumno = $_POST['fechaDelAlumno'];
            $nombre = $_POST['nombreDelAlumno'];
            $apellido = $_POST['apellidoDelAlumno'];
            $cedula = $_POST['cedulaDelAlumno'];

        //Datos del liceo POST
            $cedula_director = $_POST['cedula_director'];
            $nombre_Liceo = $_POST['nombre_Liceo'];
            $zonaedu_liceo = $_POST['zonaedu_liceo'];
            $entidad_liceo = $_POST['entidad_liceo'];
            $ef_liceo = $_POST['ef_liceo'];
            $codigo_liceo = $_POST['codigo_liceo'];
            $direccion_liceo = $_POST['direccion_liceo'];
            $telefono_liceo = $_POST['telefono_liceo'];
            $municipio_liceo = $_POST['municipio_liceo'];

            $nombre_director = $_POST['nombre_director'];
            $apellido_director = $_POST['apellido_director'];

            $fecha_hoy = $_POST['fecha_hoy'];
        
        


        //Notas del alumno POST
        
            for ($i=1; $i <= $anio; $i++) { 
                
                $cantidadM[$i] = $_POST['cantidadM_'.$i.''];
                $grupo[$i] = $_POST['grupo_'.$i.''];
               
                for ($k=0; $k < $cantidadM[$i]; $k++) { 
                    
                    $nombreM[$i][$k] = $_POST['nombreM_'.$i.'_'.$k.''];
                    $nombreN[$i][$k] = $_POST['nombreN_'.$i.'_'.$k.''];
                    $periodoN[$i][$k] = $_POST['periodoN_'.$i.'_'.$k.''];
                    $siglasM[$i][$k] = $_POST['siglasM_'.$i.'_'.$k.''];
                    $promedio[$i][$k] = $_POST['promedio_'.$i.'_'.$k.''];
                    $tipoN[$i][$k] = $_POST['tipoN_'.$i.'_'.$k.''];
                   

                    $periodoN[$i][$k] = substr($periodoN[$i][$k], -4);



                }
            }


        //establecer parametros de la tabla excel
        
        $nombreHoja = $cedula.".xlsx";

        $excel = new Spreadsheet();
        $hojaActiva = $excel->getActiveSheet();
        $hojaActiva->setTitle($nombreHoja);
        $filaNumero = 0;
        
        
        $ini=65;
        $i = 0;
        
        //Estilos varios del Excel
            $hojaActiva
            ->getStyle('A1:Z79')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('ffffff');
            
            $fontPlantel = [
                'font' => [
                    'size' => 5
                ]
            ];
            $fontMaterias = [
                'font' => [
                    'size' => 7
                ]
            ];
        //bordes de la tabla
            
            $borders = [
                'borders' => [
                    'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000'],
                ],
                    ],
                ];
            $bordePunteadoAbajo = [
                'borders' => [
                    'bottom' => ['borderStyle' => 'hair', 'color' => ['argb' => '00000']],
                ],
            ];
            $bordeLineaAbajo = [
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            
            $hojaActiva->setCellValue('A1', '                                                                       ');
        //anchura de cada celda
            $hojaActiva->getColumnDimension('A')->setWidth(7);
            $hojaActiva->getColumnDimension('B')->setWidth(5);
            $hojaActiva->getColumnDimension('C')->setWidth(7);
            $hojaActiva->getColumnDimension('D')->setWidth(5);
            $hojaActiva->getColumnDimension('E')->setWidth(9.57);
            $hojaActiva->getColumnDimension('F')->setWidth(5);
            $hojaActiva->getColumnDimension('G')->setWidth(4);
            $hojaActiva->getColumnDimension('H')->setWidth(5);
            $hojaActiva->getColumnDimension('I')->setWidth(5);
            $hojaActiva->getColumnDimension('J')->setWidth(1.57);
            $hojaActiva->getColumnDimension('K')->setWidth(4);
            
            $hojaActiva->getColumnDimension('L')->setWidth(1);
            
            $hojaActiva->getColumnDimension('M')->setWidth(8);
            $hojaActiva->getColumnDimension('N')->setWidth(11);
            $hojaActiva->getColumnDimension('O')->setWidth(5);
            $hojaActiva->getColumnDimension('P')->setWidth(5);
            $hojaActiva->getColumnDimension('Q')->setWidth(9.57);
            $hojaActiva->getColumnDimension('R')->setWidth(4);
            $hojaActiva->getColumnDimension('S')->setWidth(5);
            $hojaActiva->getColumnDimension('T')->setWidth(5);
            $hojaActiva->getColumnDimension('U')->setWidth(1.57);
            $hojaActiva->getColumnDimension('V')->setWidth(4);


        //altura de cada celda
            for ($x=0; $x < 18 ; $x++) { 
                $hojaActiva->getRowDimension($x)->setRowHeight(11.75);
            }

            for ($a=18; $a < 80 ; $a++) { 
                $hojaActiva->getRowDimension($a)->setRowHeight(15.5);
            }
        
        //Cabecera
            $styleCabecera = array(
                'font'  => array(
                    'size'  => 9,
                    'name'  => 'Arial'
            ));
                $hojaActiva->getStyle('A1:V3')->applyFromArray($styleCabecera);
            
        
                $filaNumero++;
                $i = $ini;
                $filaNumeroz = $filaNumero + 3;
                    
                    $columnaLetra = chr($i);
                    $iz = $i + 10;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '  ');
                    $i=$iz;
                    $i++;
                
                //i = L
                    $iz = $i + 10;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setUnderline(true);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'CERTIFICACION DE CALIFICACIONES EMG');
                    
                $filaNumero++;


                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'I. Plan de Estudio:');
                    

                    $columnaLetra = chr($iz+1);
                    $iz = $iz + 4;
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'EDUCACIÓN MEDIA GENERAL');
                    
                    $columnaLetra = chr($iz+1);
                    $iz = $iz + 4;
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Código 31059');
                    
                $filaNumero++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Lugar y Fecha de Expedición:');

                    $columnaLetra = chr($iz+1);
                    $iz = $iz + 7;
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Ejido, '.$fecha_hoy.'');
                    
        //Datos del Liceo
                

                $styleCabecera = array(
                    'font'  => array(
                        'size'  => 9,
                        'name'  => 'Arial'
                ));
                    $hojaActiva->getStyle('A5:V79')->applyFromArray($styleCabecera);
                
            
                $filaNumero++;
                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;
                
                    $iz = $i + 21;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'II. Datos del Plantel o Zona Educativa que Emite la Certificación:');
                    $i=$iz;
                    $i++;

                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Código:');
                    $i=$iz;
                    $i++;
                    

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$codigo_liceo.'');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                    $i=$iz;
                    $i++;
                    
                    $iz = $i+1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nombre: ');
                    $i=$iz;
                    $i++;
                    
                    $iz = $i+12;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombre_Liceo);
                    $i=$iz;
                    $i++;


                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Dirección: ');
                    $i=$iz;
                    $i++;

                    $iz = $i + 11;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$direccion_liceo.'');
                    $i=$iz;
                    $i++;

                    $iz = $i+1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Teléfono: ');
                    $i=$iz;
                    $i++;

                    $iz = $i + 5;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$telefono_liceo.'');
                    $i=$iz;
                    $i++;
                    
                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;
                
                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Municipio:');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$municipio_liceo.'');
                    $i=$iz;
                    $i++;
                    
                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Entidad Federal:');
                    $i=$iz;
                    $i++;

                    $iz = $i + 4;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordePunteadoAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$entidad_liceo.'');
                    $i=$iz;
                    $i++;

                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Zona Educativa:');
                    $i=$iz;
                    $i++;

                    $iz = $i + 4;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordeLineaAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$zonaedu_liceo.'');
                    $i=$iz;
                    $i++;
                    


                    


            
        //Datos del Alumno
                
                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;

                    $iz = $i + 21;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'III. Datos de Identificación del Estudiante:');
                    $i=$iz;
                    $i++;
                    
                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;
                
                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Cédula de Identidad:');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordePunteadoAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$cedula.'');
                    $i=$iz;
                    $i++;
                    
                    $iz = $i + 4;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('right');
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Fecha de Nacimiento: ');
                    $i=$iz;
                    $i++;

                    $iz = $i + 8;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordePunteadoAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$fechaDelAlumno.'');
                    $i=$iz;
                    $i++;

                
                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Apellido:');
                    $i=$iz;
                    $i++;

                    $iz = $i + 9;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordePunteadoAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$apellido.'');
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('right');
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nombre:');
                    $i=$iz;
                    $i++;

                    $iz = $i + 8;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordePunteadoAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$nombre.'');
                    $i=$iz;
                    $i++;

                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;

                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Lugar de Nacimiento:');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'País:');
                    $i=$iz;
                    $i++;

                    $iz = $i + 6;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordePunteadoAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $paiz);
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('right');
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Estado:');
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordePunteadoAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $efDelAlumno);
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('right');
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Municipio:');
                    $i=$iz;
                    $i++;

                    $iz = $i + 4;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($bordePunteadoAbajo);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $municipio);
                    $i=$iz;
                    $i++;

        //Planteles donde estudió

                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;
                    
                    $iz = $i + 10;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'IV. Planteles donde Cursó Estudios:');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nº');
                    $i=$iz;
                    $i++;

                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nombre del Plantel');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Localidad');
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'E.F.');
                    $i=$iz;
                    $i++;

                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nº');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Nombre del Plantel');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Localidad');
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'E.F.');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '3');
                    $i=$iz;
                    $i++;

                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****************************');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '********************');
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                    $i=$iz;
                    $i++;

                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '1');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'LICEO BOLIVARIANO EJIDO');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'EJIDO');
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ME');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '4');
                    $i=$iz;
                    $i++;

                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****************************');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '********************');
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                    $i=$iz;
                    $i++;

                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '2');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****************************');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '********************');
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '5');
                    $i=$iz;
                    $i++;

                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****************************');
                    $i=$iz;
                    $i++;

                    $iz = $i + 3;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '********************');
                    $i=$iz;
                    $i++;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                    $i=$iz;
                    $i++;

        //Plan de Estudio

                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;
                
                    $iz = $i + 21;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'V. Plan de Estudio:');
                    $i=$iz;
                    $i++;
            
                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;

                    $iz = $i + 10;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'PRIMER AÑO');
                    $i=$iz;
                    $i++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                    $i=$iz;
                    $i++;

                    $iz = $i + 9;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'SEGUNDO AÑO');
                    $i=$iz;
                    $i++;

                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero + 1;

                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ÁREAS DE FORMACIÓN');
                    $i=$iz;
                    $i++;

                    $filaNumeroz = $filaNumero;

                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'CALIFICACIÓN');
                    $i=$iz;
                    $i++;

                    $filaNumeroz++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'T-E');
                    $i=$iz;
                    $i++;

                    $filaNumeroz--;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'FECHA');
                    $i=$iz;
                    $i++;

                    $filaNumeroz++;

                   
                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setTextRotation(90);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($fontPlantel);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'PLANTEL');
                    $i=$iz;
                    $i++;


                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                    $i=$iz;
                    $i++;
                    
                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ÁREAS DE FORMACIÓN');
                    $i=$iz;
                    $i++;

                    $filaNumeroz = $filaNumero;

                    $iz = $i + 2;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'CALIFICACIÓN');
                    $i=$iz;
                    $i++;

                    $filaNumeroz++;

                    $iz = $i;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'T-E');
                    $i=$iz;
                    $i++;

                    $filaNumeroz--;

                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'FECHA');
                    $i=$iz;
                    $i++;

                    $filaNumeroz++;

                   
                    $iz = $i + 1;
                    $columnaLetra = chr($i);
                    $columnaLetra2 = chr($iz);
                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setTextRotation(90);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($fontPlantel);
                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'PLANTEL');
                    $i=$iz;
                    $i++;

                    $filaNumero  = $filaNumeroz;
                    
                    $hojaActiva->mergeCells('D'.$filaNumero.':D'.$filaNumeroz.'');
                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue('D'.$filaNumero.'', 'Nº');
                    
                    $hojaActiva->mergeCells('E'.$filaNumero.':F'.$filaNumeroz.'');
                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue('E'.$filaNumero.'', 'LETRAS');

                    $hojaActiva->mergeCells('H'.$filaNumero.':H'.$filaNumeroz.'');
                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue('H'.$filaNumero.'', 'Mes');

                    $hojaActiva->mergeCells('I'.$filaNumero.':I'.$filaNumeroz.'');
                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue('I'.$filaNumero.'', 'Año');
                    

                    $hojaActiva->mergeCells('O'.$filaNumero.':O'.$filaNumeroz.'');
                    $hojaActiva->getStyle('O'.$filaNumero.':O'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle('O'.$filaNumero.':O'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle('O'.$filaNumero.':O'.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle('O'.$filaNumero.':O'.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue('O'.$filaNumero.'', 'Nº');

                    $hojaActiva->mergeCells('P'.$filaNumero.':Q'.$filaNumeroz.'');
                    $hojaActiva->getStyle('P'.$filaNumero.':Q'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle('P'.$filaNumero.':Q'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle('P'.$filaNumero.':Q'.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle('P'.$filaNumero.':Q'.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue('P'.$filaNumero.'', 'LETRAS');

                    $hojaActiva->mergeCells('S'.$filaNumero.':S'.$filaNumeroz.'');
                    $hojaActiva->getStyle('S'.$filaNumero.':S'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle('S'.$filaNumero.':S'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle('S'.$filaNumero.':S'.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle('S'.$filaNumero.':S'.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue('S'.$filaNumero.'', 'Mes');
                    
                    $hojaActiva->mergeCells('T'.$filaNumero.':T'.$filaNumeroz.'');
                    $hojaActiva->getStyle('T'.$filaNumero.':T'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                    $hojaActiva->getStyle('T'.$filaNumero.':T'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hojaActiva->getStyle('T'.$filaNumero.':T'.$filaNumeroz.'')->applyFromArray($borders);
                    $hojaActiva->getStyle('T'.$filaNumero.':T'.$filaNumeroz.'')->getFont()->setBold(true);
                    $hojaActiva->setCellValue('T'.$filaNumero.'', 'Año');
                

                    
            //Generador de notas:
            
                $filaNumero++;
                $i = $ini;
                $iz = $i;
                $filaNumeroz = $filaNumero;
                $ano = 1;
                
                    //Notas Primer Año
                        for ($n=0; $n < $cantidadM[$ano]; $n++) {

                            if ($siglasM[$ano][$n] == "OYC" || $siglasM[$ano][$n] == "GP") {

                                if ($siglasM[$ano][$n] == "OYC") {
                                    $notaOYC[$ano] = $promedio[$ano][$n];

                                        if($notaOYC[$ano] > 18){

                                            $notaOYC[$ano] = "A";  

                                        }elseif($notaOYC[$ano] > 15){

                                            $notaOYC[$ano] = "B";

                                        }elseif($notaOYC[$ano] > 11){

                                            $notaOYC[$ano] = "C";

                                        }elseif($notaOYC[$ano] > 9){

                                            $notaOYC[$ano] = "D";

                                        }else{

                                            $notaOYC[$ano] = "EXONERADA";

                                        }
                                }
                                if ($siglasM[$ano][$n] == "GP") {
                                    $notaGP[$ano] = $promedio[$ano][$n];

                                        if($notaGP[$ano] > 18){
                                            
                                            $notaGP[$ano] = "A";    

                                        }elseif($notaGP[$ano] > 15){

                                            $notaGP[$ano] = "B";

                                        }elseif($notaGP[$ano] > 11){

                                            $notaGP[$ano] = "C";

                                        }elseif($notaGP[$ano] > 9){

                                            $notaGP[$ano] = "D";

                                        }else{

                                            $notaGP[$ano] = "EX";

                                        }
                                }

                                //se salta Grupos de participación y orientación y convivencia.
                            }else {
                                $i = $ini;
                                
                                $iz = $i + 2;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($fontMaterias);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreM[$ano][$n]);
                                $i=$iz + 1;

                                $iz = $i;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $promedio[$ano][$n]);
                                $i=$iz + 1;

                                $iz = $i + 1;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreN[$ano][$n]);
                                $i=$iz + 1;

                                $iz = $i;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $tipoN[$ano][$n]);
                                $i=$iz + 1;

                                $iz = $i;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '07');
                                $i=$iz + 1;

                                $iz = $i;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $periodoN[$ano][$n]);
                                $i=$iz + 1;

                                $iz = $i + 1;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '1');
                                $i=$iz + 1;

                                $filaNumero++;
                                
                                $ultimaM = $filaNumero;
                            }
                            
                            
                        }
                        
                    //Notas Segundo Año
                        $ini2=$i + 1;
                        $i++;
                        $iz = $i;
                        $filaNumero = $filaNumeroz;
                        $ano++;

                            if (2 <= $anio) {
                                for ($n=0; $n < $cantidadM[$ano]; $n++) {

                                    if ($siglasM[$ano][$n] == "OYC" || $siglasM[$ano][$n] == "GP") {

                                        if ($siglasM[$ano][$n] == "OYC") {
                                            $notaOYC[$ano] = $promedio[$ano][$n];
        
                                                if($notaOYC[$ano] > 18){
        
                                                    $notaOYC[$ano] = "A";  
        
                                                }elseif($notaOYC[$ano] > 15){
        
                                                    $notaOYC[$ano] = "B";
        
                                                }elseif($notaOYC[$ano] > 11){
        
                                                    $notaOYC[$ano] = "C";
        
                                                }elseif($notaOYC[$ano] > 9){
        
                                                    $notaOYC[$ano] = "D";
        
                                                }else{
        
                                                    $notaOYC[$ano] = "EXONERADA";
        
                                                }
                                        }
                                        if ($siglasM[$ano][$n] == "GP") {
                                            $notaGP[$ano] = $promedio[$ano][$n];
        
                                                if($notaGP[$ano] > 18){
                                                    
                                                    $notaGP[$ano] = "A";    
        
                                                }elseif($notaGP[$ano] > 15){
        
                                                    $notaGP[$ano] = "B";
        
                                                }elseif($notaGP[$ano] > 11){
        
                                                    $notaGP[$ano] = "C";
        
                                                }elseif($notaGP[$ano] > 9){
        
                                                    $notaGP[$ano] = "D";
        
                                                }else{
        
                                                    $notaGP[$ano] = "EX";
        
                                                }
                                        }
        
        
                                        //se salta Grupos de participación y orientación y convivencia.
                                    }else {
                                        $i = $ini2;
                                        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($fontMaterias);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreM[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $promedio[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreN[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $tipoN[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '07');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $periodoN[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '1');
                                        $i=$iz + 1;
        
                                        $filaNumero++;
                                    }
                                    
                                }
                            }else {
                                $cantidadM[$ano] = $cantidadM[1];
                                for ($n=0; $n < $cantidadM[$ano]; $n++) {

                                    if ($siglasM[1][$n] == "OYC" || $siglasM[1][$n] == "GP") {

                                        //se salta Grupos de participación y orientación y convivencia.
                                    }else {
                                        $i = $ini2;
                                        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**********************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $filaNumero++;
                                    
                                    }
                                }

                            }
                                //si uno de los dos años tiene más materias qué el otro:

                                while ($ultimaM != $filaNumero) {
                                    if ($ultimaM < $filaNumero) {
                                        $i = $ini;
                                
                                        $iz = $i + 2;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '**********************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '*****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '**************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        
                                        $ultimaM++;
                                    
                                    }else {
                                        $i = $ini2;
                                        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**********************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $filaNumero++;
                                    }
                                    
                                }

                    //Cabeceras tercer y cuarto año
                                $i = $ini;
                                $iz = $i;
                                $filaNumeroz = $filaNumero;
                
                                    $iz = $i + 10;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'TERCER AÑO');
                                    $i=$iz;
                                    $i++;
                
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                                    $i=$iz;
                                    $i++;
                
                                    $iz = $i + 9;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'CUARTO AÑO');
                                    $i=$iz;
                                    $i++;
                                    $filaNumero++;
                                $i = $ini;
                                $iz = $i;
                                $filaNumeroz = $filaNumero + 1;

                                    $iz = $i + 2;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ÁREAS DE FORMACIÓN');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz = $filaNumero;

                                    $iz = $i + 2;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'CALIFICACIÓN');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz++;

                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'T-E');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz--;

                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'FECHA');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz++;

                                
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setTextRotation(90);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($fontPlantel);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'PLANTEL');
                                    $i=$iz;
                                    $i++;


                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                                    $i=$iz;
                                    $i++;
                                    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ÁREAS DE FORMACIÓN');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz = $filaNumero;

                                    $iz = $i + 2;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'CALIFICACIÓN');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz++;

                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'T-E');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz--;

                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'FECHA');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz++;

                                
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setTextRotation(90);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($fontPlantel);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'PLANTEL');
                                    $i=$iz;
                                    $i++;

                                    $filaNumero  = $filaNumeroz;
                                    
                                    $hojaActiva->mergeCells('D'.$filaNumero.':D'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('D'.$filaNumero.'', 'Nº');
                                    
                                    $hojaActiva->mergeCells('E'.$filaNumero.':F'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('E'.$filaNumero.'', 'LETRAS');

                                    $hojaActiva->mergeCells('H'.$filaNumero.':H'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('H'.$filaNumero.'', 'Mes');

                                    $hojaActiva->mergeCells('I'.$filaNumero.':I'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('I'.$filaNumero.'', 'Año');
                                    

                                    $hojaActiva->mergeCells('O'.$filaNumero.':O'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('O'.$filaNumero.':O'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('O'.$filaNumero.':O'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('O'.$filaNumero.':O'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('O'.$filaNumero.':O'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('O'.$filaNumero.'', 'Nº');

                                    $hojaActiva->mergeCells('P'.$filaNumero.':Q'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('P'.$filaNumero.':Q'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('P'.$filaNumero.':Q'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('P'.$filaNumero.':Q'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('P'.$filaNumero.':Q'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('P'.$filaNumero.'', 'LETRAS');

                                    $hojaActiva->mergeCells('S'.$filaNumero.':S'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('S'.$filaNumero.':S'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('S'.$filaNumero.':S'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('S'.$filaNumero.':S'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('S'.$filaNumero.':S'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('S'.$filaNumero.'', 'Mes');
                                    
                                    $hojaActiva->mergeCells('T'.$filaNumero.':T'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('T'.$filaNumero.':T'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('T'.$filaNumero.':T'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('T'.$filaNumero.':T'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('T'.$filaNumero.':T'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('T'.$filaNumero.'', 'Año');
                    //Notas Tercer Año
                        $i = $ini;
                        $iz = $i;
                        $filaNumero++;
                        $filaNumeroz = $filaNumero;
                        $ano++;

                        if (3 <= $anio) {
                            for ($n=0; $n < $cantidadM[$ano]; $n++) {

                                if ($siglasM[$ano][$n] == "OYC" || $siglasM[$ano][$n] == "GP") {

                                    if ($siglasM[$ano][$n] == "OYC") {
                                        $notaOYC[$ano] = $promedio[$ano][$n];
    
                                            if($notaOYC[$ano] > 18){
    
                                                $notaOYC[$ano] = "A";  
    
                                            }elseif($notaOYC[$ano] > 15){
    
                                                $notaOYC[$ano] = "B";
    
                                            }elseif($notaOYC[$ano] > 11){
    
                                                $notaOYC[$ano] = "C";
    
                                            }elseif($notaOYC[$ano] > 9){
    
                                                $notaOYC[$ano] = "D";
    
                                            }else{
    
                                                $notaOYC[$ano] = "EXONERADA";
    
                                            }
                                    }
                                    if ($siglasM[$ano][$n] == "GP") {
                                        $notaGP[$ano] = $promedio[$ano][$n];
    
                                            if($notaGP[$ano] > 18){
                                                
                                                $notaGP[$ano] = "A";    
    
                                            }elseif($notaGP[$ano] > 15){
    
                                                $notaGP[$ano] = "B";
    
                                            }elseif($notaGP[$ano] > 11){
    
                                                $notaGP[$ano] = "C";
    
                                            }elseif($notaGP[$ano] > 9){
    
                                                $notaGP[$ano] = "D";
    
                                            }else{
    
                                                $notaGP[$ano] = "EX";
    
                                            }
                                    }
    
    
                                    //se salta Grupos de participación y orientación y convivencia.
                                }else {
                                    $i = $ini;
                                    
                                    $iz = $i + 2;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($fontMaterias);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreM[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $promedio[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreN[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $tipoN[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '07');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $periodoN[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '1');
                                    $i=$iz + 1;
    
                                    $filaNumero++;
                                    $ultimaM = $filaNumero;

                                }
                                
                            }
                        }else {
                            $cantidadM[$ano] = $cantidadM[1];
                            for ($n=0; $n < $cantidadM[$ano]; $n++) {

                                if ($siglasM[1][$n] == "OYC" || $siglasM[1][$n] == "GP") {

                                    //se salta Grupos de participación y orientación y convivencia.
                                }else {
                                    $i = $ini;
                                    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**********************');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*****');
                                    $i=$iz + 1;
    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**************');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                    $i=$iz + 1;
    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                    $i=$iz + 1;
    
                                    $filaNumero++;
                                
                                    $ultimaM = $filaNumero;
                                    
                                }
                            }

                        }
                    //Notas Cuarto Año
                    $ini2=$i + 1;
                        $i++;
                        $iz = $i;
                        $filaNumero = $filaNumeroz;
                        $ano++;

                            if (2 <= $anio) {
                                for ($n=0; $n < $cantidadM[$ano]; $n++) {

                                    if ($siglasM[$ano][$n] == "OYC" || $siglasM[$ano][$n] == "GP") {

                                        if ($siglasM[$ano][$n] == "OYC") {
                                            $notaOYC[$ano] = $promedio[$ano][$n];
        
                                                if($notaOYC[$ano] > 18){
        
                                                    $notaOYC[$ano] = "A";  
        
                                                }elseif($notaOYC[$ano] > 15){
        
                                                    $notaOYC[$ano] = "B";
        
                                                }elseif($notaOYC[$ano] > 11){
        
                                                    $notaOYC[$ano] = "C";
        
                                                }elseif($notaOYC[$ano] > 9){
        
                                                    $notaOYC[$ano] = "D";
        
                                                }else{
        
                                                    $notaOYC[$ano] = "EXONERADA";
        
                                                }
                                        }
                                        if ($siglasM[$ano][$n] == "GP") {
                                            $notaGP[$ano] = $promedio[$ano][$n];
        
                                                if($notaGP[$ano] > 18){
                                                    
                                                    $notaGP[$ano] = "A";    
        
                                                }elseif($notaGP[$ano] > 15){
        
                                                    $notaGP[$ano] = "B";
        
                                                }elseif($notaGP[$ano] > 11){
        
                                                    $notaGP[$ano] = "C";
        
                                                }elseif($notaGP[$ano] > 9){
        
                                                    $notaGP[$ano] = "D";
        
                                                }else{
        
                                                    $notaGP[$ano] = "EX";
        
                                                }
                                        }
        
        
                                        //se salta Grupos de participación y orientación y convivencia.
                                    }else {
                                        $i = $ini2;
                                        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($fontMaterias);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreM[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $promedio[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreN[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $tipoN[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '07');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $periodoN[$ano][$n]);
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '1');
                                        $i=$iz + 1;
        
                                        $filaNumero++;
                                    }
                                    
                                }
                            }else {
                                $cantidadM[$ano] = $cantidadM[1];
                                for ($n=0; $n < $cantidadM[$ano]; $n++) {

                                    if ($siglasM[1][$n] == "OYC" || $siglasM[1][$n] == "GP") {

                                        //se salta Grupos de participación y orientación y convivencia.
                                    }else {
                                        $i = $ini2;
                                        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**********************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $filaNumero++;
                                    
                                    }
                                }

                            }
                                //si uno de los dos años tiene más materias qué el otro:
                            
                                while ($ultimaM != $filaNumero) {
                                    if ($ultimaM < $filaNumero) {
                                        $i = $ini;
                                
                                        $iz = $i + 2;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '**********************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '*****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '**************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        
                                        $ultimaM++;
                                    
                                    }else {
                                        $i = $ini2;
                                        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**********************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $filaNumero++;
                                    }
                                    
                                }

                    //Cabeceras Quinto, GP Y OYC
                                $i = $ini;
                                $iz = $i;
                                $filaNumeroz = $filaNumero;
                
                                    $iz = $i + 10;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'QUINTO AÑO');
                                    $i=$iz;
                                    $i++;
                
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                                    $i=$iz;
                                    $i++;
                
                                    $iz = $i + 9;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'AREAS DE FORMACIÓN');
                                    $i=$iz;
                                    $i++;
                                    $filaNumero++;
                                $i = $ini;
                                $iz = $i;
                                $filaNumeroz = $filaNumero + 1;

                                    $iz = $i + 2;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ÁREAS DE FORMACIÓN');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz = $filaNumero;

                                    $iz = $i + 2;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'CALIFICACIÓN');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz++;

                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'T-E');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz--;

                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'FECHA');
                                    $i=$iz;
                                    $i++;

                                    $filaNumeroz++;

                                
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setTextRotation(90);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->applyFromArray($fontPlantel);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'PLANTEL');
                                    $i=$iz;
                                    $i++;


                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
                                    $i=$iz;
                                    $i++;
                                    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setWrapText(true); 
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ÁREA DE FORMACIÓN');
                                    $i=$iz;
                                    $i++;

                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'AÑO');
                                    $i=$iz;
                                    $i++;

                                    $iz = $i + 6;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'LITERAL');
                                    $i=$iz;
                                    $i++;

                                    $filaNumero  = $filaNumeroz;
                                    
                                    $hojaActiva->mergeCells('D'.$filaNumero.':D'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('D'.$filaNumero.':D'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('D'.$filaNumero.'', 'Nº');
                                    
                                    $hojaActiva->mergeCells('E'.$filaNumero.':F'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('E'.$filaNumero.':F'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('E'.$filaNumero.'', 'LETRAS');

                                    $hojaActiva->mergeCells('H'.$filaNumero.':H'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('H'.$filaNumero.':H'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('H'.$filaNumero.'', 'Mes');

                                    $hojaActiva->mergeCells('I'.$filaNumero.':I'.$filaNumeroz.'');
                                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle('I'.$filaNumero.':I'.$filaNumeroz.'')->getFont()->setBold(true);
                                    $hojaActiva->setCellValue('I'.$filaNumero.'', 'Año');
                                    
                    //Notas Quinto  Año
                        $i = $ini;
                        $iz = $i;
                        $filaNumero++;
                        $filaNumeroz = $filaNumero;
                        $ano++;

                        if (3 <= $anio) {
                            for ($n=0; $n < $cantidadM[$ano]; $n++) {

                                if ($siglasM[$ano][$n] == "OYC" || $siglasM[$ano][$n] == "GP") {

                                    if ($siglasM[$ano][$n] == "OYC") {
                                        $notaOYC[$ano] = $promedio[$ano][$n];
    
                                            if($notaOYC[$ano] > 18){
    
                                                $notaOYC[$ano] = "A";  
    
                                            }elseif($notaOYC[$ano] > 15){
    
                                                $notaOYC[$ano] = "B";
    
                                            }elseif($notaOYC[$ano] > 11){
    
                                                $notaOYC[$ano] = "C";
    
                                            }elseif($notaOYC[$ano] > 9){
    
                                                $notaOYC[$ano] = "D";
    
                                            }else{
    
                                                $notaOYC[$ano] = "EXONERADA";
    
                                            }
                                    }
                                    if ($siglasM[$ano][$n] == "GP") {
                                        $notaGP[$ano] = $promedio[$ano][$n];
    
                                            if($notaGP[$ano] > 18){
                                                
                                                $notaGP[$ano] = "A";    
    
                                            }elseif($notaGP[$ano] > 15){
    
                                                $notaGP[$ano] = "B";
    
                                            }elseif($notaGP[$ano] > 11){
    
                                                $notaGP[$ano] = "C";
    
                                            }elseif($notaGP[$ano] > 9){
    
                                                $notaGP[$ano] = "D";
    
                                            }else{
    
                                                $notaGP[$ano] = "EX";
    
                                            }
                                    }
    
    
                                    //se salta Grupos de participación y orientación y convivencia.
                                }else {
                                    $i = $ini;
                                    
                                    $iz = $i + 2;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($fontMaterias);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreM[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $promedio[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $nombreN[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $tipoN[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '07');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $periodoN[$ano][$n]);
                                    $i=$iz + 1;
    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '1');
                                    $i=$iz + 1;
    
                                    $filaNumero++;
                                    $ultimaM = $filaNumero;

                                }
                                
                            }
                        }else {
                            $cantidadM[$ano] = $cantidadM[1];
                            for ($n=0; $n < $cantidadM[$ano]; $n++) {

                                if ($siglasM[1][$n] == "OYC" || $siglasM[1][$n] == "GP") {

                                    //se salta Grupos de participación y orientación y convivencia.
                                }else {
                                    $i = $ini;
                                    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**********************');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*****');
                                    $i=$iz + 1;
    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**************');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                    $i=$iz + 1;
    
                                    $iz = $i;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                    $i=$iz + 1;
    
                                    $iz = $i + 1;
                                    $columnaLetra = chr($i);
                                    $columnaLetra2 = chr($iz);
                                    $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                    $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                    $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                    $i=$iz + 1;
    
                                    $filaNumero++;
                                
                                    $ultimaM = $filaNumero;
                                    
                                }
                            }

                        }
                    //Notas Areas de formación
                        $ini2=$i + 1;
                        $i++;
                        $iz = $i;
                        $filaNumero = $filaNumeroz - 1;
                        $filaAreas = $filaNumero + 4;

                        $iz = $i + 1;
                        $columnaLetra = chr($i);
                        $columnaLetra2 = chr($iz);
                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->applyFromArray($borders);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setHorizontal('center');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setWrapText(true); 
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ORIENTACIÓN Y CONVIVENCIA');
                        $i=$iz + 1;

                        $ini3 = $i;
                            for ($e=1; $e <= $ano; $e++) { 
                                $i = $ini3;
                                $iz = $i;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$e.'º');
                                $i=$iz + 1;
    
                                $iz = $i + 6;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $notaOYC[$e]);
                                $i=$iz + 1;

                                $filaNumero++;
    
                                
                            }    
                            
                        $i = $ini2;
                        $iz = $i + 1;
                        $columnaLetra = chr($i);
                        $columnaLetra2 = chr($iz);
                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'ÁREA DE FORMACIÓN');
                        $i=$iz;
                        $i++;
                        
                        $iz = $i;
                        $columnaLetra = chr($i);
                        $columnaLetra2 = chr($iz);
                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'AÑO');
                        $i=$iz;
                        $i++;

                        $iz = $i+3;
                        $columnaLetra = chr($i);
                        $columnaLetra2 = chr($iz);
                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'GRUPO');
                        $i=$iz;
                        $i++;
                        
                        $iz = $i + 2;
                        $columnaLetra = chr($i);
                        $columnaLetra2 = chr($iz);
                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'LITERAL');
                        $i=$iz;
                        $i++;
                        $filaNumero++;

                        $i = $ini2;
                        
                        $filaAreas = $filaNumero + 4;
                        $iz = $i + 1;
                        $columnaLetra = chr($i);
                        $columnaLetra2 = chr($iz);
                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->applyFromArray($borders);
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setHorizontal('center');
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        
                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setWrapText(true); 
                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'PARTICIPACIÓN EN GRUPOS DE CREACIÓN, RECREACIÓN Y PRODUCCIÓN');
                        $i=$iz + 1;
                        $ini3 = $i;
                            for ($e=1; $e <= $ano; $e++) { 
                                $i = $ini3;
                                $iz = $i;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ''.$e.'º');
                                $i=$iz + 1;

                                $iz = $i + 3;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $grupo[$e]);
                                $i=$iz + 1;

                                $iz = $i + 2;
                                $columnaLetra = chr($i);
                                $columnaLetra2 = chr($iz);
                                $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $notaGP[$e]);
                                $i=$iz + 1;

                                $filaNumero++;
    
                                
                            }    


                            
                                //si uno de los dos años tiene más materias qué el otro:
                            
                                while ($ultimaM != $filaNumero) {
                                    if ($ultimaM < $filaNumero) {
                                        $i = $ini;
                                
                                        $iz = $i + 2;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '**********************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '*****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '**************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$ultimaM.':'.$columnaLetra2.''.$ultimaM.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$ultimaM.'', '****');
                                        $i=$iz + 1;
        
                                        
                                        $ultimaM++;
                                    
                                    }else {
                                        $i = $ini2;
                                        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**********************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '*****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '**************');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $iz = $i + 1;
                                        $columnaLetra = chr($i);
                                        $columnaLetra2 = chr($iz);
                                        $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
                                        $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                        $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', '****');
                                        $i=$iz + 1;
        
                                        $filaNumero++;
                                    }
                                    
                                }
        //Observaciones
            $filaNumero++;
            $filaNumeroz = $filaNumero;
            $i = $ini;
            $iz = $i;
            $iz = $i + 21;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'VI. Observaciones:  APLICACIÓN DEL PROCESO DE CONVERSIÓN Y TRANSFERENCIA DE ESTUDIO DE ACUERDO');
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini;
            $iz = $i;
            $iz = $i + 21;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumeroz.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'AL MEMORANDUM DE FECHA '.$fecha_hoy);
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini;
            $iz = $i;
            $iz = $i + 10;
            $filaNumeroz = $filaNumero;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'VII. Plantel');
            $i=$iz;
            $i++;
                    
            $filaAreas = $filaNumero + 7;
            $iz = $i;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->applyFromArray($borders);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
            $i=$iz;
            $i++;

            $iz = $i;
            $iz = $i + 9;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getFont()->setBold(true);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'VIII. Zona Educativa');
            $i=$iz;
            $i++;
            $filaNumero++;

            $filaNumeroz = $filaNumero;

            $i = $ini;
            $iz = $i;
            $iz = $i + 3;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Director(a)');
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini;
            $iz = $i;
            $iz = $i + 3;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Apellidos y Nombres:');
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini;
            $iz = $i;
            $iz = $i + 3;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $apellido_director.' '.$nombre_director);
            $i=$iz;
            $i++;
            $filaNumero++;
           
            $i = $ini;
            $iz = $i;
            $iz = $i + 3;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Cédula de Identidad:');
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini;
            $iz = $i;
            $iz = $i + 3;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', $cedula_director);
            $i=$iz;
            $i++;
            $filaNumero++;
       
            $i = $ini;
            $iz = $i;
            $iz = $i + 3;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Firma:');
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini;
            $iz = $i;
            $iz = $i + 3;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Validez Nacional');
            $i=$iz;
            $i++;
            
            $filaNumero = $filaNumeroz;
            $iz = $i + 6;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setHorizontal('center');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'SELLO DEL PLANTEL');
            $i=$iz;
            $i++;


            $i = $ini2;
            $iz = $i;
            $iz = $i + 2;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setHorizontal('center');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Director(a)');
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini2;
            $iz = $i;
            $iz = $i + 2;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Apellidos y Nombres:');
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini2;
            $iz = $i;
            $iz = $i + 2;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
            $i=$iz;
            $i++;
            $filaNumero++;
           
            $i = $ini2;
            $iz = $i;
            $iz = $i + 2;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Cédula de Identidad:');
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini2;
            $iz = $i;
            $iz = $i + 2;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', ' ');
            $i=$iz;
            $i++;
            $filaNumero++;
       
            $i = $ini2;
            $iz = $i;
            $iz = $i + 2;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Firma:');
            $i=$iz;
            $i++;
            $filaNumero++;

            $i = $ini2;
            $iz = $i;
            $iz = $i + 2;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaNumero.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'Validez Internacional');
            $i=$iz;
            $i++;
            
            $filaNumero = $filaNumeroz;
            $iz = $i + 6;
            $columnaLetra = chr($i);
            $columnaLetra2 = chr($iz);
            $hojaActiva->mergeCells(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->applyFromArray($borders);
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setHorizontal('center');
            $hojaActiva->getStyle(''.$columnaLetra.''.$filaNumero.':'.$columnaLetra2.''.$filaAreas.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue(''.$columnaLetra.''.$filaNumero.'', 'SELLO DE LA ZONA EDUCATIVA');
            $i=$iz;
            $i++;





            $nombreDocumento = "NC ".$cedula.".xlsx";

            //header phpspreadsheet
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='.$nombreDocumento.'');
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($excel, 'Xlsx');
            $writer->save('php://output');

            exit
?>