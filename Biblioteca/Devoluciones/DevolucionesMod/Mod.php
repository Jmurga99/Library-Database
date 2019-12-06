<!DOCTYPE html>
<html >
<head>

</head>
<body>
    <h1 align="center">Prestamos</h1>
     <?php 

          $idlib=$_REQUEST['idlib'];
          $idlec=$_REQUEST['idlec'];

          $con=new mysqli("localhost","root","","biblioteca");

          $query=$con->query("SELECT lectores.ID_lec, Cedula, libros.ID_lib, autores.Nombre, autores.Apellido, Titulo, Editorial, dev, Correo, Telefono FROM lectores, rel_lec_lib, libros, editoriales, autores, categoria, rel_lib_edi, rel_lib_cat, rel_lib_aut WHERE rel_lib_edi.ID_lib=libros.ID_lib AND rel_lib_cat.ID_lib=libros.ID_lib AND rel_lib_aut.ID_lib=libros.ID_lib AND lectores.ID_lec=rel_lec_lib.ID_lec AND libros.ID_lib=rel_lec_lib.ID_lib AND lectores.ID_lec='$idlec' AND libros.ID_lib=$idlib");
          $row=mysqli_fetch_assoc($query);

          ?>
        
    <form method="post">
        <center>
            <p>

                <input type="text" name="Cedula" placeholder="Cedula" value="<?php echo $row['Cedula']; ?>">
            </p>

            <p>

                <input type="text" name="Libro" placeholder="Libro" value="<?php echo $row['Titulo']; ?>">
            </p>
            

            <p>

                <input type="text" name="Nombre" placeholder="Nombre del autor" value="<?php echo $row['Nombre']; ?>" pattern="[A-Za-z]{1,100}">
            </p>
            <p>

              <input type="text" name="Apellido" placeholder="Apellido del autor" value="<?php echo $row['Apellido']; ?>" pattern="[A-Za-z]{1,100}">
            </p>
            <p>

              <input type="text" name="Editorial" placeholder="Editorial" value="<?php echo $row['Editorial']; ?>">
            </p>
            <p>
            <?php 

              $fec=date("Y-m-d",strtotime($row['dev']));

            ?>
            Fecha de Devolucion:
            <input type="date" name="Fecha" value="<?php echo $fec ?>">
          </p>
            <p>

              Tipo de prestamo:
              <select name="Tipo">
                <option value="Interno">Interno</option>
                <option value="Externo">Externo</option>
              </select>
            </p>

            <p>
                <input type="submit" value="Modificar">
          </p>
        </center>
    </form>

    <?php

    $con=new mysqli("localhost","root","","biblioteca");

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $ced=$_POST['Cedula'];
        $tit=$_POST['Libro'];
        $nom=$_POST['Nombre'];
        $apell=$_POST['Apellido'];
        $fec=$_POST['Fecha'];
        $edi=$_POST['Editorial'];
        $tip=$_POST['Tipo'];

        //Revisa que exista el lector
        $query=$con->query("SELECT COUNT(ID_lec) AS Can FROM lectores WHERE Cedula='$ced'");
        $resul=mysqli_fetch_assoc($query);
        
        $x=$resul['Can'];
        if ($x==0) {
            echo 'El lector no existe';
        }

        //Revisa que exista el libro
        $query=$con->query("SELECT COUNT(ID) AS Can FROM (SELECT libros.ID_lib as ID, Titulo, Nombre, Apellido, Editorial from libros, editoriales, autores, categoria, rel_lib_edi, rel_lib_cat, rel_lib_aut WHERE rel_lib_edi.ID_lib=libros.ID_lib and rel_lib_cat.ID_lib=libros.ID_lib and rel_lib_aut.ID_lib=libros.ID_lib) as Consulta WHERE Titulo='$tit' and Nombre='$nom' and Apellido='$apell' and Editorial='$edi'");
        $resul=mysqli_fetch_assoc($query);
        
        $x=$resul['Can'];
        if ($x==0) {
            echo 'El libro no existe';
        }

        //Busca el id del libro
        $query=$con->query("SELECT ID FROM (SELECT libros.ID_lib as ID, Titulo, Nombre, Apellido, Editorial from libros, editoriales, autores, categoria, rel_lib_edi, rel_lib_cat, rel_lib_aut WHERE rel_lib_edi.ID_lib=libros.ID_lib and rel_lib_cat.ID_lib=libros.ID_lib and rel_lib_aut.ID_lib=libros.ID_lib) as Consulta WHERE Titulo='$tit' and Nombre='$nom' and Apellido='$apell' and Editorial='$edi'");
        $resul=mysqli_fetch_assoc($query);

        $y=$resul['ID'];

        $query=$con->query("SELECT ID_lec FROM lectores WHERE Cedula='$ced'");
        $resul=mysqli_fetch_assoc($query);

        $z=$resul['ID_lec'];

        $con->query("UPDATE rel_lec_lib SET ID_lec=$z, ID_lib=$y, dev='$fec', Tipo='$tip' WHERE ID_lib=$idlib AND ID_lec=$idlec");

    }

    ?>
</body>
</html>