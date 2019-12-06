<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <center>
            <table border="1">
                <thead>
                    <th colspan="9"><h1>Prestamos</h1></th>
                </thead>
                <tbody>
                    <tr>
                        <td>Cedula</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Libro</td>
                        <td>Fecha de devolucion</td>
                        <td>Correo</td>
                        <td>Telefono</td>
                        <td>Tipo</td>
                        <td>Eliminar</td>
                    </tr>

                    <?php

                        $con=new mysqli("localhost","root","","biblioteca");

                        $ced=$_POST['nacionalidad'].$_POST['Cedula']."%";
                        $nom=$_POST['Nombre']."%";
                        $apell=$_POST['Apellido']."%";
                        $lib=$_POST['Libro']."%";
                        $fec=date("Y-m-d",strtotime($_POST['Fecha']));
                        $cor=$_POST['Correo']."%";
                        $tel=$_POST['Telefono']."%";
                        $tip=$_POST['Tipo']."%";

                        if ($fec=="1970-01-01") {
                            $fec="%";
                        }

                        $query=$con->query("SELECT lectores.ID_lec, libros.ID_lib, Cedula, Nombre, Apellido, Titulo, Dev, Correo, Telefono, Tipo FROM lectores, libros, rel_lec_lib WHERE lectores.ID_lec=rel_lec_lib.ID_lec AND libros.ID_lib=rel_lec_lib.ID_lib AND Cedula LIKE '$ced' AND Nombre LIKE '$nom' AND Apellido LIKE '$apell' AND Titulo LIKE '$lib' AND dev LIKE '$fec' AND Correo LIKE '$cor' AND Telefono LIKE '$tel' AND Tipo LIKE '$tip'");

                        while ($row=mysqli_fetch_assoc($query)) {
                            $fecha=date("d-m-Y",strtotime($row['Dev']));
                    ?>  
                    <tr>
                        <td><?php echo $row['Cedula']; ?></td>
                        <td><?php echo $row['Nombre']; ?></td>
                        <td><?php echo $row['Apellido']; ?></td>
                        <td><?php echo $row['Titulo']; ?></td>
                        <td><?php echo $fecha; ?></td>
                        <td><?php echo $row['Correo']; ?></td>
                        <td><?php echo $row['Telefono']; ?></td>
                        <td><?php echo $row['Tipo']; ?></td>
                        <td><a href="Eli.php?idlec=<?php echo $row['ID_lec'];?>&idlib=<?php echo $row['ID_lib'];?>">Eliminar</a></td>
                    </tr>      
                       <?php }?>
                </tbody>
            </table> 
        </center> 
        

    </body>
</html>