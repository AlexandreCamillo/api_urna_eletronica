<?php
    namespace App\Controllers;

    use App\Models\Vote;
    use App\Models\Stage;
    use App\Models\Candidate;

    /**
     * Classe de controle dos votes
     */
    class VotesController {
      /**
       * Método para lidar com requisições do tipo get para endpoints de votes
       */
      public static function get() {
        $stages = Stage::all_with_candidates();
        $votes = Vote::all();

        $response = [];

        foreach ($stages as $stage) {
          $response[$stage['title']] = [];
          $candidates = $stage['candidates'];

          $candidates_votes = [];

          foreach ($candidates as $candidate) {
            $candidate_votes = $votes ? array_filter($votes, function ($vote) use($candidate) {
              return $vote['candidate_id'] == $candidate['id'];
            }): [];

            $candidates_votes[$candidate['id'].' - '.$candidate['name']] = count($candidate_votes);
          }

          $whites = $votes ? array_filter($votes, function ($vote) use($stage) {
            return $vote['candidate_id'] === '' and $vote['stage_id'] == $stage['id'];
          }): [];
          $candidates_votes['brancos'] = count($whites);

          $nulls = $votes ? array_filter($votes, function ($vote) use($stage) {
            return $vote['candidate_id'] === null and $vote['stage_id'] == $stage['id'];
          }): [];
          $candidates_votes['nulos'] = count($nulls);

          $response[$stage['title']] = $candidates_votes;
        }

        return $response;
      }

      /**
       * Método para lidar com requisições do tipo put para endpoints de votes
       * @param body Corpo da requisição
       */
      public static function post($body){

        $votes = $body['votes'];

        $validated_votes = [];

        foreach ($votes as $vote) {
          $validated_vote['stage'] = Stage::find_by_title($vote['etapa']);

          if($vote['numero'] !== null) {
            $validated_vote['candidate'] = Candidate::find($vote['numero']) ?? ['id' =>  ''];
          } else {
            $validated_vote['candidate'] = ['id' => null];
          }

          $validated_votes[] = $validated_vote;
        }

        foreach ($validated_votes as $vote) {
          Vote::insert($vote['stage']['id'], $vote['candidate']['id']);
        }

        return 'Voto contabilizado com sucesso!';
      }

      /**
       * Método para lidar com requisições do tipo delete para endpoints de votes
       */
      public static function delete() {
        Vote::delete_all();

        return 'Votos deletados com sucesso!';
      }
    }