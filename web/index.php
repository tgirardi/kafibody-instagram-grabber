<?php
header('Content-Type: application/json');
$url = 'https://www.instagram.com/kafibody/?__a=1';
$json = json_decode(file_get_contents($url));
$jsonImagens = "kafibodyInstagramGrabber([";
$total = count($json->user->media->nodes);
$soma = 0;
foreach ($json->user->media->nodes as $key => $value) {
    $soma++;
    $jsonImagens .= '{"thumbnail_src":"'.$value->thumbnail_src.'","code": "'.$value->code.'","caption"; "'.$value->caption.'}';
    if($soma != $total){
       $jsonImagens .= ",";
    }
}
$jsonImagens .= "])";
print_r(($jsonImagens));
