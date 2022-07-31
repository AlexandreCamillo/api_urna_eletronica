<?php
  header('Access-Control-Allow-Origin: *');

  header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

  require_once '../vendor/autoload.php';
  
  use Helpers\BasicRouter;

  $inputJSON = file_get_contents('php://input');
  $BODY = json_decode($inputJSON, TRUE); 


  Helpers\BasicRouter::handleRequest($BODY);
