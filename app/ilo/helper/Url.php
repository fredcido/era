<?php

class ILO_Helper_Url extends ILO_Helper_Abstract
{
    public function __invoke( $action, $controller = null, $module = null )
    {
        $rota = ILO_Router_Dispatcher::getRoute();

        $controller = empty( $controller ) ? $rota['controller'] : $controller;

        $module = empty( $module ) ? $rota['modulo'] : $module;

        if ( $module == ILO_Router_Dispatcher::getDefaultModule() )
            $module = '';
        else
            $module .= '/';

        $url = BASE . '/' . $module . $controller . '/' . $action;

        return $url;
    }
}