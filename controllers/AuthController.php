<?php
require_once 'models/User.php'; // Incluye el modelo User para manejar usuarios

class AuthController
{
    // Método para iniciar sesión
    public function login()
    {
        // Verifica si el formulario fue enviado con el método POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Conectar a la base de datos
            $database = new Database();
            $db = $database->getConnection();

            // Crear un objeto User
            $user = new User($db);

            // Obtener el email enviado desde el formulario
            $user->email = isset($_POST['email']) ? $_POST['email'] : "";

            // Verifica si el correo electrónico existe en la base de datos
            if ($user->emailExists()) {
                // Obtener la contraseña ingresada por el usuario
                $password = isset($_POST['password']) ? $_POST['password'] : "";

                // Verifica si la contraseña ingresada es correcta
                if (password_verify($password, $user->password)) {
                    // Iniciar sesión y guardar datos del usuario
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['username'] = $user->username;

                    // Redireccionar al dashboard
                    header("Location: index.php?route=dashboard");
                    exit;
                } else {
                    // Si la contraseña es incorrecta, redirige al login con un mensaje de error
                    $_SESSION['error'] = "Contraseña incorrecta.";
                    header("Location: index.php?route=login");
                    exit;
                }
            } else {
                // Si el email no existe, redirige al login con un mensaje de error
                $_SESSION['error'] = "El correo electrónico no existe.";
                header("Location: index.php?route=login");
                exit;
            }
        }
    }

    // Método para registrar un nuevo usuario
    public function register()
    {
        // Verifica si el formulario fue enviado con el método POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Conectar a la base de datos
            $database = new Database();
            $db = $database->getConnection();

            // Crear un objeto User
            $user = new User($db);

            // Obtener datos del formulario
            $user->username = isset($_POST['username']) ? $_POST['username'] : "";
            $user->email = isset($_POST['email']) ? $_POST['email'] : "";
            $user->password = isset($_POST['password']) ? $_POST['password'] : "";

            // Validar que los campos no estén vacíos
            if (empty($user->username) || empty($user->email) || empty($user->password)) {
                $_SESSION['error'] = "Por favor, complete todos los campos.";
                header("Location: index.php?route=register");
                exit;
            }

            // Verificar si el correo ya está registrado
            if ($user->emailExists()) {
                $_SESSION['error'] = "El correo electrónico ya está registrado.";
                header("Location: index.php?route=register");
                exit;
            }

            // Crear usuario en la base de datos
            if ($user->create()) {
                $_SESSION['success'] = "Registro exitoso. Ahora puede iniciar sesión.";
                header("Location: index.php?route=login");
                exit;
            } else {
                $_SESSION['error'] = "No se pudo completar el registro.";
                header("Location: index.php?route=register");
                exit;
            }
        }
    }

    // Método para cerrar sesión
    public function logout()
    {
        // Elimina todas las variables de sesión
        $_SESSION = array();

        // Destruye la sesión
        session_destroy();

        // Redirige al login
        header("Location: index.php?route=login");
        exit;
    }
}
?>
