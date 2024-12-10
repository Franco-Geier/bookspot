<?php
    namespace Model;

    class Libro extends ActiveRecord {
        // Nombre de la tabla
        protected static $tabla = "libros";

        
        // Mapeo de columnas
        protected static $columnasDB = [
            "id", "titulo", "autor",
            "descripcion", "precio",
            "stock", "id_categoria",
            "id_editorial", "imagen",
            "creado", "estado"
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
        public $estado;


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
            $this->estado = $args['estado'] ?? 1; // Disponible por defecto
        }


        public static function where($columna, $valor) {
            $query = "
                SELECT libros.*, 
                       categorias.nombre AS categoria, 
                       editoriales.nombre AS editorial
                FROM " . static::$tabla . "
                LEFT JOIN categorias ON libros.id_categoria = categorias.id
                LEFT JOIN editoriales ON libros.id_editorial = editoriales.id
                WHERE ${columna} = '" . self::$db->escape_string($valor) . "'";
            
            return self::consultarSQL($query);
        }
        

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


        // Ordena por ID DESC con un limite
        public static function librosConRelaciones($limite = null) {
            $query = "
                SELECT libros.*, 
                       categorias.nombre AS categoria,
                       editoriales.nombre AS editorial
                FROM " . static::$tabla . "
                LEFT JOIN categorias ON libros.id_categoria = categorias.id
                LEFT JOIN editoriales ON libros.id_editorial = editoriales.id
                ORDER BY libros.id DESC
            ";
        
            if($limite) {
                $query .= " LIMIT " . intval($limite);
            }
            return self::consultarSQL($query);
        }

        // public static function buscar($query) {
        //     $query = self::$db->escape_string($query);
        //     $sql = "SELECT * FROM libros 
        //             WHERE titulo LIKE '%$query%' 
        //                OR autor LIKE '%$query%'";
        //     $resultados = self::consultarSQL($sql);
        //     if (empty($resultados)) {
        //         die("No se encontraron resultados para libros.");
        //     }
        //     return $resultados;
        // }

        
        public function actualizarEstado() {
            $this->estado = $this->stock > 0 ? 1 : 0;
            $this->guardar(false);
        }


        public function validar() {
            if(!$this->titulo || trim($this->titulo) === "") {
                self::$errores[] = "Debes añadir un título";
            } elseif (mb_strlen($this->titulo) > 30) {
                self::$errores[] = "El nombre del titulo debe tener hasta 30 caracteres.";
            }

            if (!$this->autor || trim($this->autor) === "") {
                self::$errores[] = "El autor es obligatorio.";
            } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/", $this->autor)) {
                self::$errores[] = "El nombre del autor solo puede contener letras, espacios, apóstrofes y guiones.";
            } elseif (mb_strlen($this->autor) > 40) {
                self::$errores[] = "El nombre del autor debe tener hasta 40 caracteres.";
            }

            if (!$this->descripcion || trim($this->descripcion) === "") {
                self::$errores[] = "La descripción es obligatoria.";
            } elseif (mb_strlen($this->descripcion) < 50 || mb_strlen($this->descripcion) > 200) {
                self::$errores[] = "La descripción debe tener entre 50 y 200 caracteres.";
            }


            if (!preg_match('/^\d{1,8}(\.\d{1,2})?$/', $this->precio)) {
                self::$errores[] = "El precio debe ser un número decimal válido con hasta 2 decimales.";
            } elseif ($this->precio < 1000 || $this->precio > 150000) {
                self::$errores[] = "El precio debe estar entre 1000 y 150000.";
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
            
                
            // Validar imagen
            // if (!$this->imagen) {
            //     self::$errores[] = "La imagen es obligatoria.";
            // } elseif (!is_uploaded_file($this->imagen["tmp_name"])) {
            //     self::$errores[] = "Debes subir un archivo válido.";
            // } else {
            //     $mimeType = mime_content_type($this->imagen["tmp_name"]);
            //     $allowedTypes = ['image/jpeg', 'image/png', 'image/avif', 'image/webp'];
            
            //     if (!in_array($mimeType, $allowedTypes)) {
            //         self::$errores[] = "El archivo debe ser una imagen válida (JPEG, PNG, AVIF o WebP).";
            //     }
            
            //     if ($this->imagen["size"] > 1000000) {
            //         self::$errores[] = "El archivo no debe superar los 1MB.";
            //     }
            // }

            return self::$errores;
        }
    }