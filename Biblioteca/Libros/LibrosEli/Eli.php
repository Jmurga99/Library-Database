<?php 
    $con=new mysqli("localhost","root","","biblioteca");

    $idlib=$_REQUEST['id'];

    $query=$con->query("SELECT libros.ID_lib AS Libro, Titulo, Publicacion, ejemplares, cota FROM libros, autores, editoriales, categoria, rel_lib_aut, rel_lib_cat, rel_lib_edi WHERE libros.ID_lib=rel_lib_aut.ID_lib AND autores.ID_a=rel_lib_aut.ID_a AND libros.ID_lib=rel_lib_edi.ID_lib AND editoriales.ID_e=rel_lib_edi.ID_e AND libros.ID_lib=rel_lib_cat.ID_lib AND categoria.ID_cat=rel_lib_cat.ID_cat AND libros.ID_lib=$idlib");
    while ($row=mysqli_fetch_assoc($query)) {

        $id=$row['Libro'];
        
        $con->query("DELETE FROM rel_lib_aut WHERE ID_lib =$id");
        $con->query("DELETE FROM rel_lib_edi WHERE ID_lib =$id");
        $con->query("DELETE FROM rel_lib_cat WHERE ID_lib =$id");   
        $con->query("DELETE FROM rel_lec_lib WHERE ID_lib =$id");  
        $con->query("DELETE FROM libros WHERE ID_lib = $id");

    } 
?>   