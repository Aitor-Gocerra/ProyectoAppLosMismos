<?php
    require "config.php";
    $conexion->select_db("los_mismos");

    // Obtener todas las sugerencias
    $sql = "SELECT SUGERENCIAS.idSugerencia, SUGERENCIAS.Texto, SUGERENCIAS.Email, SUGERENCIAS.Fecha, TEMAS.Nombre as Tema, GRUPO.Nombre as Grupo
                FROM SUGERENCIAS
                INNER JOIN TEMAS ON SUGERENCIAS.idTema = TEMAS.idTema
                INNER JOIN GRUPO ON SUGERENCIAS.idGrupo = GRUPO.idGrupo
                ORDER BY SUGERENCIAS.Fecha DESC";
    
    $resultado = $conexion->query($sql);

    $numFilas = $resultado->num_rows;

    // Contar las sugerencias
    // ?? con una funcion de agregado COUNT
    // o con un $resultado.lenght???

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Los Mismos</title>
    <link rel="stylesheet" href="estiloAdmin.css">
</head>
<body>
    <div class="contenedor">
        <a href="inicio.php" class="btn-volver">← Volver</a>

        <div id="cabecera">
            <h1>Panel de Administración</h1>
            <?php 
                echo "<h3>{$numFilas} sugerencias<h3>";
            ?>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Sugerencia</th>
                    <th>Tema</th>
                    <th>Grupo</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><strong>#{$fila['idSugerencia']}</strong></td>";
                            echo "<td>" . $fila['Fecha'] . "</td>";
                            echo "<td>{$fila['Texto']}</td>";
                            echo "<td><span class='tema'>{$fila['Tema']}</span></td>";
                            echo "<td><span class='grupo'>{$fila['Grupo']}</span></td>";
                            
                            if ($fila['Email']) {
                                echo "<td>{$fila['Email']}</td>";
                            } else {
                                echo "<td class='sin-email'>Sin email</td>";
                            }
                            
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center; padding:20px;'>
                              No hay sugerencias todavía</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
    $conexion->close();
?>