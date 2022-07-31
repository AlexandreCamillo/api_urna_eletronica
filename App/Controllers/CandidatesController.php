<?php
    namespace App\Controllers;

    use App\Models\Candidates;

    class CandidatesController {
      public static function put($request){
        return Candidates::vote_in($request['candidate_id']);
      }
    }