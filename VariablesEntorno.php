<?php

class Constants
{
    const ENTORNO = "dev";

//    const ENTORNO = "prod";

    public static function getEntorno()
    {
        return self::ENTORNO;
    }


}