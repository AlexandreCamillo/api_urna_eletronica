<?php
  header('Access-Control-Allow-Origin: *');
  require_once '../vendor/autoload.php';

  use Helpers\BasicRouter;


  Helpers\BasicRouter::handleRequest($_REQUEST);

  