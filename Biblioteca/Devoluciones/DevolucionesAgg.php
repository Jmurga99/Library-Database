<!DOCTYPE html>
<html >
<head>

</head>
<body>
    <h1 align="center">Prestamos</h1>
        
    <form method="post">
        <center>
            <p>
            <select REQUIRED name="nacionalidad">
                <option value="V-">V-</option>
                <option value="E-">E-</option>
            </select>
            
            <input type="number" REQUIRED name="Cedula" placeholder="Cedula" min="999999" max="99999999"/>
            </p>

            <p>

                <input type="text" name="Titulo" placeholder="Titulo">
            </p>

            <p>

                <input type="text" name="Nombre" placeholder="Nombre del autor" pattern="[A-Za-z]{1,100}">
            </p>
            <p>

              <input type="text" name="Apellido" placeholder="Apellido del autor" pattern="[A-Za-z]{1,100}">
            </p>
            <p>

              <input type="text" name="Editorial" placeholder="Editorial">
            </p>
            <p>

              Tipo de prestamo:
              <select name="Tipo">
                <option value="Interno">Interno</option>
                <option value="Externo">Externo</option>
              </select>
            </p>

            <p>
                <input type="submit" value="Agregar">
          </p>
        </center>
    </form>

    <?php

    $con=new mysqli("localhost","root","","biblioteca");

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $idu=$_POST['nacionalidad'].$_POST['Cedula'];
        $tit=$_POST['Titulo'];
        $nom=$_POST['Nombre'];
        $apell=$_POST['Apellido'];
        $edi=$_POST['Editorial'];
        $tip=$_POST['Tipo'];

        //Revisa que exista el lector
        $query=$con->query("SELECT COUNT(ID_lec) AS Can FROM lectores WHERE Cedula='$idu'");
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

        $query=$con->query("SELECT ID_lec FROM lectores WHERE Cedula='$idu'");
        $resul=mysqli_fetch_assoc($query);
        $z=$resul['ID_lec'];

        //Obtiene la fecha de devolucion dependiendo del tipo de prestamo
        $fecha_a=date("y-m-d");
        if ($tip=='Externo') {
            $fecha=date("y-m-d",strtotime($fecha_a."+ 10 days"));

            $con->query("INSERT INTO rel_lec_lib VALUES ($z,$y,'$fecha','$tip')");
        }else {

            $con->query("INSERT INTO rel_lec_lib VALUES ($z,$y,'$fecha_a','$tip')");
        }

 


    }

    ?>
</body>
</html>