<?php
session_start();
session_destroy();
include("../VariablesEntorno.php");
if(Constants::ENTORNO == "dev"){
    header ('Location:/web1/');
}else{
    header ('Location:/');
}
?>