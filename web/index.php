<?php
// autoloader de composer
require('../vendor/autoload.php');

// para logs
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
$log = new Logger('name');
$log->pushHandler(new StreamHandler('php://stderr', Logger::INFO));

// loggeamos la nueva petición
$log->addInfo('Atendiendo petición');

// intentamos obtener los datos desde el apc cache
$jsonData = apc_get('jsonData');

if(!$jsonData) {
  $log->addInfo('Datos obtenidos desde apc cache');
} else {
  $log->addInfo('Solicitando datos a instagram');
  // obtenemos los datos
  $jsonData = json_encode(Bolandish\Instagram::getMediaByUserID(getenv('USER_ID'),
    getenv('POST_COUNT')));

  // los guardamos en el apc cache
  apc_store('jsonData', $jsonData, 300);
}

$log->addInfo('Finalizando petición');

// entrega el resultado
echo 'kafibodyInstagramGrabber(' . $jsonData . ')';
