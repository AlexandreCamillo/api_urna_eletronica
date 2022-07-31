<?php

  namespace App\Models;

  /**
   * Classe que herda de BaseModel para permitir o acesso mais intuitivo a tabela candidates
   */
  class Vote extends BaseModel {
    private static $table = 'votes';

    /**
     * Método para inserir um novo voto
     * @param stage_id Identificador da etapa
     * @param candidate_id Identificador do candidato
     */
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

    /**
     * Método para remover todos os votos da base
     */
    public static function delete_all()
    {
        $connPdo = self::pdo_connection();

        $sql = 'DELETE FROM '.self::$table;
        $stmt = $connPdo->prepare($sql);

        $stmt->execute();

        return true;
    }
  } 