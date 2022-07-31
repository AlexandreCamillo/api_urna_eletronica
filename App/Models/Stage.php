<?php

  namespace App\Models;

  use App\Models\Candidate;

  /**
   * Classe que herda de BaseModel para permitir o acesso mais intuitivo a tabela stages
   */
  class Stage extends BaseModel {
    private static $table = 'stages';

    /**
     * Método para retornar todas as instâncias de etapas juntamente de seus candidatos
     */
    public static function all_with_candidates() {
      $candidates = Candidate::all();

      $stages = self::all();

      return array_map(function ($stage) use ($candidates) {
        $stage['candidates'] = array_filter($candidates, function ($candidate) use ($stage) {
          return $candidate['stage_id'] === $stage['id'];
        });
        return $stage;
      }, $stages);
    }

    /**
     * Método para retornar uma instância de etapa, baseado em seu título
     * @param title título da etapa
     */
    public static function find_by_title(string $title) {
      $connPdo = self::pdo_connection();

      $table = self::get_table();

      $sql = 'SELECT * FROM '.$table.' WHERE title = :title';
      $stmt = $connPdo->prepare($sql);
      $stmt->bindValue(':title', $title);
      $stmt->execute();

      return $stmt->fetch(\PDO::FETCH_ASSOC);
  }
  }