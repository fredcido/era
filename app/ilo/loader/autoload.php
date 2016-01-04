<?php

    function iloAutoloader( $class )
    {
        // verifica se o nome da classe tem underline
        if ( strpos( $class, '_') !== FALSE ) {

            // Divide o nome da classe em pedacos
            $partes = explode( '_', $class );
            // Retira a ultima posicao, ou seja, o nome do arquivo
            $arquivo = array_pop( $partes );

            // Monta caminho para o arquivo, juntando as partes por /
            // E olocando a primeira letra do arquivo para maiuscula
            $load = strtolower( implode('/', $partes) ) . '/' . ucfirst( $arquivo ) . '.php';

            // Se o primeiro nome da classe nao for o mesmo de aplicacao, aponta a pasta modulos
            if ( $partes[0] != APP )
                $load = 'modules/' . $load;

            // Define diretorio da aplicacao
            $load =  APPDIR . '/' . $load;
	    
            // Verifica se a classe existe para requiri-la
            if ( file_exists( $load ) ) {

                require_once $load;
                
            } else {
		
                throw new Exception( 'Arquivo ' . $load . ' não encontrado' );
            }

        } else {
            throw new Exception( 'Classe ' . $class . ' fora dos padrões.' );
        }

    }

    spl_autoload_register( 'iloAutoloader' );