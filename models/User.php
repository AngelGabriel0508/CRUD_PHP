<?php
class User
{
    private $connection; // Conexión a la base de datos
    private $table_name = "users"; // Nombre de la tabla en la base de datos
    // Columnas de la tabla usuario
    public $id;
    public $username;
    public $email;
    public $password;
    public $created_at;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // Crear un nuevo usuario
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                SET username = :username, 
                    email = :email, 
                    password = :password";

        $stmt = $this->connection->prepare($query);

        // Sanitizar y encriptar la contraseña
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // Asignar valores a los parámetros
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        // Ejecutar la consulta y retornar el resultado
        return $stmt->execute();
    }

    // Verificar si el email ya existe en la base de datos
    public function emailExists()
    {
        $query = "SELECT id, username, email, password 
                FROM " . $this->table_name . " 
                WHERE email = ?
                LIMIT 0,1";
        $stmt = $this->connection->prepare($query);
        // Sanitizar el email
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        // Verificar si se encontró el email
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Asignar datos del usuario a las propiedades de la clase
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            return true;
        }
        return false;
    }
    // Obtener datos de un usuario por su ID
    public function readOne()
    {
        $query = "SELECT id, username, email, created_at 
                FROM " . $this->table_name . " 
                WHERE id = ?
                LIMIT 0,1";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            // Asignar datos obtenidos a las propiedades del usuario
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->created_at = $row['created_at'];
            return true;
        }
        return false;
    }
    // Actualizar la contraseña del usuario
    public function updatePassword()
    {
        $query = "UPDATE " . $this->table_name . " 
                SET password = :password 
                WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        // Encriptar la nueva contraseña
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        // Asignar valores a los parámetros
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':id', $this->id);
        // Ejecutar la consulta y retornar el resultado
        return $stmt->execute();
    }
    // Eliminar un usuario de la base de datos
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        // Ejecutar la consulta y retornar el resultado
        return $stmt->execute();
    }
}
