-- Creación de la base de datos
CREATE DATABASE schoolsnack;

-- Uso de la base de datos creada
USE schoolsnack;

-- Creación de la tabla 'usuarios'
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    contrasena VARCHAR(200) NOT NULL
);

-- Creación de la tabla 'productos'
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cantidad INT NOT NULL,
    producto VARCHAR(100) NOT NULL,
);
