<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <center>
            <table border="1">
                <thead>
                    <th colspan="6"><h1>Lectores</h1></th>
                </thead>
                <tbody>
                    <tr>
                        <td>Cedula</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Correo</td>
                        <td>Telefono</td>
                        <td>Tipo</td>
                    </tr>

                    <?php

                        $con=new mysqli("localhost","root","","biblioteca");

                        $ced=$_POST['nacionalidad'].$_POST['Cedula']."%";
                        $nom=$_POST['Nombre']."%";
                        $apell=$_POST['Apellido']."%";
                        $cor=$_POST['Correo']."%";
                        $tel=$_POST['Telefono']."%";
                        $tip=$_POST['Tipo']."%";


                        $query=$con->query("SELECT lectores.ID_lec, Cedula, Nombre, Apellido, Correo, Telefono, Tipo FROM lectores, tipo_lector, rel_lec_tip WHERE lectores.ID_lec=rel_lec_tip.ID_lec AND tipo_lector.ID_t=rel_lec_tip.ID_t AND Cedula LIKE '$ced' AND Nombre LIKE '$nom' AND Apellido LIKE '$apell' AND Correo LIKE '$cor' AND Telefono LIKE '$tel' AND Tipo LIKE '$tip'");

                        while ($row=mysqli_fetch_assoc($query)) {

                    ?>  
                    <tr>
                        <td><?php echo $row['Cedula']; ?></td>
                        <td><?php echo $row['Nombre']; ?></td>
                        <td><?php echo $row['Apellido']; ?></td>
                        <td><?php echo $row['Correo']; ?></td>
                        <td><?php echo $row['Telefono']; ?></td>
                        <td><?php echo $row['Tipo']; ?></td>
                    </tr>      
                       <?php }?>
                </tbody>
            </table> 
        </center>   
    </body>
</html>