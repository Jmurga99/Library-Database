<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <h1 align="center">Libros</h1>
        
    <form method="post" action="TablaLibros.php">
        <center>
            <p>

                <input type="text" name="Titulo" placeholder='Titulo'>
            </p>

            <p>Año de publicacion:

                <select name="Año">
                    <option value="">Año</option>
                <?php
                    //Genera opciones de año desde 1900 hasta ela año actual
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
                
                <input type="text" name="Categoria" placeholder="Categoria">
            </p>

            <p>

              <input type="text" name="Cota" placeholder="Cota">
            </p>
        
            <p>
                <input type="submit" value="Consultar">
            </p>
        </center>
    </form>

    

</body>
</html>