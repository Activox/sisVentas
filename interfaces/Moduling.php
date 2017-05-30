<?php

namespace interfaces;

interface Moduling
{
    //Idatabase $clave
    public function __construct(Idatabase $idatabase = NULL );
    public function getLink();
}

?>

