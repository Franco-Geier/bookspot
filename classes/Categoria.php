<?php
    namespace App;

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
    }
