<?php

/**
 * MerBankInfos routes
 * Handling URL requests with method type to send to Controller
 * 
 * @author Mohamed EL-Absy <mohamed.elabsy@yahoo.com>
 * @copyright (c) 2018, OlaHub LLC
 * @version 1.0.0
 */

$di = scandir(__DIR__ . '/../Modules');
foreach ($di as $child) {
    $file = __DIR__ . "/../Modules/$child/Routes/route.php";
    if ($child != '.' && $child != '..' && file_exists($file)) {
        require $file;
    }
}