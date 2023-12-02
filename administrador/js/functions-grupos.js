document.addEventListener('DOMContentLoaded',function(){
    tablegrupos =  $('#tablegrupos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "ajax":{
            "url": window.location.origin + "/liceoEjido/administrador/models/grupos/table_grupos.php",
            "dataSrc":""
        },
        "columns": [
            {"data":"acciones"},
            {"data":"nombre_grupo"},
            {"data":"estado_grupos"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });

    var formGrupo = document.querySelector('#formGrupo');
    formGrupo.onsubmit = function(e){
        e.preventDefault();

        var idgrupo = document.querySelector('#idgrupo').value;
        var nombre = document.querySelector('#nombre').value;
        var estado =  document.querySelector('#listEstado').value;
        

        if(nombre == '') {
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/grupos/ajax-grupos.php';
        var form = new FormData(formGrupo);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalGrupo').modal('hide');
                    formGrupo.reset();
                    swal('Grupo',data.msg,'success');
                    tablegrupos.ajax.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalGrupos(){
    document.querySelector('#idgrupo').value = 0;
    document.querySelector('#formGrupo').reset();
    $('#modalGrupo').modal('show');

} 
function editarGrupo(id) {
   var idgrupo = id;

   var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/grupos/edit-grupos.php?idgrupo='+idgrupo;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idgrupo').value = data.data.grupo_id;
                    document.querySelector('#nombre').value = data.data.nombre_grupo;
                    document.querySelector('#listEstado').value = data.data.estado_grupos;

                   $('#modalGrupo').modal('show');   
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
} 
function eliminarGrupos(id) {
    var idgrupo = id;

    swal({
        title: "Eliminar Grupo",
        text: "Realmente desea eliminar el grupo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/grupos/delet-grupos.php';
            request.open('POST',url,true);
            var strData = "idgrupo="+idgrupo;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal('Eliminar',data.msg,'success');
                        tablegrupos.ajax.reload();
                    } else {
                        swal('Atencion',data.msg,'error');
                    }
                }
            }
        }
    })
}