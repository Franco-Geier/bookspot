<?php
    namespace Model;

    class Usuario extends ActiveRecord {
        protected static $tabla = "usuarios";
        protected static $columnasDB = ["id", "nombre", "apellido", "email", "password", "admin", "confirmado", "token", "fecha_registro"];

        public $id;
        public $nombre;
        public $apellido;
        public $email;
        public $password;
        public $admin;
        public $confirmado;
        public $token;
        public $fecha_registro;

        public function __construct($args = []) {
            $this->id = $args["id"] ?? null;
            $this->nombre = $args["nombre"] ?? "";
            $this->apellido = $args["apellido"] ?? "";
            $this->email = $args["email"] ?? "";
            $this->password = $args["password"] ?? "";
            $this->admin = $args["admin"] ?? null;
            $this->confirmado = $args["confirmado"] ?? "0";
            $this->token = $args["token"] ?? "";
            $this->fecha_registro = $args["fecha_registro"] ?? "0";
        }


        public function validar() {
            self::$errores = [];

            if (!$this->nombre || trim($this->nombre) === "") {
                self::$errores["error"] = "El nombre es obligatorio.";
            } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/", $this->nombre)) {
                self::$errores["error"] = "El nombre solo puede contener letras, espacios, apóstrofes y guiones.";
            } elseif (mb_strlen($this->nombre) > 50) {
                self::$errores["error"] = "El nombre debe tener hasta 40 caracteres.";
            }

            if (!$this->apellido || trim($this->apellido) === "") {
                self::$errores["error"] = "El apellido es obligatorio.";
            } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/", $this->apellido)) {
                self::$errores["error"] = "El apellido solo puede contener letras, espacios, apóstrofes y guiones.";
            } elseif (mb_strlen($this->apellido) > 50) {
                self::$errores["error"] = "El apellido debe tener hasta 40 caracteres.";
            }

            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                self::$errores["error"] = "El email no es válido.";
            }

            if (strlen($this->password) < 6) {
                self::$errores["error"] = "El password debe tener al menos 6 caracteres.";
            }
            return self::$errores;
        }


        public function hashPassword() {
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }


        public function existeUsuario() {
            $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
            $resultado = self::$db->query($query);
        
            if($resultado->num_rows) {
                self::$errores[] = "El usuario ya está registrado.";
            }
            return $resultado;
        }


        public function crearToken() {
            $this->token = uniqid();
        }


        public function validarLogin() {
            if (!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                self::$errores[] = "El email es obligatorio y debe ser válido.";
            }

            if(!$this->password) {
                self::$errores[] = "El password es obligatorio";
            }
            return self::$errores;
        }


        public function validarEmail() {
            self::$errores = [];

            if (!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                self::$errores[] = [
                    "tipo" =>"error",
                    "mensaje" => "El email es obligatorio y debe ser válido"
                ];
            }
            return self::$errores;
        }


        public function validarPassword() {
            if(!$this->password) {
                self::$errores[] = [
                    "tipo" => "error",
                    "mensaje" => "El password es obligatorio"
                ];
            }

            if (strlen($this->password) < 6) {
                self::$errores[] = [
                    "tipo" => "error",
                    "mensaje" => "El password debe tener al menos 6 caracteres"
                ];
            }
            return self::$errores;
        }


        public function comprobarPasswordAndVerificado($password) {
            $resultado = password_verify($password, $this->password);

            if(!$resultado || !$this->confirmado) {
                return false;
            } else {
                return true;
            }
        }
    }