<?php
namespace Model;

    class Contacto extends ActiveRecord {
        protected static $columnasDB = ["nombre", "apellido", "mensaje", "contacto", "email", "tel", "fecha", "hora"];

        public $nombre;
        public $apellido;
        public $mensaje;
        public $contacto;
        public $email;
        public $tel;
        public $fecha;
        public $hora;

        public function __construct($args = []) {
            $this->nombre = $args['nombre'] ?? '';
            $this->apellido = $args['apellido'] ?? '';
            $this->mensaje = $args['mensaje'] ?? '';
            $this->contacto = $args['contacto'] ?? '';
            $this->email = $args['email'] ?? '';
            $this->tel = $args['tel'] ?? '';
            $this->fecha = $args['fecha'] ?? '';
            $this->hora = $args['hora'] ?? '';
        }

        public function validar() {
            self::$errores = [];

            // Validación de nombre
            if (!$this->nombre || trim($this->nombre) === '') {
                self::$errores['nombre'] = "El nombre es obligatorio.";
            } elseif (mb_strlen($this->nombre) > 50) {
                self::$errores['nombre'] = "El nombre no debe exceder 50 caracteres.";
            } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/", $this->nombre)) {
                self::$errores['nombre'] = "El nombre solo puede contener letras, espacios y caracteres válidos.";
            }

            // Validación de apellido
            if (!$this->apellido || trim($this->apellido) === '') {
                self::$errores['apellido'] = "El apellido es obligatorio.";
            } elseif (mb_strlen($this->apellido) > 50) {
                self::$errores['apellido'] = "El apellido no debe exceder 50 caracteres.";
            } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/", $this->apellido)) {
                self::$errores['apellido'] = "El apellido solo puede contener letras, espacios y caracteres válidos.";
            }

            // Validación de mensaje
            if (!$this->mensaje || trim($this->mensaje) === '') {
                self::$errores['mensaje'] = "El mensaje no puede estar vacío.";
            }

            // Validación de contacto
            if ($this->contacto !== 'telefono' && $this->contacto !== 'email') {
                self::$errores['contacto'] = "Debe seleccionar una forma de contacto válida.";
            }

            // Validación de email si el contacto es por email
            if ($this->contacto === 'email' && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                self::$errores['email'] = "El email no es válido.";
            }

            // Validación de teléfono si el contacto es por teléfono
            if ($this->contacto === 'telefono') {
                if (!preg_match('/^\d{7,10}$/', $this->tel)) {
                    self::$errores['tel'] = "El teléfono debe contener entre 7 y 10 dígitos.";
                }
            }

            // Validación de fecha: no permitir fechas anteriores a hoy
            if ($this->fecha && strtotime($this->fecha) < strtotime(date('Y-m-d'))) {
                self::$errores['fecha'] = "La fecha no puede ser anterior a hoy.";
            }

            // Validación de hora (opcional, formato HH:MM)
            if ($this->hora && !preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $this->hora)) {
                self::$errores['hora'] = "La hora debe tener el formato HH:MM.";
            }

            return self::$errores;
        }

        public function sanitizar() {
            $this->nombre = mb_convert_case(trim($this->nombre), MB_CASE_TITLE, "UTF-8");
            $this->apellido = mb_convert_case(trim($this->apellido), MB_CASE_TITLE, "UTF-8");
            $this->mensaje = ucfirst(mb_strtolower(trim($this->mensaje), "UTF-8"));
            $this->email = filter_var(trim($this->email), FILTER_SANITIZE_EMAIL);
            $this->tel = preg_replace('/\D/', '', $this->tel); // Elimina todo excepto dígitos
            $this->fecha = trim($this->fecha);
            $this->hora = trim($this->hora);
        }
    }
