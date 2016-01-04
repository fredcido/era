<?php
    header( 'Cotent-type: text/html; charset=utf-8' );
    
    define( 'APPDIR', realpath( 'app' ) );
    define( 'BASE', preg_replace( '/\/$/','', dirname( $_SERVER['SCRIPT_NAME'] ) ) );
    define( 'APP', 'ILO' );

    require_once APPDIR . '/ilo/loader/autoload.php';
    
    try {
        // Inicializa a aplicacao
        ILO_Bootstrap::start();

    } catch ( Exception $e ) {

        echo 'Erro Startup: ' . $e->getMessage() . '<br />';
        echo 'Arquivo: ' . $e->getFile();
    }

    exit();