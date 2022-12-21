<!-- 
    ALUMNO: Nelzon Jorge Apaza Apaza
    CUI: 20190652 
    CURSO: DBP - GRUPO A - PRACTICA 6
 -->
<?php
    //PARTE DE COOKIES: Para poder ingresar los datos de color de fondo-----------
    $bg_color=$_GET["color"];
    setcookie('color_fondo',$bg_color,time()+60*60*24*365);
    //----------------
?>