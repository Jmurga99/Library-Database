<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <center>
            <table border="1">
                <thead>
                    <th colspan="8"><h1>Libros</h1></th>
                </thead>
                <tbody>
                    <tr>
                        <td>Titulo</td>
                        <td>Nombre del autor</td>
                        <td>Apellido del autor</td>
                        <td>Editorial</td>
                        <td>Año de Publicacion</td>
                        <td>Categoria</td>
                        <td>Ejemplares</td>
                        <td>Cota</td>
                    </tr>

                    <?php

                        $con=new mysqli("localhost","root","","biblioteca");

                        $tit=$_POST['Titulo']."%";
                        $year=$_POST['Año']."%";
                        $autn=$_POST['AutorN']."%";
                        $auta=$_POST['AutorA']."%";
                        $edi=$_POST['Editorial']."%";
                        $cat=$_POST['Categoria']."%";
                        $cot=$_POST['Cota']."%";

                        $query=$con->query("SELECT Titulo, Nombre, Apellido, Editorial, Publicacion, Categoria, ejemplares, cota FROM libros, autores, editoriales, categoria, rel_lib_aut, rel_lib_cat, rel_lib_edi WHERE libros.ID_lib=rel_lib_aut.ID_lib AND autores.ID_a=rel_lib_aut.ID_a AND libros.ID_lib=rel_lib_edi.ID_lib AND editoriales.ID_e=rel_lib_edi.ID_e AND libros.ID_lib=rel_lib_cat.ID_lib AND categoria.ID_cat=rel_lib_cat.ID_cat AND Titulo LIKE '$tit' AND Nombre LIKE '$autn' AND Apellido LIKE '$auta' AND Editorial LIKE '$edi' AND Publicacion LIKE '$year' AND Categoria LIKE '$cat' AND cota LIKE '$cot'");

                        while ($row=mysqli_fetch_assoc($query)) {

                    ?>  
                    <tr>
                        <td><?php echo $row['Titulo']; ?></td>
                        <td><?php echo $row['Nombre']; ?></td>
                        <td><?php echo $row['Apellido']; ?></td>
                        <td><?php echo $row['Editorial']; ?></td>
                        <td><?php echo $row['Publicacion']; ?></td>
                        <td><?php echo $row['Categoria']; ?></td>
                        <td><?php echo $row['ejemplares']; ?></td>
                        <td><?php echo $row['cota']; ?></td>
                    </tr>      
                       <?php }?>
                </tbody>
            </table> 
        </center>   
    </body>
</html>