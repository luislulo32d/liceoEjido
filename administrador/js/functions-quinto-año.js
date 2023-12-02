document.addEventListener('DOMContentLoaded',function(){
    tablequintoaño =  $('#tablequintoaño').DataTable({
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
                        "columns": [ 1, 2, 3, 4 ]
                    }
                },{
                    "extend": "excelHtml5",
                    "text": "<i class='fas fa-file-excel'></i> Excel",
                    "titleAttr": "Exportar a excel",
                    "className": "btn btn-success",
                    "exportOptions": {
                        "columns": [ 1, 2, 3, 4 ]
                    }
                },{
                    "extend": "pdfHtml5",
                    "text": "<i class='fas fa-pdf'></i> PDF",
                    "titleAttr": "Exportar a PDF",
                    "className": "btn btn-danger",
                    "exportOptions": {
                        "columns": [ 1, 2, 3, 4 ]
                    }
                },{
                    "extend": "csvHtml5",
                    "text": "<i class='far fa-csv'></i> CSV",
                    "titleAttr": "Exportar a CSV",
                    "className": "btn btn-info",
                    "exportOptions": {
                        "columns": [ 1, 2, 3, 4 ]
                    }
                }
            ],
            "responsive": true,
            "bDestroy": true,
            "iDisplayLength": 10,
            "order": [[0,"asc"]]
    });
    var formQuintoAño =  document.querySelector('#formQuintoAño');
    formQuintoAño.onsubmit = function(e) {
        e.preventDefault();

        var idquintoaño = document.querySelector('#idquintoaño').value;
        var listEstudiante = document.querySelector('#listEstudiante').value;
        var listAula = document.querySelector('#listAula').value;
        var listPeriodo = document.querySelector('#listPeriodo').value;
        var listNumero = document.querySelector('#listNumero').value;
        var listGrupos = document.querySelector('#listGrupos').value;
        var listEstado = document.querySelector('#listEstado').value;
        
        if(listEstudiante == '' || listAula == '' || listPeriodo == ''){
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/quinto-año/ajax-quinto-año.php';
        var form = new FormData(formQuintoAño);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalQuintoAño').modal('hide');
                    formQuintoAño.reset();
                    swal('QuintoAño',data.msg,'success');
                    location.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalQuinto(){
    document.querySelector('#idquintoaño').value = 0;
    document.querySelector('#formQuintoAño').reset();
    $('#modalQuintoAño').modal('show');

}
window.addEventListener('load',function(){
    showAlumno();
    showAula();
    showPeriodo();
    showGrupos();
},false)

function editarQuintoAño(id) {
    var idquintoaño = id;

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/quinto-año/edit-quinto-año.php?idquintoaño='+idquintoaño;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idquintoaño').value = data.data.quinto_id;
                    document.querySelector('#listEstudiante').value = data.data.alumno_id;
                    document.querySelector('#listAula').value = data.data.aula_id;
                    document.querySelector('#listPeriodo').value = data.data.periodo_id;
                    document.querySelector('#listNumero').value = data.data.numero_lista;
                    document.querySelector('#listGrupos').value = data.data.grupo_id;
                    document.querySelector('#listEstado').value = data.data.statusqn;
                    
                    $('#modalQuintoAño').modal('show');
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
}
function eliminarQuintoAño(id) {
    var idquintoaño = id;

    swal({
        title: "Eliminar Registro",
        text: "Realmente desea eliminar el registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/quinto-año/delet-quinto-año.php';
            request.open('POST',url,true);
            var strData = "idquintoaño="+idquintoaño;
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
function aprobarQuintoAño(id) {
    var idquintoaño = id;

    swal({
        title: "Aprobar",
        text: "Desea aprobar el estudiante? Recuerde estar seguro de que todas sus notas han sido correctamente registradas",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Si, Aprobar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/quinto-año/apro-quinto-año.php';
            request.open('POST',url,true);
            var strData = "idquintoaño="+idquintoaño;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal('Aprobar',data.msg,'success');
                        location.reload();
                    } else {
                        swal('Atencion',data.msg,'error');
                    }
                }
            }
        }
    })
}


