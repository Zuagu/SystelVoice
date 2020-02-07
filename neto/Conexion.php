<?php
    /**
     * Clase para la conexion a la base de datos
     */
    class Conexion {
        protected $conn;

        public function Conexion() {
            try {
                $this->conn = new PDO('mysql:host=localhost:8889; dbname=AudioElastixDialerBD', 'root', 'root');
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->exec("SET CHARACTER SET UTF8");
                return $this->conn;
            } catch (Exception $e) {
                echo "Linea de error: ".$e->getLine();
            }

        }
    }

 ?>
