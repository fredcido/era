<?php

abstract class ILO_Util_Log
{
    /**
     *
     * @param string $content
     * @param string $file 
     */
    public static function debug( $content, $file = 'log' )
    {
        // prepara nome do arquivo de log
        $file = 'public/logs/' . $file . '_' . date('d_m_Y') . '.log';

        $fd = fopen( $file, 'a+');

        $conteudo = 'Data: ' . date('d/m/Y H:i:s') . "\n\r"
                  . 'Conteudo: ' . print_r( $content, true ) . "\n\r"
                  . str_repeat('-', 150) . "\r\n\r\n";

        fwrite( $fd, $conteudo );

        fclose( $fd );
    }
}
