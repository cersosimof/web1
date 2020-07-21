<?php

//VER DONDE METER ESTA FUNCION
function output($val, $headerStatus=200) {
    header(' ', true, $headerStatus);
    header('Content-Type: application/json');
    print json_encode($val);
    die;
}
?>