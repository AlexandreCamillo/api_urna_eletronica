<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Max-Age: 1728000');
  // header("Access-Control-Max-Age: 3600");
  // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../vendor/autoload.php';
  
  use Helpers\BasicRouter;

  $inputJSON = file_get_contents('php://input');
  $BODY = json_decode($inputJSON, TRUE); 


  Helpers\BasicRouter::handleRequest($BODY);
