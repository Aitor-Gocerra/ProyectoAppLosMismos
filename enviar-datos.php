<?php

    require "config.php";
    $conexion->select_db("los_mismos");

    // Verifico que el $_Post me esta mandando datos que yo creo obligatorios
    if(!isset($_POST["tema"]) || !isset($_POST["grupo"]) || !isset($_POST["mensaje"])){
        die("Error: Faltan datos por rellenar");
    }

    // Verifico que haya seleccionado al menos un contacto
    if(!isset($_Post["contacto"]) || empty($_POST["contacto"])){
        header("Location: inicio.php");
    }

    $idTema = $_POST["tema"];
    $idGrupo = $_POST["grupo"];
    $texto = $_POST["mensaje"];
    $contactos = $_POST["contacto"];

    $sql = "INSERT INTO sugerencias (Texto, idTema, idGrupo) VALUES ('{$texto}', {$idTema}, {$idGrupo})";
    echo $sql;

    $resultado = $conexion->query($sql);

    /* Ya que los ID son AUTO_INCREMENT debo obtener el ultimo ID que has
    sido añadido para coger dicho ID y junto con cada elemento de
    array contacto[] guardarlo en mi tabla del multivaluado */

    $ultimoId = $conexion -> insert_id;
        
    foreach($_datos['contacto'] as $idContacto){
        $sqlContacto = "INSERT INTO SUGERENCIA_CONTACTO (idSugerencia, idContacto) VALUES (
            {$ultimoId}, {$idContacto}
        )";
        
        echo $sqlContacto;

        $resultadoContacto = $conexion->query($sqlContacto);

        if($resultadoContacto){
            echo "Contacto registrado correctamente";
        }else{
            echo "ERROR" . $conexion->error;
        }
    }
   
    $conexion->close();

?>
