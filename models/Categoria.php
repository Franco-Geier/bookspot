<?php
    namespace Model;

    class Categoria extends ActiveRecord {
        protected static $tabla = "categorias";

        // Mapeo de columnas
        protected static $columnasDB = ["id", "nombre"];

        // Propiedades de categorias
        public $id;
        public $nombre;

        public function __construct($args = []) {
            $this->id = $args["id"] ?? null;
            $this->nombre = $args["nombre"] ?? "";
        }


        public static function buscar($query) {
            $query = self::$db->escape_string($query);
            $sql = "SELECT * FROM categorias WHERE nombre LIKE '%$query%'";
            $resultados = self::consultarSQL($sql);
            if (empty($resultados)) {
                die("No se encontraron resultados para categorías.");
            }
            return $resultados;
        }
    }
