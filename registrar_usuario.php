<?php
include_once 'config.inc.php';

$CORREO=strtoupper($_POST ['correoe']);
$PSW = $_POST ['psw'];
$NOMBRECOMPLETO =strtoupper($_POST ['nombrecompleto']);
$db=new Conect_MySql();

$sql = "Insert into tb_usuarios(CORREOE,CLAVE,NOMBRECOMPLETO) values ('".$CORREO."',
MD5('".$PSW."'),'".$NOMBRECOMPLETO."')" or die("Error in the consult.." . mysqli_error($db));

$resultado = $db->execute($sql);

echo "Bienvenido ",$NOMBRECOMPLETO,"  " ;
echo "Su Usuario es:",$CORREO;
?>
<div align='center'>
                <div class="panel panel-primary">
                         <div class="panel-heading"></div>
                                 <div class="panel-body">
                                 <a href="index.html"><center><button><B>Ingresar</B></button></a>
                                 <a href="registra.php"><button><B>Registrar nuevo usuario</B></button></a>
                         </div>
                 </div>
        </div><br>