<!-- 
    ALUMNO: Nelzon Jorge Apaza Apaza
    CUI: 20190652 
    CURSO: DBP - GRUPO A - PRACTICA 6
 -->
<!-- Incluimos el otro archivo con la clase -->
<?php
    // Cargamos la base de datos
    include('Class_base_datos_Nelzon_Apaza.php');
    include("connection.php");
    $DB_HOST = $_ENV["DB_HOST"];
    $DB_USER = $_ENV["DB_USER"];
    $DB_PASSWORD = $_ENV["DB_PASSWORD"];
    $DB_NAME = $_ENV["DB_NAME"];
    $DB_PORT = $_ENV["DB_PORT"];
    //PARTE DE COOKIES para el color de Fondo:-----
    if (isset($_COOKIE['colorFondo'])) {
        $color=$_COOKIE['colorFondo'];
    }
    else{
        $color='white';
    }
    //--------------

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario Registro Clientes</title>
    <link rel="stylesheet" href="http://localhost/VSCODE_Desarrollo_Plataformas/Practica_06/CSS/CSS_Form_Nelzon_Apaza.css">
    <script type="text/javascript" src="http://localhost/VSCODE_Desarrollo_Plataformas/Practica_06/JS/JS_Form_Nelzon_Apaza.js"></script>
    <!-- Agregamos el archivo js de COOKIES -->
    <script type="text/javascript" src="http://localhost/VSCODE_Desarrollo_Plataformas/Practica_06/JS/JS_Form_Nelzon_Apaza_COOKIES.js"></script>
</head>
<body style="background:<?php echo $color; ?>">  <!--PARTE cookies: style="background:-->
    <div class="contenedor">
        <h2>Formulario de Registro</h2>
        <!-- Parte cookies: Para mostar una opciones a escoger de colores de fondo de la página------------- -->
        <select name="bg_color" id="bg_color" onchange="cambiar_fondo()">
            <option value="white"<?php if ($color=='white'){echo 'selected';}?>>Blanco</option>
            <option value="red"<?php if ($color=='red'){echo 'selected';}?>>Rojo</option>
            <option value="blue"<?php if ($color=='blue'){echo 'selected';}?>>Azul</option>
            <option value="yellow"<?php if ($color=='yellow'){echo 'selected';}?>>Amarillo</option>
            <option value="green"<?php if ($color=='green'){echo 'selected';}?>>Verde</option>
        </select>
        <!-- ------------- -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- Solicitiamos información con POST del SERVER 'PHP_SELF' -->
            <div class="relleno">
                <div class="col_50">
                    <input class="campos" id="dni" name="dni" type="text" placeholder="DNI...">
                </div>
                <div class="col_50">
                    <input class="campos" id="nombres" name="nombres" type="text" placeholder="Nombre...">
                </div>
                <div class="col_50">
                    <input class="campos" id="apellidos" name="apellidos" type="text" placeholder="Apellido...">
                </div>
                <div class="col_50">
                    <input class="campos" id="email" name="email" type="text" placeholder="Email...">
                </div>
                <div class="col_50">
                    <input class="campos" id="telefono" name="telefono" type="text" placeholder="Teléfono...">
                </div>
                <button id=8"btnAgregar" class="btn" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <h2>Clientes Registrados</h2>  <!-- Stylesheet -->
    <table id="tablaUsuarios" class="tabla">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody id="contenido"><!--para AJAX-->
            <?php
                // ESTA PARTE TIENE QUE VER CON LA CLASE CREADA
                $BaseDatos = new base_datos("$DB_HOST","$DB_USER","$DB_PASSWORD","$DB_NAME","$DB_PORT");
                // $BaseDatos=new base_datos("localhost","root","administrador","lab06_data_base_dbp");//trabajamos con la base de datos creda anteriormente
                $BaseDatos->conectar();

                if ($_SERVER["REQUEST_METHOD"]=="POST") {
                    $dni=$_POST["dni"];
                    $nom=$_POST["nombres"];
                    $apel=$_POST["apellidos"];
                    $email=$_POST["email"];
                    $telefono=$_POST["telefono"];
            
                    $BaseDatos->insCliente($dni,$nom,$apel,$email,$telefono);
                }

                $clientes=$BaseDatos->getClientes();
                if (!is_null($clientes)) {
                    while ($row = mysqli_fetch_assoc($clientes)) {
                        echo "<tr>";
                        echo "<td>".$row["dni"]."</td>";
                        echo "<td>".$row["nombres"]."</td>";
                        echo "<td>".$row["apellidos"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        echo "<td>".$row["telefono"]."</td>";
                        echo "</tr>";
                    }
                }
                
                $BaseDatos->cerrar();
            ?>
        </tbody>
    </table>
</body>
</html>