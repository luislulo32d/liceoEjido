$('#tableprofesores').DataTable();
var tableprofesores;

document.addEventListener('DOMContentLoaded',function(){
    tableprofesores =  $('#tableprofesores').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "ajax":{
            "url": window.location.origin +"/liceoEjido/administrador/models/profesores/table_profesores.php",
            "dataSrc":""
        },
        "columns": [
            {"data":"acciones"},
            {"data":"profesor_id"},
            {"data":"apellido"},
            {"data":"nombre"},
            {"data":"cedula"},
            {"data":"estadopr"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });

    var formProfesor = document.querySelector('#formProfesor');
    formProfesor.onsubmit = function(e){
        e.preventDefault();

        var idprofesor = document.querySelector('#idprofesor').value;
        var apellido = document.querySelector('#apellido').value;
        var nombre = document.querySelector('#nombre').value;
        var cedula = document.querySelector('#cedula').value;
        var estadopr =  document.querySelector('#listEstado').value;
        

        if(apellido == '' || nombre == '' || cedula == ''){
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url =  window.location.origin +'/liceoEjido/administrador/models/profesores/ajax-profesores.php';
        var form = new FormData(formProfesor);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalProfesor').modal('hide');
                    formProfesor.reset();
                    swal('Profesor',data.msg,'success');
                    location.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalProfesor(){
    document.querySelector('#idprofesor').value = 0;
    document.querySelector('#formProfesor').reset();
    $('#modalProfesor').modal('show');

}

function editarProfesor(id) {
   var idprofesor = id;

   var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/profesores/edit-profesores.php?idprofesor='+idprofesor;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idprofesor').value = data.data.profesor_id;
                    document.querySelector('#apellido').value = data.data.apellido;
                    document.querySelector('#nombre').value = data.data.nombre;
                    document.querySelector('#cedula').value = data.data.cedula;
                    document.querySelector('#listEstado').value = data.data.estadopr;

                   $('#modalProfesor').modal('show');   
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
} 
function eliminarProfesor(id) {
    var idprofesor = id;

    swal({
        title: "Eliminar Profesor",
        text: "Realmente desea eliminar el profesor?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = window.location.origin +'/liceoEjido/administrador/models/profesores/delet-profesor.php';
            request.open('POST',url,true);
            var strData = "idprofesor="+idprofesor;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal('Eliminar',data.msg,'success');
                        tableprofesores.ajax.reload();
                    } else {
                        swal('Atencion',data.msg,'error');
                    }
                }
            }
        }
    })
}