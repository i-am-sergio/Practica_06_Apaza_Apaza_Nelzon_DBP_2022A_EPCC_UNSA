<!-- 
    ALUMNO: Nelzon Jorge Apaza Apaza
    CUI: 20190652 
    CURSO: DBP - GRUPO A - PRACTICA 6
 -->
<?php
    class base_datos {
        private $host;
        private $usua;
        private $pass;
        private $bd;
        private $port;

        private $conexion;

        function __construct($host,$usua,$pass,$bd,$port){
            $this->host=$host;
            $this->usua=$usua;
            $this->pass=$pass;
            $this->bd=$bd;
            $this->port=$port;
        }
        //Función para conectar clientes
        function conectar(){
            $this->conexion=mysqli_connect($this->host,$this->usua,$this->pass,$this->bd,$this->port);
            $this->conexion->set_charset("utf8");
            if (mysqli_connect_errno()) {//en el caso de que ocurra un error al conectarnos
                echo "Error al conectarse";
            }

        }

        //función para obtener datos de los clientes
        function getClientes(){
            $result=mysqli_query($this->conexion,"SELECT * FROM clientes");
            $error =mysqli_error($this->conexion);
            if (empty($error)) {
                if (mysqli_num_rows($result)>0) {//retorna el numero de filas o registros
                    //Retorna los requisitos en formato de array asociativo
                    return $result;
                }
            }
            else {
                echo "Error al obtener clientes";
            }
            return null;
        }

        //función para insertar clientes:
        function insCliente($dni,$nomb,$apel,$email,$telefono){
            /*
            Con el email, analizaremos cada caracter con un for
            */
            $contador_arroba=0;
            $contador_punto=0;
            for ($i=0; $i <strlen($email) ; $i++) { 
                if ($email[$i]=='@'){
                    $contador_arroba++;
                }
                if ($email[$i]=='.'){
                    $contador_punto++;
                }
            }

            if (empty($dni)|| empty($nomb) || empty($apel)|| empty($email)|| empty($telefono)) {
                echo '<script> alert("Todos los campos son obligatorios")</script>';
            }
            else if ($dni>=1000000000 ||$dni<100000000) {//DNI con 9 cifras
                echo '<script> alert("El DNI debe de tener 9 dígitos")</script>';
            }
            else if (strlen($nomb)<3 || strlen($apel)<3) {
                echo '<script> alert("Su nombre o apellidos debe tener más de 3 caracteres")</script>';
            }
            else if($contador_arroba!=1){
                echo '<script> alert("Correo Incorrecto")</script>';
            }
            else if($contador_punto<1){
                echo '<script> alert("Correo Incorrecto")</script>';
            }
            else if ($telefono>=1000000000 ||$telefono<100000000) {//telefono con 9 cifras
                echo '<script> alert("El TELÉFONO debe de tener 9 dígitos")</script>';
            }
            else {
                mysqli_query($this->conexion,"INSERT INTO `clientes`(`dni`, `nombres`, `apellidos`,`email`,`telefono`) VALUES ('$dni','$nomb','$apel','$email','$telefono')");
                $error=mysqli_error($this->conexion);
                if (empty($error)) {
                    return true;
                }
                else {
                    echo "Error al insertar cliente";
                    return false;
                }
            }
        }
        function cerrar(){
            mysqli_close($this->conexion);
        }
    }
?>
