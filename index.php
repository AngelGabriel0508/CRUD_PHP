<?php
session_start(); // Inicia la sesión para manejar autenticación y datos del usuario

// Incluir archivos de configuración y controladores
require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CourseController.php';
require_once 'controllers/UserController.php';

// Definir la ruta solicitada, si no se especifica, se usa 'home'
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Verificar si el usuario está autenticado
$isLoggedIn = isset($_SESSION['user_id']);

// Si el usuario no está autenticado y la ruta requiere autenticación, redirigir al login
if (!$isLoggedIn && !in_array($route, ['login', 'register', 'auth'])) {
    header('Location: index.php?route=login');
    exit;
}

// Si el usuario ya está autenticado e intenta acceder a login o register, redirigir al dashboard
if ($isLoggedIn && in_array($route, ['login', 'register'])) {
    header('Location: index.php?route=dashboard');
    exit;
}

// Manejo de rutas
switch ($route) {
    case 'home':
    case 'dashboard':
        // Si el usuario está autenticado, mostrar la lista de cursos
        if ($isLoggedIn) {
            $controller = new CourseController();
            $controller->index();
        } else {
            // Si no está autenticado, redirigir al login
            header('Location: index.php?route=login');
            exit;
        }
        break;

    case 'login':
        require_once 'views/auth/login.php'; // Cargar la vista de login
        break;

    case 'register':
        require_once 'views/auth/register.php'; // Cargar la vista de registro
        break;

    case 'auth':
        // Controlador de autenticación
        $controller = new AuthController();
        $action = isset($_POST['action']) ? $_POST['action'] : '';

        if ($action === 'login') {
            $controller->login(); // Procesar login
        } elseif ($action === 'register') {
            $controller->register(); // Procesar registro
        }
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout(); // Cerrar sesión
        break;

    case 'account':
        $controller = new UserController();
        $controller->showAccount(); // Mostrar la cuenta del usuario
        break;

    case 'change-password':
        $controller = new UserController();
        $controller->changePassword(); // Cambiar la contraseña del usuario
        break;

    case 'delete-account':
        $controller = new UserController();
        $controller->deleteAccount(); // Eliminar la cuenta del usuario
        break;

    case 'courses':
        // Controlador de cursos
        $controller = new CourseController();
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        switch ($action) {
            case 'create':
                $controller->create(); // Mostrar formulario para crear curso
                break;
            case 'store':
                $controller->store(); // Guardar nuevo curso en la base de datos
                break;
            case 'edit':
                $controller->edit(); // Mostrar formulario para editar curso
                break;
            case 'update':
                $controller->update(); // Actualizar curso en la base de datos
                break;
            case 'delete':
                $controller->delete(); // Eliminar curso
                break;
            default:
                $controller->index(); // Listar cursos
                break;
        }
        break;

    default:
        // Página no encontrada
        echo "404 - Page not found";
        break;
}
