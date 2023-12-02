document.addEventListener('DOMContentLoaded',function(){
    tableNota =  $('#tableNota').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });
    
    var formNotas =  document.querySelector('#formNotas');
    formNotas.onsubmit = function(e) {
        e.preventDefault();

        var idnotas = document.querySelector('#idnotas').value;
        var idcursante = document.querySelector('#idcursante').value;
        var idcurso = document.querySelector('#idcurso').value;
        var listMateria = document.querySelector('#listMateria').value;
        var listPeriodo = document.querySelector('#listPeriodo').value;
        var nota1 = document.querySelector('#nota1').value;
        var nota2 = document.querySelector('#nota2').value;
        var nota3 = document.querySelector('#nota3').value;
        var estadonota = document.querySelector('#estadonota').value;
        var momento_nota = document.querySelector('#momento_nota').value;
        
        
        if(listMateria == '' || listPeriodo == ''){
            swal('Atencion','Campos materia, periodo y estado son obligatorios','error');
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/notas/ajax-notas.php';
        var form = new FormData(formNotas);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalNotas').modal('hide');
                    formNotas.reset();
                    swal('Nota',data.msg,'success');
                    location.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalNota(){
    document.querySelector('#idnotas').value = 0;
    document.querySelector('#formNotas').reset();
    $('#modalNotas').modal('show');

}
window.addEventListener('load',function(){
    showMateria();

},false)


function showMateria() {
    var idcurso = document.querySelector('#idcurso').value;
    if(idcurso == 1) {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-materia1.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.materia_id+'">'+valor.nombre_materia+'</option>';
            });
            document.querySelector('#listMateria').innerHTML = data;
            }
        }
    }else if(idcurso == 2) {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-materia2.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.materia_id+'">'+valor.nombre_materia+'</option>';
            });
            document.querySelector('#listMateria').innerHTML = data;
            }
        }
    }else if(idcurso == 3) {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-materia3.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.materia_id+'">'+valor.nombre_materia+'</option>';
            });
            document.querySelector('#listMateria').innerHTML = data;
            }
        }
    }else if(idcurso == 4) {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-materia4.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.materia_id+'">'+valor.nombre_materia+'</option>';
            });
            document.querySelector('#listMateria').innerHTML = data;
            }
        }
    }else if(idcurso == 5) {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-materia5.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.materia_id+'">'+valor.nombre_materia+'</option>';
            });
            document.querySelector('#listMateria').innerHTML = data;
            }
        }
    } else {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-materia.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.materia_id+'">'+valor.nombre_materia+';'+valor.año_seleccion+'</option>';
            });
            document.querySelector('#listMateria').innerHTML = data;
            }
        }
    }    
}


function editarNota(id) {
    var idnotas = id;

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/notas/edit-notas.php?idnotas='+idnotas;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idnotas').value = data.data.nota_id;
                    document.querySelector('#idcursante').value = data.data.alumno_id;
                    document.querySelector('#listMateria').value = data.data.materia_id;
                    document.querySelector('#listPeriodo').value = data.data.periodo_id;
                    document.querySelector('#nota1').value = data.data.nota1;
                    document.querySelector('#nota2').value = data.data.nota2;
                    document.querySelector('#nota3').value = data.data.nota3;
                    document.querySelector('#estadonota').value = data.data.estadonota;
                    document.querySelector('#momento_nota').value = data.data.momento_nota;

                    

                    
                    $('#modalNotas').modal('show');
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
}
function eliminarNota(id) {
    var idnotas = id;

    swal({
        title: "Eliminar Nota",
        text: "Realmente desea eliminar la nota?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/notas/delet-notas.php';
            request.open('POST',url,true);
            var strData = "idnotas="+idnotas;
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
