<?php
require_once 'models/Course.php';

class CourseController
{
    // Muestra la lista de cursos con paginación
    public function index()
    {
        // Conectar a la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Inicializar el objeto Course
        $course = new Course($db);
        $course->user_id = $_SESSION['user_id']; // Filtrar por usuario

        // Configuración de paginación
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $records_per_page = 6;
        $from_record_num = ($records_per_page * $page) - $records_per_page;

        // Obtener cursos y contar total
        $stmt = $course->readAll($from_record_num, $records_per_page);
        $num = $stmt->rowCount();
        $total_rows = $course->countAll();
        $total_pages = ceil($total_rows / $records_per_page);

        // Incluir vista
        include_once 'views/courses/index.php';
    }

    // Muestra el formulario para crear un curso
    public function create()
    {
        include_once 'views/courses/create.php';
    }

    // Guarda un nuevo curso en la base de datos
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Conectar a la base de datos
            $database = new Database();
            $db = $database->getConnection();

            // Crear objeto Course y asignar valores
            $course = new Course($db);
            $course->name = $_POST['name'];
            $course->abbreviation = $_POST['abbreviation'];
            $course->classroom = $_POST['classroom'];
            $course->description = $_POST['description'];
            $course->user_id = $_SESSION['user_id'];

            // Manejo de imagen (base64)
            if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $image_data = file_get_contents($_FILES['icon']['tmp_name']);
                $course->icon = 'data:' . $_FILES['icon']['type'] . ';base64,' . base64_encode($image_data);
            } else {
                $course->icon = null;
            }

            // Guardar en la base de datos
            if ($course->create()) {
                $_SESSION['success'] = "Curso creado exitosamente.";
                header("Location: index.php?route=courses");
                exit;
            } else {
                $_SESSION['error'] = "No se pudo crear el curso.";
                header("Location: index.php?route=courses&action=create");
                exit;
            }
        }
    }

    // Muestra el formulario para editar un curso
    public function edit()
    {
        // Conectar a la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Obtener el curso por ID
        $course = new Course($db);
        $course->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID no especificado.');
        $course->user_id = $_SESSION['user_id'];

        // Si el curso existe, mostrar la vista de edición
        if ($course->readOne()) {
            include_once 'views/courses/edit.php';
        } else {
            $_SESSION['error'] = "Curso no encontrado o sin permisos.";
            header("Location: index.php?route=courses");
            exit;
        }
    }

    // Actualiza un curso en la base de datos
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Conectar a la base de datos
            $database = new Database();
            $db = $database->getConnection();

            // Crear objeto Course y asignar valores
            $course = new Course($db);
            $course->id = $_POST['id'];
            $course->name = $_POST['name'];
            $course->abbreviation = $_POST['abbreviation'];
            $course->classroom = $_POST['classroom'];
            $course->description = $_POST['description'];
            $course->user_id = $_SESSION['user_id'];

            // Manejo de imagen (base64) si se sube una nueva
            if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $image_data = file_get_contents($_FILES['icon']['tmp_name']);
                $course->icon = 'data:' . $_FILES['icon']['type'] . ';base64,' . base64_encode($image_data);
            }

            // Actualizar en la base de datos
            if ($course->update()) {
                $_SESSION['success'] = "Curso actualizado exitosamente.";
                header("Location: index.php?route=courses");
                exit;
            } else {
                $_SESSION['error'] = "No se pudo actualizar el curso.";
                header("Location: index.php?route=courses&action=edit&id=" . $course->id);
                exit;
            }
        }
    }

    // Elimina un curso de la base de datos
    public function delete()
    {
        if (isset($_GET['id'])) {
            // Conectar a la base de datos
            $database = new Database();
            $db = $database->getConnection();

            // Obtener curso por ID y usuario
            $course = new Course($db);
            $course->id = $_GET['id'];
            $course->user_id = $_SESSION['user_id'];

            // Intentar eliminar
            if ($course->delete()) {
                $_SESSION['success'] = "Curso eliminado exitosamente.";
            } else {
                $_SESSION['error'] = "No se pudo eliminar el curso.";
            }

            header("Location: index.php?route=courses");
            exit;
        }
    }
}
