<!DOCTYPE html>
<html >
<head>

</head>
<body>

  <?php

  $idlec=$_REQUEST['id']; 
  $con=new mysqli("localhost","root","","biblioteca");

  $query=$con->query("SELECT * FROM lectores WHERE ID_lec=$idlec");
  $row=mysqli_fetch_assoc($query);


  ?>
  <h1 align="center">Lectores</h1>
  <form method="post">
  <p align="center">
      <input type="number" REQUIRED name="Cedula" placeholder="Cedula" min="999999" max="99999999" value="<?php echo $row['Cedula'];?>"/>
    </p>
    <p align="center">

      <input type="text" REQUIRED name="Nombre" placeholder="Nombre" pattern="[A-Za-z]{1,100}" value="<?php echo $row['Nombre'];?>"/>
    </p>
    <p align="center">

      <input type="text" REQUIRED name="Apellido" placeholder="Apellido" pattern="[A-Za-z]{1,100}" value="<?php echo $row['Apellido'];?>"/>
    </p>
    <p align="center">

      <input type="email" REQUIRED name="Correo" Placeholder="Correo" value="<?php echo $row['Correo'];?>"/>
    </p>
    <p align="center">

      <input type="tel" REQUIRED name="Telefono" placeholder="Telefono" value="<?php echo $row['Telefono'];?>"/>
    </p>
    <p align="center">

      <select REQUIRED name="Tipo">
        <option value="Profesor">Profesor</option>
        <option value="Estudiante">Estudiante</option>
      </select>
    </p>
    <p align="center">
      <input type="submit" value="Modificar" />
    </p>
  </form>
  <?php

    if ($_SERVER['REQUEST_METHOD']=='POST') {
      $ced=$_POST['Cedula'];
      $nom=$_POST['Nombre'];
      $apell=$_POST['Apellido'];
      $cor=$_POST['Correo'];
      $tel=$_POST['Telefono'];
      $tip=$_POST['Tipo'];

      //Verificar si ya existe el lector
      $query=$con->query("SELECT COUNT(ID_lec) AS Cuenta FROM lectores WHERE ID_lec=$ced");
      $resul=mysqli_fetch_assoc($query);

      $x=$resul['Cuenta'];
      if ($x==0) {

        //Agregar relacion tipo y lector
        $query=$con->query("SELECT ID_t FROM tipo_lector WHERE Tipo='$tip'");
        $resul=mysqli_fetch_assoc($query);
     
        $y=$resul['ID_t'];
     
        $con->query("UPDATE rel_lec_tip SET ID_t=$y WHERE ID_lec=$idlec");

        //Modificar Lector
        $con->query("UPDATE lectores SET Cedula='$ced', Nombre='$nom', Apellido='$apell', Correo='$cor', Telefono='$tel' WHERE ID_lec=$idlec");
        echo "Lector Modificado";
        header("Location: LectoresModConsulta.html");
      }else {

        echo "El usuario ya existe";
      }


 
    }

    
  ?>
  </body>
</html>