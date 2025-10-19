<?php
    $_datos = [
        "texto" => $_POST["nombre"],
        "apellidos" => $_POST["apellidos"],
        "telefono" => $_POST["telefono"],
        "direccion" => $_POST["direccion"],
        "deportes" => $_POST["deporte"]
    ];

    print_r($_datos);

    foreach ($_datos as $clave => $valor){
        echo $clave . ": ";
        if(is_array($valor)){
            foreach ($valor as $data){
            echo $data . " ";
            }
        }else{
            echo $valor;
        }
        echo '<br>';

    }
?>