<?php
    namespace App\Controllers;

    use App\Models\Stage;

    class StagesController {
      public static function get($request){
        return Stage::all_with_candidates();
      }
    }