window.addEventListener('load',function(){
    showGen_2();
    showGen_3();
    showGen_4();
    showGen_5();
    //showFemeninos();
    //showFechaHora();
},false)

//ver masculinos y femeninos de primer año
var genero_1_fem = function showGen_1() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-genero-1.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            return data;
        }
    }
}

function showGen_2() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-genero-2.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            document.querySelector('#genero_2').innerHTML = data;
        }
    }
}
function showGen_3() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-genero-3.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            document.querySelector('#genero_3').innerHTML = data;
        }
    }
}
function showGen_4() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-genero-4.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            document.querySelector('#genero_4').innerHTML = data;
        }
    }
}

function showGen_5() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-genero-5.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            
            document.querySelector('#genero_5').innerHTML = data;
        }
    }
}
