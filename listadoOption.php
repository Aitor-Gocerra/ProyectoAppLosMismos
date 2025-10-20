<?php
    require "config.php";
    $conexion->select_db("los_mismos");
    
    // Temas añadidos
    $sql = "SELECT idTema, Nombre FROM TEMAS";
    $resultado = $conexion->query($sql);
    
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc(); 
        foreach($fila as $clave => $valor){
            echo $clave . " - " . $valor . "<br><br>";
        }
    }
?>