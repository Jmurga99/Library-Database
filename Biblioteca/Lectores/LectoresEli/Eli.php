<?php

    $id=$_REQUEST['id'];

    $con= new mysqli("localhost","root","","biblioteca");

    $con->query("DELETE FROM rel_lec_lib WHERE ID_lec='$id'");
    $con->query("DELETE FROM rel_lec_tip WHERE ID_lec='$id'");
    $con->query("DELETE FROM lectores WHERE ID_lec='$id'");

    header("Location: LectoresEliConsulta.html");

?>