<?php

class ILO_Helper_Proxy
{
    /**
     *
     * @var <string>
     */
    protected static $_prefix = 'ILO_Helper_';

    /**
     *
     * @var <array>
     */
    protected static $_stackHelper = array();

    /**
     *
     * @param <string> $method
     * @param <array> $args
     */
    public function __call( $helper, $args )
    {
        $helper = self::getHelper( $helper );
        return call_user_func_array( array( $helper, '__invoke') , $args );
    }

    /**
     *
     * @param <string> $helper
     * @return <mixed>
     */
    public function __get( $helper )
    {
        return self::getHelper( $helper );
    }

    /**
     *
     * @param <string> $helper
     * @return helperClass 
     */
    public static function getHelper( $helper )
    {
        $helperClass = self::$_prefix . $helper;
        if ( !class_exists( $helperClass ) ) {
            throw new Exception('Helper ' . $helper . ' não encontrado.');
        }

        if ( !array_key_exists( $helper, self::$_stackHelper ) )
            self::$_stackHelper[$helper] = new $helperClass();

        return self::$_stackHelper[$helper];
    }
}