<?php
    require "config.php";
    
    // Temas añadidos
    $sql = "SELECT idTema, Nombre FROM TEMAS";
    $resultado = $conexion->query($sql);
    
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_array(); 
        foreach($fila as $clave => $valor){
            echo $fila[$clave] . " - " . $fila[$valor] . "<br><br>";
        }
    }
?>