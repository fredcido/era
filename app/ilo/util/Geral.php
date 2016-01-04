<?php

abstract class ILO_Util_Geral
{
    /**
     *
     * @param mixed $arrayMaster
     * @param true $encode
     * @return mixed 
     */
    public static function encodeUTF8( $arrayMaster, $encode = true )
    {
        // Verifica se elemento passado e um array
        if ( is_array( $arrayMaster ) ) {

            // Percorre cada posicao do array chamando recursivamente o mesmo metodo
            foreach ( $arrayMaster as $id => $elemento ) 
                $arrayMaster[$id] = self::encodeUTF8( $elemento, $encode );

        } else {
            
            // Verifica se valor E string para Codificar
            if ( is_string( $arrayMaster ) )
	         // Se elemento nao for um array, codifica o valor pra UTF-8
                $arrayMaster = $encode ? utf8_encode($arrayMaster) : utf8_decode($arrayMaster);
        }

        // Retorna array ou valor convertido
        return $arrayMaster;
    }
    
    /**
     *
     * @param string $string
     * @param int $length
     * @return string 
     */
    public static function truncate( $string, $length = 25 )
    {
	if ( strlen( $string ) > $length )
	    $string = substr ( $string, 0, $length ) . '...';
	    
	return $string;
    }
    
    /**
     *
     * @param string $fileName
     * @param string $extension
     * @return string
     */
    public static function nameFile( $fileName, $extension )
    {
	$fileName = explode( '.', $fileName );
	array_pop( $fileName );
	
	return self::toAscii( implode( '-', $fileName ) ) . '.' . $extension;
    }
    
    /**
     *
     * @param string $str
     * @param array $replace
     * @param string $delimiter
     * @return string
     */
    public static function toAscii( $str, $replace = array(), $delimiter = '-' ) 
    {
	if ( !empty( $replace ) )
	    $str = str_replace((array)$replace, ' ', $str);

	$clean = iconv( 'UTF-8', 'ASCII//TRANSLIT', $str );
	$clean = preg_replace( "/[^a-zA-Z0-9\/_|+ -]/", '', $clean );
	$clean = strtolower( trim( $clean, '-' ) );
	$clean = preg_replace( "/[\/_|+ -]+/", $delimiter, $clean );

	return $clean;
    }
    
    /**
     *
     * @param int $dia
     * @param int $mes
     * @param int $ano
     * @return int 
     */
    public static function calculaIdade( $nascimento ) 
    {
	sscanf( $nascimento, '%d/%d/%d', $dia, $mes, $ano );
	$hoje = getdate();
	$idade = $hoje['year'] - $ano;
	if ( $hoje['mon'] < $mes || ( $hoje['mon'] == $mes && $hoje['mday'] < $dia ) ) {
	    $idade -= 1;
	}
	return $idade;
    }
    
    /**
     *
     * @param string $date
     * @return string
     */
    public static function dateToBd( $date )
    {
        if (empty($date))
            return null;
        
	return implode( '-', array_reverse( explode( '/', $date ) ) );
    }
    
    /**
     *
     * @param string $date
     * @return string
     */
    public static function dateToBr( $date )
    {
        return empty( $date ) ? '' : implode( '/', array_reverse( explode( '-', $date ) ) );
    }
    
     /**
     *
     * @param string $date
     * @return string
     */
    public static function dateTimeToBr( $date, $time = true )
    {
	if ( empty( $date ) ) return '';
	
        $parts = explode( ' ', $date );
	
	$time = empty( $time ) ? '' : ' ' . $parts[1];
	
	return implode( '/', array_reverse( explode( '-', $parts[0] ) ) ) . $time;
    }
    
    /**
     *
     * @param string $date
     * @return bool
     */
    public static function checkDate( $date )
    {
	if ( preg_match( "/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/i", $date, $parts ) )
	    return checkdate( $parts[2], $parts[1], $parts[3] );
	else 
	    return false;
    }
    
    /**
     *
     * @param string $value
     * @return float
     */
    public static function toFloat( $value )
    {
	return (float)str_replace( ',', '', $value );
    }
}
