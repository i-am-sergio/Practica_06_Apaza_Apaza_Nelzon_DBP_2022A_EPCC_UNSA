/* 
    ALUMNO: Nelzon Jorge Apaza Apaza
    CUI: 20190652 
    CURSO: DBP - GRUPO A - PRACTICA 6
*/
function cambiar_fondo() {//Función para cambiar el color
    var bg_color=document.getElementById('bg_color').value;//obtenemos la opción elegida
    document.body.style.background=bg_color;//definimos el background

    //USO de AJAX, funciones onreadystatechange,open, send
    if (window.XMLHttpRequest) {
        ajax=new XMLHttpRequest();
    }
    else{
        ajax=new XMLHttpRequest("Microsoft.XMLHTTP");
    }
    ajax.onreadystatechange=function(){
        if (ajax.readyState==4) {
            if (ajax.status!=200) {
                alert("Ocurrio un error");
            }
        }
    }
    //Junto con el doc en php
    ajax.open("GET","insertar_cookie.php?color="+bg_color);
    ajax.send(null);
};

//función para asignar a btnAgregar
function asignar(){
    btnAgregar=document.getElementById('bntAgregar');
    btnAgregar.addEventListener("click",asignar);
};