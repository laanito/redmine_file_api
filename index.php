<?php

namespace Odf;

require_once 'vendor/autoload.php';
use Luracast\Restler\Restler;

try {
    $r = new Restler();
    $r->addAPIClass('Luracast\\Restler\\Resources'); //this creates resources.json at API Root
}catch (\Exception $e){
    header("HTTP/1.1 500 Internal Server Error");
    return "Ocurrió un error: ".$e->getMessage();
}
try {
    $r->addAPIClass('Odf\\Classes\\Fichero', '');
    $r->handle();
} catch (\Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");
    return "Ocurrió un error: ".$e->getMessage();
}