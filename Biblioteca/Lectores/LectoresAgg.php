<!DOCTYPE html>
<html >
<head>

</head>
<body>
  <h1 align="center">Lectores</h1>
  <form method="post" action="">
    <p align="center">
      <select REQUIRED name="nacionalidad">
        <option value="V-">V-</option>
        <option value="E-">E-</option>
      </select>
      
      <input type="number" REQUIRED name="Cedula" placeholder="Cedula" min="999999" max="99999999"/>
    </p>
    <p align="center">

      <input type="text" REQUIRED name="Nombre" placeholder="Nombre" pattern="[A-Za-z]{1,100}"/>
    </p>
    <p align="center">

      <input type="text" REQUIRED name="Apellido" placeholder="Apellido" pattern="[A-Za-z]{1,100}"/>
    </p>
    <p align="center">

      <input type="email" REQUIRED name="Correo" Placeholder="Correo" />
    </p>
    <p align="center">

      <input type="tel" REQUIRED name="Telefono" placeholder="Telefono" />
    </p>
    <p align="center">

      <select REQUIRED name="Tipo">
        <option value="Profesor">Profesor</option>
        <option value="Estudiante">Estudiante</option>
      </select>
    </p>
    <p align="center">
      <input type="submit" value="Agregar" />
    </p>
  </form>


  <?php

    $con=new mysqli("localhost","root","","biblioteca");
    if ($_SERVER['REQUEST_METHOD']=='POST') {
      $ced=$_POST['nacionalidad'].$_POST['Cedula'];
      $nom=$_POST['Nombre'];
      $apell=$_POST['Apellido'];
      $cor=$_POST['Correo'];
      $tel=$_POST['Telefono'];
      $tip=$_POST['Tipo'];

      //Verificar si ya existe el lector
      $query=$con->query("SELECT COUNT(ID_lec) AS ID  FROM lectores WHERE ID_lec='$ced'");
      $resul=mysqli_fetch_assoc($query);

      $x=$resul['ID'];
      if ($x==0) {

        //Agregar Lector
        $con->query("INSERT INTO lectores(Cedula, Nombre, Apellido, Correo, Telefono) VALUES ('$ced','$nom','$apell','$cor','$tel')");
        echo "Lector agregado";
      }else {

        echo "El usuario ya existe";
      }

      //Verificar si existe el tipo de lector
      $query=$con->query("SELECT COUNT(ID_t) AS ID FROM tipo_lector WHERE Tipo='$tip'");
      $resul=mysqli_fetch_assoc($query);

      $x=$resul['ID'];
      if ($x==0) {

        //Agregar el tipo de lector
        $con->query("INSERT INTO tipo_lector(tipo) VALUES ('$tip')");
      }

      //Agregar relacion tipo y lector
      $query=$con->query("SELECT ID_t FROM tipo_lector WHERE Tipo='$tip'");
      $resul=mysqli_fetch_assoc($query);

      $y=$resul['ID_t'];
    
      $query=$con->query("SELECT ID_lec FROM lectores WHERE Cedula='$ced'");
      $resul=mysqli_fetch_assoc($query);

      $z=$resul['ID_lec'];

      $con->query("INSERT INTO rel_lec_tip VALUES ($z,$y)");
    }

  ?>
</body>
</html>