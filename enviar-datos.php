<?php

    require "config.php";
    $conexion->select_db("los_mismos");

    //Verificar que existan los datos obligatorios
    if (!isset($_POST["tema"]) || !isset($_POST["grupo"]) || !isset($_POST["mensaje"])) {
        die("Error: Faltan datos obligatorios");
    }

    $idTema = $_POST["tema"];
    $idGrupo = $_POST["grupo"];
    $texto = $_POST["mensaje"];

    if(isset($_POST["email"]) && $_POST["email"] != ""){
        $email = "'{$_POST["email"]}'";  // Con comillas porque es VARCHAR
    } else {
        $email = "NULL";  // Sin comillas porque NULL no es texto
    }

    $sql = "INSERT INTO sugerencias (Texto, Email, idTema, idGrupo) VALUES ('{$texto}',{$email}, {$idTema}, {$idGrupo})";
    echo $sql;

    $resultado = $conexion->query($sql);

    if($resultado > 0){
        echo "Insert creado correctamente";
    }else{
        echo "ERROR" . $conexion->error;
    }

    /* Ya que los ID son AUTO_INCREMENT debo obtener el ultimo ID que has
    sido añadido para coger dicho ID y junto con cada elemento de
    array contacto[] guardarlo en mi tabla del multivaluado */

    $ultimoId = $conexion -> insert_id;
    
    if(isset($_POST["contacto"]) && !empty($_POST["contacto"])){
        $contactos = $_POST["contacto"];

        foreach($contactos as $idContacto){
            $sqlContacto = "INSERT INTO SUGERENCIA_CONTACTO (idSugerencia, idContacto) VALUES ({$ultimoId}, {$idContacto})";
            
            $resultadoContacto = $conexion->query($sqlContacto);
            
            if($resultadoContacto){
                echo "Contacto registrado correctamente<br>";
            } else {
                echo "ERROR al registrar contacto: " . $conexion->error . "<br>";
            }
        }
    }else{
        echo "No se ha seleccionado ningun medio de contacto";
    }


    $conexion->close();

?>
