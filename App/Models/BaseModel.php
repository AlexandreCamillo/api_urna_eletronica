<?php
    namespace App\Models;

    class BaseModel {
        private static function get_table() {
            $full_class_name = get_called_class();
            $namespace_arr = explode('\\', $full_class_name);
            $class_name = array_pop($namespace_arr);

            return strtolower($class_name).'s';
        }

        private static function pdo_connection() {
            return new \PDO($_ENV['DB_DRIVE'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        }

        public static function find(int $id) {
            $connPdo = self::pdo_connection();

            $table = self::get_table();

            $sql = 'SELECT * FROM '.$table.' WHERE id = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Error to get ". $id ." from ". $table);
            }
        }

        public static function all() {
            $connPdo = self::pdo_connection();

            $table = self::get_table();

            $sql = 'SELECT * FROM '.$table;
            $stmt = $connPdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Error to get all ".$table);
            }
        }

        // public static function insert($data)
        // {
        //     $connPdo = new \PDO($_ENV['DB_DRIVE'].': host='.$_ENV['DB_HOST'].'; $_ENV['DB_DATABASE']='.$_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

        //     $sql = 'INSERT INTO '.self::$table.' (email, password, name) VALUES (:em, :pa, :na)';
        //     $stmt = $connPdo->prepare($sql);
        //     $stmt->bindValue(':em', $data['email']);
        //     $stmt->bindValue(':pa', $data['password']);
        //     $stmt->bindValue(':na', $data['name']);
        //     $stmt->execute();

        //     if ($stmt->rowCount() > 0) {
        //         return 'Usuário(a) inserido com sucesso!';
        //     } else {
        //         throw new \Exception("Falha ao inserir usuário(a)!");
        //     }
        // }
    }