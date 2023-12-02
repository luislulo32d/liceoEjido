document.addEventListener('DOMContentLoaded',function(){
    table_estadisticas =  $('#table_estadisticas').DataTable({
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
    var table_estadisticas =  document.querySelector('#table_estadisticas');
    table_estadisticas.onsubmit = function(e) {
        e.preventDefault();

        var estadistica_id = document.querySelector('#estadistica_id').value;

        var e_1 = document.querySelector('#e_1').value;
        
        var e_2 = document.querySelector('#e_2').value;
        
        var e_3 = document.querySelector('#e_3').value;
        
        var e_4 = document.querySelector('#e_4').value;

        var e_5 = document.querySelector('#e_5').value;


        if(e_1 == '' || e_2 == '' || e_3 == '' || e_4 == '' || e_5 == ''){
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = window.location.origin +'/liceoEjido/administrador/models/estadisticas/ajax-estadisticas.php';
        var form = new FormData(formEstadistica);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalEstadistica').modal('hide');
                    formEstadistica.reset();
                    swal('Estadistica',data.msg,'success');
                    location.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }

})

function openModalEstadistica(){
    document.querySelector('#estadistica_id').value = 0;
    document.querySelector('#formEstadistica').reset();
    $('#modalEstadistica').modal('show');

}

window.addEventListener('load',function(){
    showE_1();
    showE_2();
    showE_3();
    showE_4();
    showE_5();
    //showFemeninos();
    //showFechaHora();
},false)

//ver masculinos y femeninos de primer año
function showE_1() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-estadistica-1.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            document.querySelector('#e_1').innerHTML = data;
        }
    }
}

function showE_2() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-estadistica-2.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            document.querySelector('#e_2').innerHTML = data;
        }
    }
}
function showE_3() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-estadistica-3.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            document.querySelector('#e_3').innerHTML = data;
        }
    }
}
function showE_4() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-estadistica-4.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            document.querySelector('#e_4').innerHTML = data;
        }
    }
}

function showE_5() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-estadistica-5.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            document.querySelector('#e_5').innerHTML = data;
        }
    }
}
