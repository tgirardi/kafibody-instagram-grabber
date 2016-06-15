<?php
// autoloader de composer
require('../vendor/autoload.php');

// entrega el resultado
echo 'kafibodyInstagramGrabber(\'' .
  json_encode(Bolandish\Instagram::getMediaByUserID(getenv('USER_ID'),
    getenv('POST_COUNT'))) . '\')';
