<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['apellido']) || empty($_POST['nombre']) || empty($_POST['lugarNac']) || empty($_POST['entidadFederal']) || empty($_POST['cedulaes']) || empty($_POST['listSexo']) || empty($_POST['fecha_nac']) || empty($_POST['listNacionalidad']) || empty($_POST['listTelefContacto']) || empty($_POST['listDireccion'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idalumno = $_POST['idalumno'];
        $apellido = $_POST['apellido'];
        $nombre = $_POST['nombre'];
        $lugarNac = $_POST['lugarNac'];
        $municipio = $_POST['municipio'];
        $entidadFederal = $_POST['entidadFederal'];
        $cedulaes = $_POST['cedulaes'];
        $cedu_estudiantil = $_POST['cedu_estudiantil'];
        $listSexo = $_POST['listSexo'];
        $fecha_nac = $_POST['fecha_nac'];
        $estado = $_POST['listEstado'];
        $listNacionalidad = $_POST['listNacionalidad'];
        $telef_contacto = $_POST['listTelefContacto'];
        $direccion = $_POST['listDireccion'];
        $comprobanteApellido = 0;
        $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ_ ÁÉÍÓÚ";
        $nacimientofe = date("Y", strtotime($_POST['fecha_nac']));
        $comprobantefe = date("Y");
        $comprobantefe = $comprobantefe - 6;
        if($nacimientofe < 2001 || $nacimientofe > $comprobantefe){
            $respuesta = array('status' => false,'msg' => 'Fecha no valida');            

        } else{
            for($i=0; $i<strlen($apellido); $i++){
                if (strpos($permitidos, substr($apellido,$i,1))===false){
                    $comprobanteApellido = 1;
                }
            }
            for($i=0; $i<strlen($nombre); $i++){
                if (strpos($permitidos, substr($nombre,$i,1))===false){
                    $comprobanteApellido = 1;
                }
            }
            
            if($comprobanteApellido == 1){
                $respuesta = array('status' => false,'msg' => 'El Apellido o el Nombre no es valido');            
            } else{
                for($i=0; $i<strlen($lugarNac); $i++){
                    if (strpos($permitidos, substr($lugarNac,$i,1))===false){
                        $comprobanteApellido = 1;
                    }
                }
                for($i=0; $i<strlen($entidadFederal); $i++){
                    if (strpos($permitidos, substr($entidadFederal,$i,1))===false){
                        $comprobanteApellido = 1;
                    }
                }
                if($comprobanteApellido == 1){
                    $respuesta = array('status' => false,'msg' => 'El Lugar de Nacimiento o la Entidad Federal no es valido');            
                }else{

                    $cedulaes = $cedulaes * 1;
                    
                    if (($cedulaes < 20000000) || ($cedulaes > 30000000000) || ($cedu_estudiantil < 20000000) || ($cedu_estudiantil > 30000000000)){
                            $respuesta = array('status' => false,'msg' => 'El número de cédula de identidad o estudiantil no es valido');
                        } else {
                            $sql = 'SELECT * FROM alumnos WHERE (cedu_estudiantil = ? || cedulaes = ?) AND nacionalidad = ? AND alumno_id != ? AND estadoes !=0';
                            $query = $pdo->prepare($sql);
                            $query->execute(array($cedu_estudiantil,$cedulaes,$listNacionalidad,$idalumno));
                            $result = $query->fetch(PDO::FETCH_ASSOC);
                    
                            if($result > 0){
                                $respuesta = array('status' => false,'msg' => 'Información de éste estudiante ya se encuentra registrada');
                            } else {
                                if($idalumno == 0){
                                    $sqlInsert = 'INSERT INTO alumnos (apellido_alumno,nombre_alumno,lugarNac,municipio,entidadFederal,cedulaes,sexo,fecha_nac,estadoes,nacionalidad,cedu_estudiantil,telefono_contacto,direccion_vivienda) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
                                    $queryInsert = $pdo->prepare($sqlInsert);
                                    $request = $queryInsert->execute(array($apellido,$nombre,$lugarNac,$municipio,$entidadFederal,$cedulaes,$listSexo,$fecha_nac,$estado,$listNacionalidad,$cedu_estudiantil,$telef_contacto,$direccion));
                                    $accion = 1;
                                } else {
                                        $sqlUpdate = 'UPDATE alumnos SET apellido_alumno = ?,nombre_alumno = ?,lugarNac = ?,municipio = ?,entidadFederal = ?,cedulaes = ?,sexo = ?,fecha_nac = ?,estadoes = ?,nacionalidad = ?,cedu_estudiantil = ?,telefono_contacto = ?,direccion_vivienda = ? WHERE alumno_id = ?';
                                        $queryUpdate = $pdo->prepare($sqlUpdate);
                                        $request = $queryUpdate->execute(array($apellido,$nombre,$lugarNac,$municipio,$entidadFederal,$cedulaes,$listSexo,$fecha_nac,$estado,$listNacionalidad,$cedu_estudiantil,$telef_contacto,$direccion,$idalumno));
                                        $accion = 2;
                                }
                                
                                if($request > 0) {
                                    if($accion == 1) {
                                        $respuesta = array('status' => true,'msg' => 'Alumno creado correctamente');
                                    } else {
                                        $respuesta = array('status' => true,'msg' => 'Alumno actualizado correctamente');
                                    }
                    
                                } else {
                                    $respuesta = array('status' => false,'msg' => 'Error al crear Alumno');
                                }
                    
                            }
                        }
                    }
                }
            }
        }
        echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
    }