<?php 

    $idli=$_REQUEST['idlib'];
    $idle=$_REQUEST['idlec'];

    $con=new mysqli("localhost","root","","biblioteca");

    $con->query("DELETE FROM rel_lec_lib WHERE ID_lib=$idli AND ID_lec=$idle");

    header("Location: DevolucionesEliConsulta.html");
?> 