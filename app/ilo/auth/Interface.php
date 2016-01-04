<?php

interface ILO_Auth_Interface
{
    public function verificaAcesso( ILO_Controller_Padrao $controller );

    public function getNewRoute();

    public static function getIdentity();
    
    public static function reset();

    public static function setIdentity( $identity );
}