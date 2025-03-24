-- 1️⃣ Crear la base de datos edulink
CREATE DATABASE IF NOT EXISTS edulink;

-- 2️⃣ Usar la base de datos
USE edulink;

-- 3️⃣ Crear tabla users con ID autoincrementable
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4️⃣ Crear tabla courses con ID autoincrementable y user_id como clave foránea
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    abbreviation VARCHAR(20) NOT NULL,
    classroom VARCHAR(50) NOT NULL,
    description TEXT NULL,
    icon TEXT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insertar usuarios 
INSERT INTO users (username, email, password) VALUES
('Angel Castilla', 'angel.castilla@vallegrande.edu.pe', '$2a$12$s.5376pKHYFwDBCnRVq09uvidrKNlVGPnSc3TDuTHKDtgDIpBO/Dy'), --contraseña: hashed_password_1
('Angel Gabriel Castilla Sandoval', 'angelgabrielcastillasandoval4@vallegrande.edu.pe', '$2a$12$JTolx8mESOK8PEQ7ZwjVROJwcIDNSd4bg2K3k0allLEzF4wiTp7Pu'); --contraseña: hashed_password_2

-- Verificar los IDs generados para los usuarios
SELECT * FROM users;

-- Insertar cursos 
INSERT INTO courses (name, abbreviation, classroom, description, icon, user_id) VALUES
('Matemáticas', 'MAT', 'Aula 101', 'Curso de matemáticas básicas', 'data:image/png;base64,...', 1),
('Historia', 'HIST', 'Aula 202', 'Curso de historia universal', 'data:image/png;base64,...', 1),
('Física', 'FIS', 'Aula 303', 'Curso de física aplicada', 'data:image/png;base64,...', 2);

