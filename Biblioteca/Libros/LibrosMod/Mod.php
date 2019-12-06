<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <h1 align="center">Libros</h1>

    <?php
        $con=new mysqli("localhost","root","","biblioteca");
        $idlib=$_REQUEST['id'];

        $query=$con->query("SELECT libros.ID_lib, Titulo, Nombre, Apellido, Editorial, Publicacion, Categoria, ejemplares, cota FROM libros, autores, editoriales, categoria, rel_lib_aut, rel_lib_cat, rel_lib_edi WHERE libros.ID_lib=rel_lib_aut.ID_lib AND autores.ID_a=rel_lib_aut.ID_a AND libros.ID_lib=rel_lib_edi.ID_lib AND editoriales.ID_e=rel_lib_edi.ID_e AND libros.ID_lib=rel_lib_cat.ID_lib AND categoria.ID_cat=rel_lib_cat.ID_cat AND libros.ID_lib=$idlib");

        $row=mysqli_fetch_assoc($query);
    ?>
        
    <form method="post">
        <center>
            <p>

                <input type="text" name="Titulo" placeholder='Titulo' value="<?php echo $row['Titulo'];?>">
            </p>

            <p>Año de publicacion:

                <select name="Año">
                <?php
                    $year=date("Y");
                    for ($i=$year; $i >= 1900; $i--) { 
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }

                ?>
                </select>
            </p>

            <p>

                <input type="text" name="AutorN" placeholder="Nombre del autor" value="<?php echo $row['Nombre'];?>">
            </p>

            <p>

              <input type="text" name="AutorA" placeholder="Apellido del autor" value="<?php echo $row['Apellido'];?>">
            </p>

            <p>

                <input type="text" name="Editorial" placeholder="Editorial" value="<?php echo $row['Editorial'];?>">
            </p>

            <p>
                
                <input type="text" name="Categoria" placeholder="Categoria" value="<?php echo $row['Categoria'];?>">
            </p>

            <p>

                <input type="text" name="Cantidad" placeholder="Cantidad de ejemplares" value="<?php echo $row['ejemplares'];?>">
            </p>
            <p>

              <input type="text" name="Cota" placeholder="Cota" value="<?php echo $row['cota'];?>">
            </p>
            <p>
                <input type="submit" value="Modificar">
            </p>
        </center>
    </form>

    
    <?php

        $con=new mysqli("localhost","root","","biblioteca");

        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $tit=$_POST['Titulo'];
            $year=$_POST['Año'];
            $autn=$_POST['AutorN'];
            $auta=$_POST['AutorA'];
            $edi=$_POST['Editorial'];
            $cat=$_POST['Categoria'];
            $can=$_POST['Cantidad'];
            $cot=$_POST['Cota'];

            //Se actualiza su registro
            $con->query("UPDATE libros SET Titulo='$tit', Publicacion='$year', ejemplares=$can, cota='$cot' WHERE ID_lib=$idlib");
            echo "Libro Modificado";

            //verificar si existen registros de autores iguales
            $query=$con->query("SELECT COUNT(ID_a) AS Resultado FROM autores WHERE Nombre='$autn' AND Apellido='$auta'");
            $resul=mysqli_fetch_assoc($query);

            $x=$resul['Resultado'];

            if ($x==0) {

                //Se agrega su registro
                $con->query("INSERT INTO autores(Nombre,Apellido) VALUES ('$autn','$auta')");
            }

            //verificar si existen registros de editoriales iguales
            $query=$con->query("SELECT COUNT(ID_e) AS Resultado FROM editoriales WHERE Editorial='$edi'");
            $resul=mysqli_fetch_assoc($query);

            $x=$resul['Resultado'];

            if ($x==0) {

                //Se agrega su registro
                $con->query("INSERT INTO editoriales(Editorial) VALUES ('$edi')");
            }

            //verificar si existen registros de categorias iguales
            $query=$con->query("SELECT COUNT(ID_cat) AS Resultado FROM categoria WHERE Categoria='$cat'");
            $resul=mysqli_fetch_assoc($query);

            $x=$resul['Resultado'];

            if ($x==0) {

                //Se agrega su registro
                $con->query("INSERT INTO categoria(Categoria) VALUES ('$cat')");
            }

            //Se obtiene el ID de cada elemento para las tablas de relacion
            $query=$con->query("SELECT ID_lib FROM libros WHERE Titulo='$tit' AND Publicacion=$year AND cota='$cot'");
            $resul=mysqli_fetch_assoc($query);

            $idlib=$resul['ID_lib'];

            $query=$con->query("SELECT ID_a FROM autores WHERE Nombre='$autn' AND Apellido='$auta'");
            $resul=mysqli_fetch_assoc($query);

            $ida=$resul['ID_a'];

            $query=$con->query("SELECT ID_e FROM editoriales WHERE Editorial='$edi'");
            $resul=mysqli_fetch_assoc($query);

            $ide=$resul['ID_e'];

            $query=$con->query("SELECT ID_cat FROM categoria WHERE Categoria='$cat'");
            $resul=mysqli_fetch_assoc($query);

            $idcat=$resul['ID_cat'];

            //Se actualizan las tablas relacion
            $con->query("UPDATE rel_lib_aut SET ID_a=$ida WHERE ID_lib=$idlib");
            $con->query("UPDATE rel_lib_edi SET ID_e=$ide WHERE ID_lib=$idlib");
            $con->query("UPDATE rel_lib_cat SET ID_cat=$idcat WHERE ID_lib=$idlib");
        }

    ?>

</body>
</html>