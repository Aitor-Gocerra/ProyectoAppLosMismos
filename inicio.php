<?php
    require "config.php";
    $conexion->select_db("los_mismos");

    // Verificar conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta para obtener los temas y el grupo
    $sql1 = "SELECT idTema, Nombre FROM TEMAS";
    //echo $sql1;
    $resultado1 = $conexion->query($sql1);
    $sql2 = "SELECT idGrupo, Nombre FROM GRUPO";
    //echo $sql2;
    $resultado2 = $conexion->query($sql2);
    $sql3 = "SELECT idContacto, Nombre FROM CONTACTO";
    //echo $sql3;
    $resultado3 = $conexion->query($sql3);
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
        <a href="admin.php" class="btn-login">Admin</a>
        <img src="imagenes/logo.jpeg" alt="Logo Comparsa"><br>
        <form action="enviar-datos.php" method="POST">
            <h1>BUZON DE SUGERENCIAS</h1>
            
            <!-- Radio buttons -->
            <label>Elige una:</label>
            <?php
                if ($resultado2->num_rows > 0) {
                    while ($filaGrupo = $resultado2->fetch_row()) {
                        echo '<input type="radio" id="'. $filaGrupo[0] . '"name= "grupo" value="' . $filaGrupo[0] . '"';
                        echo '<label ">' . $filaGrupo[1] . '</label>';
                    }
                }
            ?>
            <br>
            <!-- Select/desplegable -->
            <label for="tema">Elige el tema a tratar:</label>
            <select id="tema" name="tema">
                <option value="">Selecciona...</option>
                <?php
                    // Generar opciones
                    if ($resultado1->num_rows > 0) {
                        while ($fila = $resultado1->fetch_row()) {
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
            <!-- Email opcional -->
            <label for="email">Email de contacto (opcional):</label>
            <input type="email" id="email" name="email" placeholder="ejemplo@correo.com"><br>
            <!-- Email opcional -->
            <label for="email">Telefono:</label>
            <input type="tel" id="telefono" name="telefono"><br>
            <!-- Checkbox -->
            <label for="contacto">¿Como nos conociste?</label>
            <div id="contacto">
                <?php 
                    if($resultado3->num_rows > 0){
                        while($fila = $resultado3->fetch_row()){
                            echo '<input type="checkbox" name="contacto[]" value="' . $fila[0] . '"><label>' .$fila[1]. '</label>';
                        }
                    }
                ?>
                <!-- <input type="checkbox" name="contacto[]" value="youtube"><label>Youtube</label>
                <input type="checkbox" name="contacto[]" value="amigo"><label>Amigo</label>
                <input type="checkbox" name="contacto[]" value="revista"><label>Revista</label>
                <input type="checkbox" name="contacto[]" value="internet"><label>Internet</label> -->
            </div>
            <input type="checkbox" id="acepto" name="acepto" required>
            <label for="acepto">Acepto terminos y condiciones.</label>
            <p id="terminos">*La comparsa tratara sus datos de manera interna, protegiendolos y solo para uso informativo.</p>
            <br>
            <!-- Botones -->
            <button type="submit">Enviar</button>
            <button type="reset">Borrar</button>
            
        </form>
        <footer>
            <p>&copy; 2025 Aitor Gómez Cerrato - Todos los derechos reservados.</p>
        </footer>
    </body>
</html>
<?php
    // Cerrar conexión
    $conexion->close();
?>