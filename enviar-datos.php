<?php

    require "config.php";
    $conexion->select_db("los_mismos");

    $_datos = [
        "idTema" => $_POST["tema"],
        "idGrupo" => $_POST["grupo"],
        "texto" => $_POST["mensaje"],
        "contacto" => $_POST["contacto"]
    ];

    $sql = "INSERT INTO sugerencias (Texto, idTema, idGrupo) VALUES (
        '{$_datos['texto']}', {$_datos['idTema']}, {$_datos['idGrupo']}
    )";
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

    $idSugerencia = $conexion -> insert_id;

    if(!empty($_datos['contacto'])){
        foreach($_datos['contacto'] as $contacto){
            $sqlContacto = "INSERT INTO Contacto (idSugerencia, Contacto) VALUES (
                    {$idSugerencia}, '{$contacto}'
                )";
            echo $sqlContacto;

            $resultadoContacto = $conexion->query($sqlContacto);

            if($resultadoContacto){
                echo "Contacto registrado correctamente";
            }else{
                echo "ERROR" . $conexion->error;
            }
        }
    }else{
        echo "No se ha seleccionado ningun medio de contacto";
    }

    $conexion->close();

?>
