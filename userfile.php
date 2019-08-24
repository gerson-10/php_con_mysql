<!DOCTYPE html>
<html>
<?php
session_start();

if (!isset($_SESSION['USUARIO_LOGUEADO'])){

    echo'<script type="text/javascript">  alert("usted no está logueado"); window.location.href="index.html";   </script>';
}
$USUARIO = $_SESSION['LOGIN'];
$NOMBRE = $_SESSION['NOMBRE'];
?>
    <head>
        <meta charset="UTF-8">
        <title>visualizador de PDF</title>
        <link rel="stylesheet" href="Css/bootstrap.min.css">
    </head>
    <body>
        <div align='center'>
                <div class="panel panel-primary">
                         <div class="panel-heading"></div>
                                 <div class="panel-body">
                                 <a href="solicitud.php"><center><button><B>Ingresar otra Solicitud</B></button></a>
                                 <a href="lista.php"><button><B>Regresar a lista</B></button></a>
                                 <a href="cierre_session.php"><button><B>Cerrar Session</B></button></a>
                                 </div>
                 </div>
        </div><br>

        <?php
        include 'config.inc.php';
        $db=new Conect_MySql();
            $sql = "SELECT * FROM tb_solicitud where ID_SOLICITUD=".$_GET['id'];
            $query = $db->execute($sql);
            if($datos=$db->fetch_row($query)){
                if($datos['NOMBREARCHIVO']==""){?>
        <p>NO tiene archivos</p>
                <?php }else{ ?>
        <center><iframe width="1000" height="615" src="Archivos/<?php echo $datos['NOMBREARCHIVO']; ?>
        "frameborder="100"  allowfullscreen></iframe></center>               
                <?php } } ?><br>
    </body>
<script src="Js/bootstrap.min.js"></script>
<script src="Js/jquery-3.4.1.min.js"></script>
</html>