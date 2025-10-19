<?php
    // Configuración de conexión
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $basedatos = "los_mismos";

    // Crear conexión
    $conexion = new mysqli($servidor, $usuario, $password, $basedatos);

    // Verificar conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta para obtener los temas
    $sql = "SELECT idTema, Nombre FROM TEMAS";
    echo $sql;
    $resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOS MISMOS</title>
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <a href="admin.html" class="btn-login">Admin</a>
        <img src="imagenes/logo.jpeg" alt="Logo Comparsa"><br>
        <form action="enviar-datos" method="POST">
            <h1>BUZON DE SUGERENCIAS</h1>
            
            <!-- Radio buttons -->
            <label>Elige una:</label>
            <input type="radio" id="asociacion" name="asociacion">
            <label for="asociacion">Asociacion</label>
            <input type="radio" id="comparsa" name="comparsa">
            <label for="comparsa">Comparsa</label>
            <br>
            <!-- Select/desplegable -->
            <label for="tema">Elige el tema a tratar:</label>
            <select id="tema" name="tema">
                <option value="">Selecciona...</option>
                <?php
                    // Generar opciones dinámicamente desde la base de datos
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_row()) {
                            echo '<option value="' . $fila[0] . '">' . 
                                 $fila[1] . '</option>';
                        }
                    } else {
                        echo '<option value="">No hay temas disponibles</option>';
                    }
                ?>
            </select>
            <br>
            <!-- Área de texto -->
            <label for="mensaje">Sugerencia:</label><br>
            <textarea id="mensaje" name="mensaje" rows="4"></textarea>
            <br>
            <!-- Checkbox -->
            <input type="checkbox" id="acepto" name="acepto" required>
            <label for="acepto">Acepto terminos y condiciones.</label>
            <p id="terminos">*La comparsa tratara sus datos de manera interna, protegiendolos y solo para uso informativo.</p>
            <br>
            <!-- Botones -->
            <button type="submit">Enviar</button>
            <button type="reset">Borrar</button>
            
        </form>
        <?php
            // Temas añadidos
            $sql = "SELECT idTema, Nombre FROM TEMAS";
            $resultado = $conexion->query($sql);
            
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_row()) {
                    echo $fila[0] . " - " . $fila[1] . "<br>";
                }
            }
        ?>
        <footer>
            <p>&copy; 2025 Aitor Gómez Cerrato - Todos los derechos reservados.</p>
        </footer>
    </body>
</html>
<?php
    // Cerrar conexión
    $conexion->close();
?>