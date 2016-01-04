<?php

abstract class ILO_Helper_Abstract
{
    protected $_proxy;
    
    public function __construct()
    {
        $this->_proxy = new ILO_Helper_Proxy();
    }
    
    public function getHelper( $helperName )
    {
        return $this->_proxy->getHelper( $helperName );
    }
}