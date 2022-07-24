<?php
  require_once '../vendor/autoload.php';

  use Helpers\BasicRouter;


  Helpers\BasicRouter::handleRequest($_REQUEST);

  