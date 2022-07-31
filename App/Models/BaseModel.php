<?php
    namespace App\Models;

    /**
     * Classe base para classes com responsabilidade de persistência de dados no banco de dados
     */
    class BaseModel {
        /**
         * Método para retornar a tabela para a qual a model que usa esta classe base
         * foi criada para intermediar
         */
        public static function get_table() {
            $full_class_name = get_called_class();
            $namespace_arr = explode('\\', $full_class_name);
            $class_name = array_pop($namespace_arr);

            return strtolower($class_name).'s';
        }

        /**
         * Método para criar a conexão com o banco de dados baseado nas variáveis de ambiente
         */
        public static function pdo_connection() {
            return new \PDO($_ENV['DB_DRIVE'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        }

        /**
         * Método para retornar os dados de uma instância da tabela da classe que usa essa classe base
         * com base no identificador da instância
         * @param id Identificador da instância que se deseja encontrar
         */
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

        /**
         * Método para retornar os dados de todas as instâncias da tabela da classe que usa essa classe base
         */
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