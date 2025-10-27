-- Crear la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS los_mismos;

-- Crear los usuarios
CREATE USER 'admin_app'@'localhost' IDENTIFIED BY 'admin123';
CREATE USER 'usuario_app'@'localhost' IDENTIFIED BY 'usuario123';
CREATE USER 'lector_app'@'localhost' IDENTIFIED BY 'lector123';

-- Asignar privilegios
-- Admin → todos los privilegios sobre la base
GRANT ALL PRIVILEGES ON los_mismos.* TO 'admin_app'@'localhost';

-- Usuario estándar → CRUD básico (pero solo en esta base)
GRANT SELECT, INSERT, UPDATE, DELETE ON los_mismos.* TO 'usuario_app'@'localhost';

-- Lector → solo SELECT (Para paneles de consulta publicos o informacion)
GRANT SELECT ON los_mismos.* TO 'lector_app'@'localhost';

-- Permisos sobre tabla específica
GRANT SELECT, INSERT ON bbdd.tabla TO 'usuario'@'localhost';

-- Permisos sobre columnas específicas
GRANT SELECT (columna, columna) ON bbdd.tabla TO 'usuario'@'localhost';

-- Aplicar los cambios
FLUSH PRIVILEGES;

-- (Opcional) Verificar
SHOW GRANTS FOR 'usuario_app'@'localhost';
SHOW GRANTS FOR 'lector_app'@'localhost';
SHOW GRANTS FOR 'admin_app'@'localhost';

-- Cambiar contraseña
ALTER USER 'usuario_app'@'localhost' IDENTIFIED BY 'nueva_password';

-- Bloquear/Desbloquear usuario
ALTER USER 'usuario_app'@'localhost' ACCOUNT LOCK;
ALTER USER 'usuario_app'@'localhost' ACCOUNT UNLOCK;

/* Si quieres quitar un permiso sin borrar el usuario, usa el comando REVOKE. */
REVOKE DELETE ON los_mismos.* FROM 'usuario_app'@'localhost';
FLUSH PRIVILEGES;

/* Si quieres quitarle todos los privilegios en la base, pero mantener el usuario: */
REVOKE ALL PRIVILEGES, GRANT OPTION FROM 'usuario_app'@'localhost';
FLUSH PRIVILEGES;

/* Crear un usuario con fecha de expiración: */
CREATE USER 'usuario_temporal'@'localhost'
IDENTIFIED BY 'temporal123'
PASSWORD EXPIRE INTERVAL 30 DAY;

/* O establecer una expiración directa de la cuenta (no solo de contraseña): */
ALTER USER 'usuario_app'@'localhost' ACCOUNT EXPIRE;

/* Para reactivarla: */
SHOW GRANTS FOR 'usuario_app'@'localhost';
