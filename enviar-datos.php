<?php

    require "config.php";
    $conexion->select_db("los_mismos");

    $_datos = [
        "idTema" => $_POST["tema"],
        "idGrupo" => $_POST["grupo"],
        "texto" => $_POST["mensaje"],
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

    $conexion->close();

?>
