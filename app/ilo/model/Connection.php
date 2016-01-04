<?php

//require_once '../config/config.php';

class ILO_Model_Connection
{
    protected static $_instance;

    private function __construct(){}

    public static function getInstance()
    {
        if ( NULL === self::$_instance )
            self::initConnection();

        return self::$_instance;
    }

    private static function initConnection()
    {
        $banco = ILO_Config::get('banco');

        if ( empty( $banco ) )
            throw new Exception ('Sessão para configuração de banco não encontrada' );

        $dsn = $banco->driver . ':dbname=' . $banco->base .
            ';host=' . $banco->host;

        $options['charset'] = $banco->charset;
        $options['charset'] = $banco->charset;

        self::$_instance = new PDO( $dsn, $banco->usr, $banco->pwd, $options );
        self::$_instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        self::$_instance->exec("SET names UTF8 COLLATE 'utf8_general_ci'");
        if($banco->suportetimezone == 1)
            self::$_instance->exec("SET time_zone = 'America/Sao_Paulo';");
    }

    public static function closeConnection()
    {
        self::$_instance =  NULL;
    }
    
    private function __destruct()
    {
        self::$_instance = NULL;
    }
}