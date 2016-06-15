<?php
// autoloader de composer
require('../vendor/autoload.php');

// entrega el resultado
echo json_encode(
  Bolandish\Instagram::getMediaByUserID(getenv('CLIENT_ID'),
    getenv('POST_COUNT'))
);
