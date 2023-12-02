$('#tableaulas').DataTable();
var tableaulas;

document.addEventListener('DOMContentLoaded',function(){
    tableaulas =  $('#tableaulas').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "ajax":{
            "url": window.location.origin +"/liceoEjido/administrador/models/aulas/table_aulas.php",
            "dataSrc":""
        },
        "columns": [
            {"data":"acciones"},
            {"data":"aula_id"},
            {"data":"nombre_aula"},
            {"data":"estado"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });

    var formAula = document.querySelector('#formAula');
    formAula.onsubmit = function(e){
        e.preventDefault();

        var idaula = document.querySelector('#idaula').value;
        var nombre = document.querySelector('#nombre').value;
        var estado =  document.querySelector('#listEstado').value;
        

        if(nombre == '') {
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/aulas/ajax-aulas.php';
        var form = new FormData(formAula);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalAula').modal('hide');
                    formAula.reset();
                    swal('Aula',data.msg,'success');
                    tableaulas.ajax.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalAula(){
    document.querySelector('#idaula').value = 0;
    document.querySelector('#formAula').reset();
    $('#modalAula').modal('show');

} 
function editarAula(id) {
   var idaula = id;

   var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/aulas/edit-aulas.php?idaula='+idaula;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idaula').value = data.data.aula_id;
                    document.querySelector('#nombre').value = data.data.nombre_aula;
                    document.querySelector('#listEstado').value = data.data.estado;

                   $('#modalAula').modal('show');   
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
} 
function eliminarAula(id) {
    var idaula = id;

    swal({
        title: "Eliminar Aula",
        text: "Realmente desea eliminar el aula?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/aulas/delet-aulas.php';
            request.open('POST',url,true);
            var strData = "idaula="+idaula;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal('Eliminar',data.msg,'success');
                        tableaulas.ajax.reload();
                    } else {
                        swal('Atencion',data.msg,'error');
                    }
                }
            }
        }
    })
}