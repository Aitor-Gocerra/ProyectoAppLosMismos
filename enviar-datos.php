<?php
    $_datos = [
        "idTema" => $_POST["tema"],
        "idGrupo" => $_POST["grupo"],
        "texto" => $_POST["mensaje"],
        "fecha" => new DATETIME(),
    ];

    $sql = "INSERT INTO sugerencias (texto, fecha) VALUES (
        'texto, fecha',
    )";
    echo $sql;
?>
