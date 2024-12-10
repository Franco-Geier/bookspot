<?php
    namespace Model;

    class DetallePedido extends ActiveRecord {
        protected static $tabla = 'detalles_pedido';
        protected static $columnasDB = ['id', 'id_pedido', 'id_libro', 'cantidad', 'precio_unitario'];

        public $id;
        public $id_pedido;
        public $id_libro;
        public $cantidad;
        public $precio_unitario;

        public function __construct($args = []) {
            $this->id = $args['id'] ?? null;
            $this->id_pedido = $args['id_pedido'] ?? null;
            $this->id_libro = $args['id_libro'] ?? null;
            $this->cantidad = $args['cantidad'] ?? 0;
            $this->precio_unitario = $args['precio_unitario'] ?? 0.0;
        }


        // Método para obtener registros basados en una condición
        public static function whereAll($columna, $valor) {
            $valor = self::$db->escape_string($valor);
            $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
            return self::consultarSQL($query);
        }
    }