<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  // header("Access-Control-Allow-Methods: DELETE");
  // header("Access-Control-Max-Age: 3600");
  // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../vendor/autoload.php';
  
  use Helpers\BasicRouter;

  $inputJSON = file_get_contents('php://input');
  $BODY = json_decode($inputJSON, TRUE); 


  Helpers\BasicRouter::handleRequest($BODY);
