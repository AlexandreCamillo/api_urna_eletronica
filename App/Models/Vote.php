<?php

  namespace App\Models;

  class Vote extends BaseModel {
    private static $table = 'votes';


    public static function insert($stage_id, $candidate_id)
    {
        $connPdo = self::pdo_connection();

        $sql = 'INSERT INTO '.self::$table.' (stage_id, candidate_id) '.'VALUES (:s, :c)';
        $stmt = $connPdo->prepare($sql);

        $stmt->bindValue(':s', $stage_id);
        $stmt->bindValue(':c', $candidate_id);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Voto contabilizado com sucesso!';
        } else {
            throw new \Exception("Falha ao contabilizar voto!");
        }
    }

    public static function delete_all()
    {
        $connPdo = self::pdo_connection();

        $sql = 'DELETE FROM '.self::$table;
        $stmt = $connPdo->prepare($sql);

        $stmt->execute();

        return true;
    }
  } 