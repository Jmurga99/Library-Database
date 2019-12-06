<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <h1 align="center">Libros</h1>
        
    <form method="post" action="">
        <center>
            <p>

                <input type="text" name="Titulo" placeholder='Titulo'>
            </p>

            <p>Año de publicacion:

                <select name="Año">
                <?php

                    //Generar los años desde 1900 Hasta el añp actual
                    $year=date("Y");
                    for ($i=$year; $i >= 1900; $i--) { 
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }

                ?>
                </select>
            </p>

            <p>

                <input type="text" name="AutorN" placeholder="Nombre del autor" pattern="[A-Za-z]{1,100}">
            </p>

            <p>

              <input type="text" name="AutorA" placeholder="Apellido del autor" pattern="[A-Za-z]{1,100}">
            </p>

            <p>

                <input type="text" name="Editorial" placeholder="Editorial">
            </p>

            <p>
                
                <input type="text" name="Categoria" placeholder="Categoria" pattern="[A-Za-z]{1,100}">
            </p>

            <p>

                <input type="number" name="Cantidad" placeholder="Cantidad de ejemplares">
            </p>
            <p>

              <input type="text" name="Cota" placeholder="Cota">
            </p>
            <p>
                <input type="submit" value="Agregar">
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

            //verificar si existen registros de libros iguales
            $query=$con->query("SELECT COUNT(ID_lib) AS Resultado FROM libros WHERE Titulo='$tit' AND Publicacion=$year AND cota='$cot'");
            $resul=mysqli_fetch_assoc($query);
    
            $x=$resul['Resultado'];
    
            if ($x==0) {
    
                //Se agrega su registro
                $con->query("INSERT INTO libros(Titulo,Publicacion,ejemplares,cota) VALUES ('$tit',$year,$can,'$cot')");
                echo "Libro añadido";
            }else {
                echo "El libro ya existe";
            }
                
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

            //Se registra en las tablas relacion
            $con->query("INSERT INTO rel_lib_aut VALUES ($idlib,$ida)");
            $con->query("INSERT INTO rel_lib_edi VALUES ($idlib,$ide)");
            $con->query("INSERT INTO rel_lib_cat VALUES ($idlib,$idcat)");
        }

    ?>

</body>
</html>