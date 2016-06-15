<?php
// autoloader de composer
require('../vendor/autoload.php');

// entrega el resultado
echo 'kafibodyInstagramGrabber(' .
  Bolandish\Instagram::getMediaByUserID(getenv('USER_ID'),
    getenv('POST_COUNT')) . ')';
