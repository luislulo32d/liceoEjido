$('#tableperiodos').DataTable();
var tableperiodos;

document.addEventListener('DOMContentLoaded',function(){
    tableperiodos =  $('#tableperiodos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "ajax":{
            "url": window.location.origin +"/liceoEjido/administrador/models/periodos/table_periodos.php",
            "dataSrc":""
        },
        "columns": [
            {"data":"acciones"},
            {"data":"nombre_periodo"},
            {"data":"estado"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });

    var formPeriodo = document.querySelector('#formPeriodo');
    formPeriodo.onsubmit = function(e){
        e.preventDefault();

        var idperiodo = document.querySelector('#idperiodo').value;
        var nombre = document.querySelector('#nombre').value;
        var estado =  document.querySelector('#listEstado').value;
        

        if(nombre == '') {
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/periodos/ajax-periodos.php';
        var form = new FormData(formPeriodo);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalPeriodo').modal('hide');
                    formPeriodo.reset();
                    swal('Periodo',data.msg,'success');
                    tableperiodos.ajax.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalPeriodo(){
    document.querySelector('#idperiodo').value = 0;
    document.querySelector('#formPeriodo').reset();
    $('#modalPeriodo').modal('show');

}

function editarPeriodo(id) {
   var idperiodo = id;

   var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/periodos/edit-periodos.php?idperiodo='+idperiodo;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idperiodo').value = data.data.periodo_id;
                    document.querySelector('#nombre').value = data.data.nombre_periodo;
                    document.querySelector('#listEstado').value = data.data.estado;

                   $('#modalPeriodo').modal('show');   
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
} 
function eliminarPeriodo(id) {
    var idperiodo = id;

    swal({
        title: "Eliminar Periodo",
        text: "Realmente desea eliminar el periodo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/periodos/delet-periodos.php';
            request.open('POST',url,true);
            var strData = "idperiodo="+idperiodo;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal('Eliminar',data.msg,'success');
                        tableperiodos.ajax.reload();
                    } else {
                        swal('Atencion',data.msg,'error');
                    }
                }
            }
        }
    })
}