<?php
// autoloader de composer
require('../vendor/autoload.php');

// para logs
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
$log = new Logger('app');
$log->pushHandler(new StreamHandler('php://stderr', Logger::INFO));

// loggeamos la nueva petición
$log->addInfo('Atendiendo petición');

header('Content-Type: application/json');

// intentamos obtener los datos desde el apc cache
$jsonData = apc_fetch('jsonData20170712');

if($jsonData) {
  $log->addInfo('Datos obtenidos desde apc cache');
} else {
  $log->addInfo('Solicitando datos a instagram');

  // hace la solicitud y procesa el resultado
  $url = 'https://www.instagram.com/kafibody/?__a=1';
  $data = file_get_contents($url);
  $json = json_decode($data);
  $array = array();
  $total = count($json->user->media->nodes);
  foreach ($json->user->media->nodes as $key => $value) {
    $newNode = array();
    $newNode["thumbnail_src"] = $value->thumbnail_src;
    $newNode["code"] = $value->code;
    $newNode["caption"] = $value->caption;
    $array[] = $newNode;
  }
  $jsonData = json_encode($array);

  // los guardamos en el apc cache
  apc_store('jsonData20170712', $jsonData, 300);
}

$log->addInfo('Finalizando petición');

// entrega el resultado
echo 'kafibodyInstagramGrabber(' . $jsonData . ')';
