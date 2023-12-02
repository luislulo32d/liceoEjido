document.addEventListener('DOMContentLoaded',function(){
    tableprimeraño =  $('#tableprimeraño').DataTable({
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
    var formPrimerAño =  document.querySelector('#formPrimerAño');
    formPrimerAño.onsubmit = function(e) {
        e.preventDefault();

        var idprimeraño = document.querySelector('#idprimeraño').value;
        var listEstudiante = document.querySelector('#listEstudiante').value;
        var listAula = document.querySelector('#listAula').value;
        var listPeriodo = document.querySelector('#listPeriodo').value;
        var listNumero = document.querySelector('#listNumero').value;
        var listEstado = document.querySelector('#listEstado').value;
        
        if(listEstudiante == '' || listAula == '' || listPeriodo == '' || listEstado == ''){
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/administrador/models/primer-año/ajax-primer-año.php';
        var form = new FormData(formPrimerAño);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalPrimerAño').modal('hide');
                    formPrimerAño.reset();
                    swal('PrimerAño',data.msg,'success');
                    location.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalPrimer(){
    document.querySelector('#idprimeraño').value = 0;
    document.querySelector('#formPrimerAño').reset();
    $('#modalPrimerAño').modal('show');

}
window.addEventListener('load',function(){
    showAlumno();
    showAula();
    showPeriodo();
},false)

function showAlumno() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = window.location.origin +'/administrador/models/options/options-alumno.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.alumno_id+'">'+valor.cedulaes+'; '+valor.apellido_alumno+'; '+valor.nombre_alumno+'</option>';
            });
            document.querySelector('#listEstudiante').innerHTML = data;
        }
    }
}

function showAula() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-aula.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.aula_id+'">'+valor.nombre_aula+'</option>';
            });
            document.querySelector('#listAula').innerHTML = data;
        }
    }
}

function showPeriodo() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-periodo.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.periodo_id+'">'+valor.nombre_periodo+'</option>';
            });
            document.querySelector('#listPeriodo').innerHTML = data;
        }
    }
}
function showProfesor() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-profesor.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.profesor_id+'">'+valor.cedula+';   '+valor.nombre+'</option>';
            });
            document.querySelector('#listProfesor').innerHTML = data;
        }
    }
}





function editarPrimerAño(id) {
    var idprimeraño = id;

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/primer-año/edit-primer-año.php?idprimeraño='+idprimeraño;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idprimeraño').value = data.data.primero_id;
                    document.querySelector('#listEstudiante').value = data.data.alumno_id;
                    document.querySelector('#listAula').value = data.data.aula_id;
                    document.querySelector('#listPeriodo').value = data.data.periodo_id;
                    document.querySelector('#listNumero').value = data.data.numero_lista;
                    document.querySelector('#listEstado').value = data.data.statuspr;
                    
                    $('#modalPrimerAño').modal('show');
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
}
function eliminarPrimerAño(id) {
    var idprimeraño = id;

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
            var url = './models/primer-año/delet-primer-año.php';
            request.open('POST',url,true);
            var strData = "idprimeraño="+idprimeraño;
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
function aprobarPrimerAño(id) {
    var idprimeraño = id;

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
            var url = './models/primer-año/apro-primer-año.php';
            request.open('POST',url,true);
            var strData = "idprimeraño="+idprimeraño;
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

