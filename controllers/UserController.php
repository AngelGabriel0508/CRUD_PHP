<?php
require_once 'models/User.php';
require_once 'models/Course.php';

class UserController
{

    // Mostrar la página de configuración de la cuenta del usuario
    public function showAccount()
    {
        // Obtener la conexión a la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Crear un objeto User y asignarle el ID del usuario en sesión
        $user = new User($db);
        $user->id = $_SESSION['user_id'];

        // Obtener los datos del usuario
        $user->readOne();

        // Incluir la vista de la cuenta del usuario
        include_once 'views/user/account.php';
    }

    // Cambiar la contraseña del usuario
    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener la conexión a la base de datos
            $database = new Database();
            $db = $database->getConnection();

            // Crear un objeto User y asignarle el ID del usuario en sesión
            $user = new User($db);
            $user->id = $_SESSION['user_id'];

            // Obtener los datos del usuario para verificar la contraseña actual
            if ($user->readOne()) {
                // Obtener la contraseña actual ingresada por el usuario
                $current_password = $_POST['current_password'];

                // Verificar si la contraseña ingresada coincide con la almacenada en la BD
                $user->emailExists(); // Esto obtiene la contraseña actual del usuario

                if (password_verify($current_password, $user->password)) {
                    // Verificar si las nuevas contraseñas coinciden
                    $new_password = $_POST['new_password'];
                    $confirm_password = $_POST['confirm_password'];

                    if ($new_password === $confirm_password) {
                        // Asignar la nueva contraseña al usuario y actualizar en la BD
                        $user->password = $new_password;

                        if ($user->updatePassword()) {
                            $_SESSION['success'] = "Contraseña actualizada exitosamente.";
                        } else {
                            $_SESSION['error'] = "No se pudo actualizar la contraseña.";
                        }
                    } else {
                        $_SESSION['error'] = "Las nuevas contraseñas no coinciden.";
                    }
                } else {
                    $_SESSION['error'] = "Contraseña actual incorrecta.";
                }
            } else {
                $_SESSION['error'] = "Usuario no encontrado.";
            }

            // Redireccionar a la página de cuenta
            header("Location: index.php?route=account");
            exit;
        }
    }

    // Eliminar la cuenta del usuario y todos sus cursos asociados
    public function deleteAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener la conexión a la base de datos
            $database = new Database();
            $db = $database->getConnection();

            // Crear objetos User y Course
            $user = new User($db);
            $course = new Course($db);

            // Asignar el ID del usuario en sesión
            $user->id = $_SESSION['user_id'];
            $course->user_id = $_SESSION['user_id'];

            // Eliminar todos los cursos del usuario (opcional si hay ON DELETE CASCADE en la BD)
            $course->deleteAllByUser();

            // Eliminar la cuenta del usuario
            if ($user->delete()) {
                // Cerrar la sesión del usuario
                session_destroy();

                // Iniciar sesión nuevamente para mostrar un mensaje de éxito
                session_start();
                $_SESSION['success'] = "Cuenta eliminada exitosamente.";

                // Redirigir a la página de inicio de sesión
                header("Location: index.php?route=login");
                exit;
            } else {
                $_SESSION['error'] = "No se pudo eliminar la cuenta.";
                header("Location: index.php?route=account");
                exit;
            }
        }
    }
}
