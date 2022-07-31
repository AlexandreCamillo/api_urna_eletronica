<?php

  namespace Helpers;

  /**
   * Classe responsável por enviar as requisições para a controller correta com o método correto
   * baseada no path da requisição
   */
  class BasicRouter {

    private static function path() {
      [ $path ] = explode('?', $_SERVER['REQUEST_URI']);
      $path = explode('/', $path);

      array_shift($path);
    
      return $path;
    }


    public static function handleRequest($request) {
      $path = self::path();

      $resource = array_pop($path);

      if($resource === '') {

        http_response_code(200);
        exit;
      }

      $service = 'App\Controllers\\'.ucfirst($resource).'Controller';

      $method = $request['method'] ?? strtolower($_SERVER['REQUEST_METHOD']);

      try {
        $response = call_user_func_array(array(new $service, $method), [$request]);

        http_response_code(200);

        header('Content-Type: application/json; charset=utf-8');
      
        echo json_encode(array('status' => 'sucess', 'data' => $response));
        exit;
      } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
        exit;
      }
    }
  }