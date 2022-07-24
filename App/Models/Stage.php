<?php

  namespace App\Models;

  use App\Models\Candidate;

  class Stage extends BaseModel {
    private static $table = 'stages';

    public static function allWithCandidates() {
      $candidates = Candidate::all();

      $stages = self::all();

      return array_map(function ($stage) use ($candidates) {
        $stage['candidates'] = array_filter($candidates, function ($candidate) use ($stage) {

          return $candidate['stage_id'] === $stage['id'];
        });
        return $stage;
      }, $stages);
    }
  }