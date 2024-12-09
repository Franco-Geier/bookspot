<?php
    namespace Model;

    class Carrito extends ActiveRecord {
        protected static $tabla = 'carrito';
        protected static $columnasDB = ['id', 'id_usuario', 'id_libro', 'cantidad'];

        public $id;
        public $id_usuario;
        public $id_libro;
        public $cantidad;

        public function __construct($args = []) {
            $this->id = $args['id'] ?? null;
            $this->id_usuario = $args['id_usuario'] ?? null;
            $this->id_libro = $args['id_libro'] ?? null;
            $this->cantidad = $args['cantidad'] ?? 1;
        }


        public function validar() {
            self::$errores = [];
        
            if (!$this->id_usuario || !filter_var($this->id_usuario, FILTER_VALIDATE_INT)) {
                self::$errores[] = "El usuario es obligatorio.";
            }
        
            if (!$this->id_libro || !filter_var($this->id_libro, FILTER_VALIDATE_INT)) {
                self::$errores[] = "El libro es obligatorio.";
            }
        
            if ($this->cantidad < 1) {
                self::$errores[] = "La cantidad debe ser mayor o igual a 1.";
            }
        
            $libro = Libro::find($this->id_libro);
            if (!$libro) {
                self::$errores[] = "El libro no existe.";
            } elseif ($this->cantidad > $libro->stock) {
                self::$errores[] = "La cantidad solicitada excede el stock disponible.";
            }
        
            return self::$errores;
        }

        public static function whereAll($columna, $valor) {
            $query = "SELECT carrito.*, libros.titulo AS libro_titulo, libros.precio AS libro_precio 
                    FROM carrito 
                    JOIN libros ON carrito.id_libro = libros.id 
                    WHERE carrito.${columna} = '${valor}'";
            return self::consultarSQL($query);
        }


        public static function obtenerCarritoConLibros($idUsuario) {
            $query = "SELECT carrito.*, libros.titulo AS libro_titulo, libros.precio AS libro_precio, libros.stock AS libro_stock 
                      FROM carrito 
                      JOIN libros ON carrito.id_libro = libros.id 
                      WHERE carrito.id_usuario = '${idUsuario}'";
            return self::consultarSQL($query);
        }

        public static function existeLibro($idLibro, $idUsuario) {
            $resultado = self::consultarSQL("SELECT * FROM carrito WHERE id_usuario = {$idUsuario} AND id_libro = {$idLibro}");
            return !empty($resultado);
        }
    }
