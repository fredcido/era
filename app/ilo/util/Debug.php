<?php

abstract class ILO_Util_Debug
{
    public static function dump( $param, $label = false )
    {
        if ( $label ) {
            echo '<b>' . $label . '</b>';
        }
        echo '<pre>';
        var_dump ( $param );
        echo '</pre>';
    }
}