<?php
class Database {
    // Configuración de la base de datos
    private $host = 'localhost';  // Servidor de la base de datos
    private $db_name = 'edulink'; // Nombre de la base de datos
    private $username = 'root';   // Usuario de la base de datos
    private $password = '';       // Contraseña (vacía por defecto en servidores locales)
    private $connection;                // Variable para la conexión

    // Método para obtener la conexión a la base de datos
    public function getConnection() {
        $this->connection = null; // Inicializa la conexión como null
        
        try {
            // Crear una nueva instancia de PDO para conectar a MySQL
            $this->connection = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            // Configurar PDO para que genere excepciones en caso de error
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Configurar la codificación de caracteres a UTF-8
            $this->connection->exec("set names utf8");
        } catch(PDOException $e) {
            // En caso de error, mostrar el mensaje de error
            echo "Connection error: " . $e->getMessage();
        }
        
        return $this->connection; // Retorna la conexión establecida o null si hubo error
    }
}
?>
