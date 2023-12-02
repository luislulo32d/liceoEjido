var tableprofesormateria;

document.addEventListener('DOMContentLoaded',function(){
    tableprofesormateria =  $('#tableprofesormateria').DataTable({
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

    var formProfesorMateria = document.querySelector('#formProfesorMateria');
    formProfesorMateria.onsubmit = function(e){
        e.preventDefault();

        var idprofesormateria = document.querySelector('#idprofesormateria').value;
        var nombre = document.querySelector('#listProfesor').value;
        var aula = document.querySelector('#listAula').value;
        var materia = document.querySelector('#listMateriaProfesor').value;
        var evaluaciones = document.querySelector('#listEvaluaciones').value;
        var estado =  document.querySelector('#listEstado').value;
        

        if(nombre == '' || aula == '' || materia == '' || estado == ''){
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/profesor-materia/ajax-profesor-materia.php';
        var form = new FormData(formProfesorMateria);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalProfesorMateria').modal('hide');
                    formProfesorMateria.reset();
                    swal('ProfesorMateria',data.msg,'success');
                    location.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalProfesorMateria(){
    document.querySelector('#idprofesormateria').value = 0;
    document.querySelector('#formProfesorMateria').reset();
    $('#modalProfesorMateria').modal('show');

}

window.addEventListener('load',function(){
    showProfesor();
    showAula();
    showMateriaProf();
    showPeriodo();
},false)

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


function showMateriaProf() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-materia-prof.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data  += '<option value="'+valor.materia_id+'">'+valor.siglas+'; '+valor.año_seleccion+'°</option>';
            });
            document.querySelector('#listMateriaProfesor').innerHTML = data;
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



function editarProfesorMateria(id) {
   var idprofesormateria = id;

   var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/profesor-materia/edit-profesor-materia.php?idprofesormateria='+idprofesormateria;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idprofesormateria').value = data.data.profesor_materia_id;
                    document.querySelector('#listProfesor').value = data.data.profesor_id;
                    document.querySelector('#listAula').value = data.data.aula_id;
                    document.querySelector('#listMateriaProfesor').value = data.data.materia_id;
                    document.querySelector('#listEvaluaciones').value = data.data.evaluaciones;
                    document.querySelector('#listEstado').value = data.data.estado_profesor_materia;

                   $('#modalProfesorMateria').modal('show');   
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
} 
function eliminarProfesorMateria(id) {
    var idprofesormateria = id;

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
            var url = './models/profesor-materia/delet-profesor-materia.php';
            request.open('POST',url,true);
            var strData = "idprofesormateria="+idprofesormateria;
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