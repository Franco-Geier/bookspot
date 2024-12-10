<?php
    namespace Model;

    class ActiveRecord {
        // Propiedad para la conexión
        protected static $db;
        // Mapeo de columnas
        protected static $columnasDB = [];
        protected static $tabla = "";

        // Validaciones
        protected static $errores = [];

        // Método estático para asignar la conexión 
        public static function setDB($database) {
            self::$db = $database;
        }


        public function guardar($redirect = true) {
            if(!is_null($this->id)) {
                // Actualizar
                return $this->actualizar($redirect);
            } else {
                // creando nuevo registro
                return $this->crear($redirect);
            }
        }


        public function crear($redirect = true) {
            // Sanitizar los datos
            $atributos = $this->SanitizarAtributos();
        
            /** INSERTAR EN LA BASE DE DATOS **/
            $query = "INSERT INTO " . static::$tabla . " ( ";
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES (' ";
            $query .= join("', '", array_values($atributos));
            $query .= " ') ";
        
            $resultado = self::$db->query($query);
        
            // Obtener el ID del registro insertado
            if ($resultado) {
                $this->id = self::$db->insert_id; // Actualiza la propiedad `id` del objeto
            }
        
            // Redireccionar en caso de éxito si está habilitado
            if ($resultado && $redirect) {
                header("Location: ../admin?resultado=1"); // Redireccionar con mensaje de éxito
                exit;
            }
        
            return $resultado;
        }


        // Actualizar un registro
        public function actualizar($redirect = true) {
            // Sanitizar los datos
            $atributos = $this->SanitizarAtributos();

            $valores = [];
            foreach($atributos as $key=>$value) {
                $valores[] = "{$key}='{$value}'";
            }

            $query = "UPDATE " . static::$tabla . " SET ";
            $query .= join(', ', $valores);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1";

            $resultado = self::$db->query($query);

            if($resultado && $redirect) {
                header("Location: ../admin?resultado=2");
                exit;
            }
            return $resultado;
        }


        // Eliminar un registro
        public function eliminar($redirect = true) {
            $query = "DELETE FROM " . static::$tabla ." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
            $resultado = self::$db->query($query);

            if($resultado && $redirect) {
                $this->borrarImagen();
                header("Location: ../admin?resultado=3");
                exit;
            }
        }


        // Identificar y unir los atributos de la BD
        public function atributos() {
            $atributos = [];
            foreach(static::$columnasDB as $columna) {
                if($columna === "id" || $columna === "creado" || $columna === "fecha_registro") continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }


        // Sanitiza las entradas
        public function sanitizarAtributos() {
            $atributos = $this->atributos();
            $sanitizado = [];
            
            foreach($atributos as $key => $value) {

                if (is_string($value)) { 
                    $value = trim($value);
                    $value = preg_replace('/\s+/', ' ', $value);
                    $value = filter_var($value, FILTER_SANITIZE_STRING);
                
                    if ($key === "autor" || $key === "titulo") {
                        $value = mb_convert_case($value, MB_CASE_TITLE, "UTF-8"); // Primera letra en mayúscula
                    }
                	
                    if ($key === "descripcion") {
                        // Primera letra en mayúscula de la oración
                        $value = mb_convert_case(trim($value), MB_CASE_LOWER, "UTF-8");
                        $value = mb_strtoupper(mb_substr($value, 0, 1, "UTF-8"), "UTF-8") . mb_substr($value, 1, null, "UTF-8");
                    }
                }

                if (is_numeric($value)) {        
                    if (strpos($value, '.') !== false) {
                        $value = filter_var($value, FILTER_VALIDATE_FLOAT);
                    } else {
                        $value = filter_var($value, FILTER_VALIDATE_INT);
                    }
                }
    
                $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }


        // Subida de archivo
        public function setImagen($imagen) {
            // Elimina la imagen previa
            if(!is_null($this->id)) {
                $this->borrarImagen();
            }
            // Asignar al atributo de imagen el nombre de la imagen
            if($imagen) {
                $this->imagen = $imagen;
            }
        }


        // Eliminar el archivo
        public function borrarImagen() {
            // Comprobar si existe el archivo
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }


        // Validación
        public static function getErrores() {
            return static::$errores;
        }


        public function validar() {
            static::$errores = [];
            return static::$errores;
        }

        
        // Trae todos los resultados
        public static function all() {
            $query = "SELECT * FROM " . static::$tabla;
            $resultado = self::consultarSQL($query);

            return $resultado;
        }


        // Busca un registro por columna y valor
        public static function where($columna, $valor) {
            $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
            $resultado = self::consultarSQL($query);
            return array_shift($resultado);
        }


        // Busca un registro por su id
        public static function find($id) {
            $query = "SELECT * FROM " . static::$tabla . " WHERE id = " . intval($id) . " LIMIT 1";
            $resultado = self::consultarSQL($query);
            return array_shift($resultado);
        }


        public static function consultarSQL($query) {
            // Consultar la base de datos
            $resultado = self::$db->query($query);

            // Iterar los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()) {
                $array[] = static::crearObjeto($registro);
            }

            // Liberar la memoria
            $resultado->free();

            // Retornar los resultados
            return $array;
        }


        protected static function crearObjeto($registro) {
            $objeto = new static;
        
            foreach ($registro as $key => $value) {
                if (property_exists($objeto, $key)) {
                    $objeto->$key = $value;
                } else {
                    // Asignar dinámicamente propiedades no definidas (relaciones)
                    $objeto->$key = $value;
                }
            }
        
            return $objeto;
        }


        // Sincroniza el objeto en memoria con los cambios realizados por el usuario
        public function sincronizar($args = []) {
            foreach($args as $key => $value) {
                if(property_exists($this, $key) && !is_null($value)) {
                    $this->$key = $value;
                }
            }
        }

    }