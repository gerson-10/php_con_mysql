<!DOCTYPE html>
<html lang="es">
<?php
include_once 'config.inc.php';
//include_once 'userfile.php';

$db= new Conect_MySql();
if (isset($_POST['Enviar'])) {
    $nombre_archivo = $_FILES['userfile']['name'];
    //$tipo = $_FILES['userfile']['type'];
    //$tamanio = $_FILES['userfile']['size'];
    $ruta = $_FILES['userfile']['tmp_name'];
    $destino = "Archivos/" . $nombre_archivo;
    if ($nombre_archivo != "") {
        if(!file_exists($destino)){
            if (copy($ruta, $destino)) {
                $correoi= $_POST['LOGIN'];
                $nombre_completo= $_POST['NOMBRECOMPLETO'];
                $motivo= $_POST['MOTIVO'];
                $codigo=$_POST['CODIGO'];
                $db=new Conect_MySql();
                $sql = "UPDATE tb_solicitud SET CORREOINGRESA='$correoi', NOMBREINGRESA ='$nombre_completo', 
                RUTAPDF='$destino', NOMBREARCHIVO='$nombre_archivo' WHERE ID_SOLICITUD='$codigo'";
                //.$datos['ID_SOLICITUD'];
                //ID_SOLICITUD='1'";
                //id_documento=".$_GET['id'] 
                //get_insert_id
                $query = $db->execute($sql);
                if($query){
                    echo "Se guardo correctamente";
                    }
                } else {
                echo "Error ";
            } 
        }else{
            echo "el archivo  ",$nombre_archivo,"  ya existe";
            
            echo "<br>seleccione otro archivo o renombrelo";
        }
    }else{
        echo "Agregue un archivo PDF";
    }

}
?>
<?php
session_start();

if (!isset($_SESSION['USUARIO_LOGUEADO'])){

    echo'<script type="text/javascript">  alert("usted no está logueado"); window.location.href="index.html";   </script>';
}
$USUARIO = $_SESSION['LOGIN'];
$NOMBRE = $_SESSION['NOMBRE'];
?>

<head>
    <title>Ingreso de Información</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
 </head>
<body>
<div align='center'>
                <div class="panel panel-primary">
                         <div class="panel-heading"></div>
                                 <div class="panel-body">
                                 <a href="cierre_session.php"><center><button><B>Cierre de Session</B></button></a>
                                 <a href="lista.php"><button><B>Desplegar Lista</B></button></a>
                                 <a href="solicitud.php"><button><B>Nueva Solicitud</B></button></a>
                         </div>
                 </div>
        </div><br>

<div align="center" class="contact1">
    <div class="container">


        <div class="head">

        </div>
        <span class="contact1-form-title">
					Solicitud de empleo
                </span><br>
                
        <div class="contact1-pic js-tilt" data-tilt>
            <img src="Images/logo.png" alt="IMG">
        </div>

        <!-- contact1-form   -->
        <form class="form-horizontal validate-form" action="" enctype="multipart/form-data" method="post">

				<span class="contact1-form-title">
					Datos de la solicitud
                </span>

            <div class="wrap-input1 validate-input" data-validate = "Las Placas son requeridas">
                <input class="input1" type="numero" name="CODIGO" placeholder="INGRESE CODIGO">
                <span class="shadow-input1"></span>
            </div>

            <div class="wrap-input1 validate-input">
                <input class="input1" type="text" name="LOGIN" value=" <?php echo $_SESSION['LOGIN']; ?>" >
                <span class="shadow-input1"></span>
            </div>

            <div class="wrap-input1 validate-input" >
                <input class="input1" type="text" name="NOMBRECOMPLETO" value=" <?php echo $_SESSION['NOMBRE']; ?>" >
                <span class="shadow-input1"></span>
            </div>

            <div class="wrap-input1 validate-input" data-validate = "Las Placas son requeridas">
                <input class="input1" type="text" name="MOTIVO" placeholder="Motivo Solicitud">
                <span class="shadow-input1"></span>
            </div>

            <!--span class="contact1-form-title">
					Datos del Empleado
				</span>
            <div class="container-contact1-form-btn">
                <button class="contact1-form-btn">
						<span>
							Enviar Informacion
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
                </button>
            </div-->

            <input type="hidden" name="MAX_FILE_SIZE" value="9000000" />
            <h5 class="bg-white">Seleccione el archivo que da vida a la solicitud, (formato PDF).</h5> 
            <input name="userfile" type="file" class="form-control" />
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <input type="submit" value="Enviar Solicitud" name="Enviar" />
                    <!--class="btn bg-white"/-->
                </div>
            </div>

        </form>
    </div>
</div>
<script src="Js/bootstrap.min.js"></script>
<script src="Js/jquery-3.4.1.min.js"></script>
</body>
</html>
