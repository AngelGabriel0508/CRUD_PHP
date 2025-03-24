# CRUD_PHP

## Descripción
Este proyecto es una aplicación web en **PHP puro** (sin frameworks) que implementa un sistema de autenticación y un CRUD de cursos. Utiliza **MySQL** como base de datos y sigue el **patrón de diseño MVC** para mantener un código modular y organizado.

## Características Principales
- **Autenticación de Usuarios** (Login, Registro y Logout).
- **Gestor de cursos** con los campos: Id, Nombre, Abreviación, Aula, Descripción e Ícono.
- **Paginación Dinámica** para la lista de cursos.
- **Cambio de Contraseña** desde la configuración del usuario.
- **Eliminación de Cuenta** (Elimina al usuario y sus cursos asociados).
- **Base de Datos MySQL** con script de creación.

## Estructura del Proyecto

```
CRUD_PHP/
│── config/
│   ├── database.php   # Configuración y conexión a MySQL
│
│── controllers/
│   ├── AuthController.php   # Login, Registro y Logout
│   ├── CourseController.php # CRUD de Cursos (Lista, Crear, Editar, Eliminar)
│   ├── UserController.php   # Configuración de cuenta, Cambio de contraseña, Eliminar cuenta
│
│── models/
│   ├── User.php    # Modelo para usuarios (registro, autenticación, gestión de cuenta)
│   ├── Course.php  # Modelo para cursos (CRUD de cursos)
│
│── views/
│   ├── auth/       # Vistas de Login y Registro
│   ├── courses/    # Vistas del CRUD de cursos
│   ├── user/       # Vistas de configuración del usuario
│
│── index.php       # Punto de entrada y gestión de rutas
│── script.sql      # Script de creación de la Base de Datos y Tablas
```

## Tecnologías Utilizadas
- **PHP** (sin frameworks)
- **MySQL** (phpMyAdmin para la gestión de BD)
- **Patrón MVC** para modularidad del código

## Autor
[Angel Castilla] - [angelgabrielcastillasandoval4@gmail.com]
## Licencia
Este proyecto está bajo la Licencia MIT. Puedes usarlo y modificarlo libremente.

