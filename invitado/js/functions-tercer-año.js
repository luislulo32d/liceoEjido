document.addEventListener('DOMContentLoaded',function(){
    tableterceraño =  $('#tableterceraño').DataTable({
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
    var formTercerAño =  document.querySelector('#formTercerAño');
    formTercerAño.onsubmit = function(e) {
        e.preventDefault();

        var idterceraño = document.querySelector('#idterceraño').value;
        var listEstudiante = document.querySelector('#listEstudiante').value;
        var listAula = document.querySelector('#listAula').value;
        var listPeriodo = document.querySelector('#listPeriodo').value;
        var listNumero = document.querySelector('#listNumero').value;
        var listEstado = document.querySelector('#listEstado').value;
        
        if(listEstudiante == '' || listAula == '' || listPeriodo == ''){
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/administrador/models/tercer-año/ajax-tercer-año.php';
        var form = new FormData(formTercerAño);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalTercerAño').modal('hide');
                    formTercerAño.reset();
                    swal('TercerAño',data.msg,'success');
                    location.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalTercer(){
    document.querySelector('#idterceraño').value = 0;
    document.querySelector('#formTercerAño').reset();
    $('#modalTercerAño').modal('show');

}
window.addEventListener('load',function(){
    showAlumno();
    showAula();
    showPeriodo();
},false)

function editarTercerAño(id) {
    var idterceraño = id;

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/tercer-año/edit-tercer-año.php?idterceraño='+idterceraño;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idterceraño').value = data.data.tercer_id;
                    document.querySelector('#listEstudiante').value = data.data.alumno_id;
                    document.querySelector('#listAula').value = data.data.aula_id;
                    document.querySelector('#listPeriodo').value = data.data.periodo_id;
                    document.querySelector('#listNumero').value = data.data.numero_lista;
                    document.querySelector('#listEstado').value = data.data.statustr;
                    
                    $('#modalTercerAño').modal('show');
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
}
function eliminarTercerAño(id) {
    var idterceraño = id;

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
            var url = './models/tercer-año/delet-tercer-año.php';
            request.open('POST',url,true);
            var strData = "idterceraño="+idterceraño;
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

function aprobarTercerAño(id) {
    var idterceraño = id;

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
            var url = './models/tercer-año/apro-tercer-año.php';
            request.open('POST',url,true);
            var strData = "idterceraño="+idterceraño;
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

