/* 
    ALUMNO: Nelzon Jorge Apaza Apaza
    CUI: 20190652 
    CURSO: DBP - GRUPO A - PRACTICA 6
*/
const isEmpty=(str)=>str.trim()==='';

function agregar(){
    var dni=document.getElementById('dni');
    var nombres=document.getElementById('nombres');
    var apellidos=document.getElementById('apellidos');
    var email=document.getElementById('email');
    var telefono=document.getElementById('telefono');

    dniVal=dni.value;
    nombresVal=nombres.value;
    apellidosVal=apellidos.value;
    emailVal=email.value;
    telefonoVal=telefono.value;

    tablaUsuarios=document.getElementById('tablaUsuarios');

    //PARTE DE AJAX: Analizanso la parte con ID contenido --------
    var contenido=document.getElementById("contenido");
    if (window.XMLHttpRequest) {
        ajax=new XMLHttpRequest();
    }
    else{
        ajax=new ActiveXObject("Microsoft.XMLHTTP")
    }
    //Al hacer un acambio de leída
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4 && ajax.status==200){
            contenido.innerHTML=ajax.responseText;
        }
        else{
            contenido.innerHTML="<img width'50' height='50' src='http://localhost/VSCODE_Desarrollo_Plataformas/Practica_06/Sources/cargando.gif'";//imagen a cargar
        }
    }
    //Uso de comandos open, sentRequestHeader, y send
    ajax.open("GET","insertar_cookie.php");//documento a crear
    ajax.sentRequestHeader("Content-Type","application/x-www-forn-urlencoded");
    ajax.send("dni="+dniVal+"&nombres="+nombresVal+"&apellidos="+apellidosVal+"&emailVal="+emailVal+"&telefonoVal="+telefonoVal);//agregamos los demás datos
    //---------------------
};

//Parte ANTERIOR recolectada
function asignar() {
    while (agregar==1) {
        agregar();
    }
    btnAgregar=document.getElementById('btnAgregar');
    btnAgregar.addEventListener("click",agregar);
};
window.addEventListener("load",asignar)