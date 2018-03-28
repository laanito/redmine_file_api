<?php

namespace Odf;

require_once 'vendor/autoload.php';
require_once 'Classes/Ficheros.php';
require_once 'Classes/BasicAuthentication.php';
require_once 'Classes/LibRedmine.php';

use Luracast\Restler\Restler;

try {
    $r = new Restler();
    $r->addAPIClass('Luracast\\Restler\\Resources'); //this creates resources.json at API Root
} catch (\Exception $e) {
    header("HTTP/1.1 500 Internal Server Error", true, 500);
    return "Ocurrió un error: ".$e->getMessage();
}
try {
    $r->addAPIClass('Odf\\Classes\\Ficheros', '');
    $r->addAuthenticationClass('Odf\\Classes\\BasicAuthentication');
    $r->handle();
} catch (\Exception $e) {
    header("HTTP/1.1 500 Internal Server Error", true, 500);
    return "Ocurrió un error: ".$e->getMessage();
}
