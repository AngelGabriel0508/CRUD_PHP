<?php
class Course
{
    private $connection; // Conexión a la base de datos
    private $table_name = "courses"; // Nombre de la tabla en la base de datos
    // Propiedades del curso
    public $id;
    public $name;
    public $abbreviation;
    public $classroom;
    public $description;
    public $icon;
    public $user_id;
    public $created_at;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // Crear un nuevo curso
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                    SET name = :name, 
                        abbreviation = :abbreviation, 
                        classroom = :classroom, 
                        description = :description, 
                        icon = :icon, 
                        user_id = :user_id";

        $stmt = $this->connection->prepare($query);

        // Sanitizar datos
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->abbreviation = htmlspecialchars(strip_tags($this->abbreviation));
        $this->classroom = htmlspecialchars(strip_tags($this->classroom));
        $this->description = htmlspecialchars(strip_tags($this->description));
        // No es necesario sanitizar el icono (base64)

        // Asignar valores a los parámetros
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":abbreviation", $this->abbreviation);
        $stmt->bindParam(":classroom", $this->classroom);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":icon", $this->icon);
        $stmt->bindParam(":user_id", $this->user_id);

        // Ejecutar la consulta y retornar el resultado
        return $stmt->execute();
    }

    // Obtener todos los cursos de un usuario con paginación
    public function readAll($from_record_num, $records_per_page)
    {
        $query = "SELECT id, name, abbreviation, classroom, description, icon, user_id, created_at 
                FROM " . $this->table_name . " 
                WHERE user_id = ? 
                ORDER BY created_at DESC 
                LIMIT ?, ?";

        $stmt = $this->connection->prepare($query);

        // Asignar valores a los parámetros
        $stmt->bindParam(1, $this->user_id);
        $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);

        // Ejecutar consulta
        $stmt->execute();

        return $stmt;
    }

    // Contar todos los cursos de un usuario
    public function countAll()
    {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . " WHERE user_id = ?";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    // Obtener un curso específico
    public function readOne()
    {
        $query = "SELECT id, name, abbreviation, classroom, description, icon, user_id, created_at 
                FROM " . $this->table_name . " 
                WHERE id = ? AND user_id = ? 
                LIMIT 0,1";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $this->user_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Asignar datos a las propiedades de la clase
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->abbreviation = $row['abbreviation'];
            $this->classroom = $row['classroom'];
            $this->description = $row['description'];
            $this->icon = $row['icon'];
            $this->created_at = $row['created_at'];
            return true;
        }

        return false;
    }

    // Actualizar datos de un curso
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " 
                SET name = :name, 
                    abbreviation = :abbreviation, 
                    classroom = :classroom, 
                    description = :description";

        // Solo actualizar el icono si se proporciona uno nuevo
        if (!empty($this->icon)) {
            $query .= ", icon = :icon";
        }

        $query .= " WHERE id = :id AND user_id = :user_id";

        $stmt = $this->connection->prepare($query);

        // Sanitizar datos
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->abbreviation = htmlspecialchars(strip_tags($this->abbreviation));
        $this->classroom = htmlspecialchars(strip_tags($this->classroom));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // Asignar valores a los parámetros
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':abbreviation', $this->abbreviation);
        $stmt->bindParam(':classroom', $this->classroom);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);

        // Asignar icono si fue proporcionado
        if (!empty($this->icon)) {
            $stmt->bindParam(':icon', $this->icon);
        }

        // Ejecutar consulta y retornar el resultado
        return $stmt->execute();
    }

    // Eliminar un curso
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ? AND user_id = ?";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $this->user_id);

        // Ejecutar consulta y retornar el resultado
        return $stmt->execute();
    }

    // Eliminar todos los cursos de un usuario
    public function deleteAllByUser()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = ?";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->user_id);

        // Ejecutar consulta y retornar el resultado
        return $stmt->execute();
    }
}
