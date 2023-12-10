DROP DATABASE TodoList;
CREATE DATABASE TodoList;
USE TodoList;

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Email VARCHAR(75) NOT NULL UNIQUE
);

CREATE TABLE Tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(50),
    Descripcion TEXT,
    Completado CHAR(2),
    Fecha_Vencimiento DATE,
    Usuario_ID INT,
    FOREIGN KEY (Usuario_ID) REFERENCES Usuarios(id)
);