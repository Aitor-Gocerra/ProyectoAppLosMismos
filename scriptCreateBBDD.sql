-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS Los_Mismos;
USE Los_Mismos;

-- Tabla TEMAS
CREATE TABLE Temas (
    idTema TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(80) NOT NULL
);

-- Tabla GRUPO
CREATE TABLE Grupo (
    idGrupo TINYINT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
    Nombre CHAR(15) NOT NULL
);

-- Tabla SUGERENCIAS
CREATE TABLE Sugerencias (
    idSugerencia INT AUTO_INCREMENT PRIMARY KEY,
    Texto VARCHAR(500) NOT NULL,
    Fecha DATETIME NOT NULL,
    idTema TINYINT UNSIGNED NOT NULL,
    idGrupo TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (idTema) REFERENCES TEMAS(idTema),
    FOREIGN KEY (idGrupo) REFERENCES GRUPO(idGrupo)
);

-- Insertar datos en la tabla GRUPO
INSERT INTO GRUPO (Nombre) VALUES 
    ('Asociacion'),
    ('Comparsa');

-- Insertar datos en la tabla TEMAS
INSERT INTO TEMAS (Nombre) VALUES 
    ('Fiesta'),
    ('Baile'),
    ('Musica'),
    ('Normas'),
    ('Convivencias'),
    ('Traje');