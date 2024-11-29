<?php
    namespace App;

    class Editorial extends ActiveRecord {
        protected static $tabla = "editoriales";

        // Mapeo de columnas
        protected static $columnasDB = ["id", "nombre"];

        // Propiedades de editoriales
        public $id;
        public $nombre;

        public function __construct($args = []) {
            $this->id = $args["id"] ?? null;
            $this->nombre = $args["nombre"] ?? "";
        }
    }
