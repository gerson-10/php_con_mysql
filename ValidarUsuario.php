<?php
declare(strict_types=1);
session_start();
include_once 'config.inc.php';

function validarUsuario(){
    $CORREO=strtoupper($_POST['email']);
    $CLAVE= strtoupper($_POST['pwd']);
    //$conexion = mysqli_connect("localhost","root","","dbpaginasweb")
    //or die("Hay un Error de conexion " . mysqli_error($conexion));
    $db=new Conect_Mysql();

    $sql = "SELECT * FROM tb_usuarios where correoe='".$CORREO."' and clave =MD5('".$CLAVE."')"
    or die("Error e la consulta " . mysqli_error($db));
    
    $resultado = $db->execute($sql);
    $numerofilas = mysqli_num_rows($resultado);

    if($numerofilas == 0){
        session_unset();
        echo '<script type="text/javascript"> alert("Usuario incorrecto"); 
        window.location.href="index.html"; </script>';
    
    }else{
        while($row = mysqli_fetch_array($resultado)){
            echo " <br>" .$row["CORREOE"] . " es valido </br>";
            $_SESSION['USUARIO_LOGUEADO'] = true;
            $_SESSION['LOGIN'] =$row["CORREOE"];
            $_SESSION['NOMBRE'] =$row["NOMBRECOMPLETO"];
            header("Location:solicitud.php");
            //echo '<script type="text/javascript">
            //windows.location.href="solicitud.php"; </script>';
        }
    }
    mysqli_close($db);
}
validarUsuario();
?>