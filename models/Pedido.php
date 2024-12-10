<?php
    namespace Model;

    class Pedido extends ActiveRecord {
        protected static $tabla = 'pedidos';
        protected static $columnasDB = ['id', 'id_usuario', 'fecha_pedido', 'total', 'direccion_envio', 'telefono_contacto'];

        public $id;
        public $id_usuario;
        public $fecha_pedido;
        public $total;
        public $direccion_envio;
        public $telefono_contacto;

        public function __construct($args = []) {
            $this->id = $args['id'] ?? null;
            $this->id_usuario = $args['id_usuario'] ?? null;
            $this->fecha_pedido = $args['fecha_pedido'] ?? null;
            $this->total = $args['total'] ?? null;
            $this->direccion_envio = $args['direccion_envio'] ?? null;
            $this->telefono_contacto = $args['telefono_contacto'] ?? null;
        }
    }