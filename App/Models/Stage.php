<?php

  namespace App\Models;

  use App\Models\Candidate;

  class Stage extends BaseModel {
    private static $table = 'stages';

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