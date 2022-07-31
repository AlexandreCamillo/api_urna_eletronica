<?php
    namespace App\Controllers;

    use App\Models\Stage;
    
    /**
     * Classe de controle dos stages
     */
    class StagesController {
      /**
       * Método para lidar com requisições do tipo get para endpoints de stages
       */
      public static function get(){
        return Stage::all_with_candidates();
      }
    }