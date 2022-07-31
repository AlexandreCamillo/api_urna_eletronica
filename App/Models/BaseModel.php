<?php
    namespace App\Models;

    class BaseModel {
        public static function get_table() {
            $full_class_name = get_called_class();
            $namespace_arr = explode('\\', $full_class_name);
            $class_name = array_pop($namespace_arr);

            return strtolower($class_name).'s';
        }

        public static function pdo_connection() {
            return new \PDO($_ENV['DB_DRIVE'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        }

        public static function find($id) {
            $connPdo = self::pdo_connection();

            $table = self::get_table();

            $sql = 'SELECT * FROM '.$table.' WHERE id = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result ? $result : null;
        }

        public static function all() {
            $connPdo = self::pdo_connection();

            $table = self::get_table();

            $sql = 'SELECT * FROM '.$table;
            $stmt = $connPdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $result ? $result : null;
        }
    }