document.addEventListener('DOMContentLoaded',function(){
    tablealumnos =  $('#tablealumnos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "dom": "lBfrtip",
        "buttons": [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary",
                "exportOptions": {
                    "columns": [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                }
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a excel",
                "className": "btn btn-success",
                "exportOptions": {
                    "columns": [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                }
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger",
                "exportOptions": {
                    "columns": [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                }
            },{
                "extend": "csvHtml5",
                "text": "<i class='far fa-csv'></i> CSV",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info",
                "exportOptions": {
                    "columns": [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                }
            }
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
        
    });

    var formAlumno = document.querySelector('#formAlumno');
    formAlumno.onsubmit = function(e){
        e.preventDefault();

        var idalumno = document.querySelector('#idalumno').value;
        var apellido = document.querySelector('#apellido').value;
        var nombre = document.querySelector('#nombre').value;
        var lugarNac = document.querySelector('#lugarNac').value;
        var municipio = document.querySelector('#municipio').value;
        var entidadFederal = document.querySelector('#entidadFederal').value;
        var nacionalidad =  document.querySelector('#listNacionalidad').value;
        var cedulaes = document.querySelector('#cedulaes').value;
        var cedu_estudiantil = document.querySelector('#cedu_estudiantil').value;
        var listSexo = document.querySelector('#listSexo').value;
        var fecha_nac = document.querySelector('#fecha_nac').value;
        var estado =  document.querySelector('#listEstado').value;
        var telef_contacto =  document.querySelector('#listTelefContacto').value;
        var direccion =  document.querySelector('#listDireccion').value;
        

        if(apellido == '' || nombre == '' || lugarNac == '' || municipio == '' || entidadFederal == '' || nacionalidad == '' || cedulaes == '' || cedu_estudiantil == '' || listSexo == '' || fecha_nac == '' || estado == '' || telef_contacto == '' || direccion == ''){
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/alumnos/ajax-alumnos.php';
        var form = new FormData(formAlumno);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalAlumno').modal('hide');
                    formAlumno.reset();
                    swal('Alumno',data.msg,'success');
                    location.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalAlumno(){
    document.querySelector('#idalumno').value = 0;
    document.querySelector('#formAlumno').reset();
    $('#modalAlumno').modal('show');

}
function editarAlumno(id) {
   var idalumno = id;

   var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/alumnos/edit-alumnos.php?idalumno='+idalumno;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idalumno').value = data.data.alumno_id;
                    document.querySelector('#apellido').value = data.data.apellido_alumno;
                    document.querySelector('#nombre').value = data.data.nombre_alumno;
                    document.querySelector('#lugarNac').value = data.data.lugarNac;
                    document.querySelector('#municipio').value = data.data.municipio;
                    document.querySelector('#entidadFederal').value = data.data.entidadFederal;
                    document.querySelector('#listNacionalidad').value = data.data.nacionalidad;
                    document.querySelector('#cedulaes').value = data.data.cedulaes;
                    document.querySelector('#cedu_estudiantil').value = data.data.cedu_estudiantil;
                    document.querySelector('#listSexo').value = data.data.sexo;
                    document.querySelector('#fecha_nac').value = data.data.fecha_nac;
                    document.querySelector('#listEstado').value = data.data.estadoes;
                    document.querySelector('#listTelefContacto').value = data.data.telefono_contacto;
                    document.querySelector('#listDireccion').value = data.data.direccion_vivienda;


                   $('#modalAlumno').modal('show');   
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
} 
function eliminarAlumno(id) {
    var idalumno = id;

    swal({
        title: "Eliminar Alumno",
        text: "Realmente desea eliminar el alumno?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = window.location.origin +'/liceoEjido/administrador/models/alumnos/delet-alumnos.php';
            request.open('POST',url,true);
            var strData = "idalumno="+idalumno;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal('Eliminar',data.msg,'success');
                        location.reload();
                    } else {
                        swal('Atencion',data.msg,'error');
                    }
                }
            }
        }
    })
}