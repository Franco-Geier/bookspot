<?php
    namespace App;

    class Libro extends ActiveRecord {
        // Nombre de la tabla
        protected static $tabla = "libros";

        
        // Mapeo de columnas
        protected static $columnasDB = [
            "id", "titulo", "autor",
            "descripcion", "precio",
            "stock", "id_categoria",
            "id_editorial", "imagen",
            "creado"
        ];


        // Propiedades del libro
        public $id;
        public $titulo;
        public $autor;
        public $descripcion;
        public $precio;
        public $stock;
        public $id_categoria;
        public $id_editorial;
        public $imagen;
        public $creado;


        public function __construct($args = []) {
            $this->id = $args["id"] ?? null;
            $this->titulo = $args["titulo"] ?? "";
            $this->autor = $args["autor"] ?? "";
            $this->descripcion = $args["descripcion"] ?? "";
            $this->precio = $args["precio"] ?? null;
            $this->stock = $args["stock"] ?? null;
            $this->id_categoria = $args["id_categoria"] ?? null;
            $this->id_editorial = $args["id_editorial"] ?? null;
            $this->imagen = $args["imagen"] ?? null;
            $this->creado = $args["creado"] ?? null;
        }


        // Sobreescribir find para incluir relaciones
        public static function find($id) {
            $query = "
                SELECT libros.*, 
                        categorias.nombre AS categoria, 
                        editoriales.nombre AS editorial
                FROM " . static::$tabla . "
                LEFT JOIN categorias ON libros.id_categoria = categorias.id
                LEFT JOIN editoriales ON libros.id_editorial = editoriales.id
                WHERE libros.id = " . intval($id) . " LIMIT 1
            ";
        
            $resultado = self::consultarSQL($query);
            return array_shift($resultado);
        }


        public function validar() {
            if(!$this->titulo || trim($this->titulo) === "") {
                self::$errores[] = "Debes añadir un título";
            }

            if (!$this->autor || trim($this->autor) === "") {
                self::$errores[] = "El autor es obligatorio.";
            } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/", $this->autor)) {
                self::$errores[] = "El nombre del autor solo puede contener letras, espacios, apóstrofes y guiones.";
            }

            if (!$this->descripcion || trim($this->descripcion) === "") {
                self::$errores[] = "La descripción es obligatoria.";
            } elseif (mb_strlen($this->descripcion) < 50 || mb_strlen($this->descripcion) > 200) {
                self::$errores[] = "La descripción debe tener entre 50 y 200 caracteres.";
            }
    
            if (!filter_var($this->precio, FILTER_VALIDATE_FLOAT)) {
                self::$errores[] = "El precio debe ser un número válido.";
            } elseif ($this->precio < 5000 || $this->precio > 90000) {
                self::$errores[] = "El precio debe estar entre 5000 y 90000.";
            }
    
            if (!filter_var($this->stock, FILTER_VALIDATE_INT)) {
                self::$errores[] = "El stock debe ser un número entero válido.";
            } elseif ($this->stock < 1 || $this->stock > 100) {
                self::$errores[] = "El stock debe estar entre 1 y 100.";
            }

            if (!$this->id_categoria || !filter_var($this->id_categoria, FILTER_VALIDATE_INT)) {
                self::$errores[] = "Debes seleccionar una categoría válida.";
            }
            
            if (!$this->id_editorial || !filter_var($this->id_editorial, FILTER_VALIDATE_INT)) {
                self::$errores[] = "Debes seleccionar una editorial válida.";
            }

            if(!$this->imagen) {
                self::$errores[] = "La imagen es obligatoria.";
            }

            return self::$errores;
        }
    }