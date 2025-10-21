<?php
    require "config.php";
        
    // 1. ELIMINAR la base de datos si existe

        $sql = "DROP DATABASE IF EXISTS los_mismos";

        if ($conexion->query($sql)) {
            echo "Base de datos eliminada correctamente";
        } else {
            echo "Error al eliminar: " . $conexion->error;
        }

    // 2. CREAR la base de datos

        $sql = "CREATE DATABASE los_mismos ";
        if ($conexion->query($sql)) {
            echo "Base de datos creada correctamente";
        } else {
            echo("Error al crear base de datos: " . $conexion->error);
        }

    // 3. Seleccionar la base de datos
        $conexion->select_db("los_mismos");

    // 4. CREAR tabla TEMAS

        $sql = "CREATE TABLE TEMAS (
            idTema TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Nombre VARCHAR(100) NOT NULL
        )";

        if ($conexion->query($sql)) {
            echo "Tabla TEMAS creada correctamente";
        } else {
            echo "Error al crear tabla TEMAS: " . $conexion->error;
        }

    // 5. CREAR tabla GRUPO

        $sql = "CREATE TABLE GRUPO (
            idGrupo TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Nombre VARCHAR(100) NOT NULL
        )";

        if ($conexion->query($sql)) {
            echo "Tabla GRUPO creada correctamente";
        } else {
            echo "Error al crear tabla GRUPO: " . $conexion->error;
        }

    // 6. CREAR tabla SUGERENCIAS

        $sql = "CREATE TABLE SUGERENCIAS (
            idSugerencia INT AUTO_INCREMENT PRIMARY KEY,
            Texto VARCHAR(250) NOT NULL,
            Fecha DATETIME NOT NULL DEFAULT NOW(),
            idTema TINYINT UNSIGNED NOT NULL,
            idGrupo TINYINT UNSIGNED NOT NULL,
            FOREIGN KEY (idTema) REFERENCES TEMAS(idTema),
            FOREIGN KEY (idGrupo) REFERENCES GRUPO(idGrupo)
        )";

        if ($conexion->query($sql)) {
            echo "Tabla SUGERENCIAS creada correctamente";
        } else {
            echo "Error al crear tabla SUGERENCIAS: " . $conexion->error;
        }

    // 7. Crear TABLA de la tabla CONTACTO

        $sql = "CREATE TABLE CONTACTO (
            idContacto SMALLINT UNSIGNED PRIMARY KEY,
            Nombre CHAR(20) NOT NULL
        )";

        if ($conexion->query($sql)) {
            echo "Tabla GRUPO creada correctamente";
        } else {
            echo "Error al crear tabla GRUPO: " . $conexion->error;
        }

    // 8. Crear TABLA del INTERMEDIA SUGERENCIAS_CONTACTO
        
        $sql = "CREATE TABLE SUGERENCIA_CONTACTO (
            idSugerencia INT,
            idContacto SMALLINT UNSIGNED,
            PRIMARY KEY (idSugerencia, idContacto),
            FOREIGN KEY (idSugerencia) REFERENCES Sugerencias (idSugerencia)
        )"; 

        if ($conexion->query($sql)) {
            echo "Tabla SUGERENCIAS_CONTACTO creada correctamente";
        } else {
            echo "Error al crear tabla SUGERENCIAS_CONTACTO: " . $conexion->error;
        }
            
    // 9. INSERCIÓN MASIVA - Tabla GRUPO

        $sql = "INSERT INTO GRUPO (Nombre) VALUES 
                ('Asociacion'),
                ('Comparsa')";

        if ($conexion->query($sql)) {
            echo "Grupos insertados correctamente";
        } else {
            echo "Error al insertar grupos: " . $conexion->error;
        }

    // 10. INSERCIÓN MASIVA - Tabla TEMAS

        $sql = "INSERT INTO TEMAS (Nombre) VALUES 
                ('Fiesta'),
                ('Baile'),
                ('Musica'),
                ('Normas'),
                ('Convivencias'),
                ('Traje')";

        if ($conexion->query($sql)) {
            echo "Temas insertados correctamente";
        } else {
            echo "Error al insertar temas: " . $conexion->error;
        }
    
    // 10. INSERCIÓN MASIVA - Tabla TEMAS

    $sql = "INSERT INTO CONTACTO (Nombre) VALUES 
            ('Youtube'),
            ('Amigo'),
            ('Revista'),
            ('Internet')";

    if ($conexion->query($sql)) {
        echo "Temas insertados correctamente";
    } else {
        echo "Error al insertar temas: " . $conexion->error;
    }
    

    // Cerrar conexión
        $conexion->close();
    
    // Nos dirigimos a nuestra pagina de inicio de php
    header("Location: inicio.php");
?>