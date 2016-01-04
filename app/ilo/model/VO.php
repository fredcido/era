<?php

abstract class ILO_Model_VO
{
    protected $_modifiedData = array();

    protected $_referenceMap = array();

    protected $_nativeProperties = array(
                                            '_nativeProperties',
                                            '_modifiedData',
                                            '_referenceMap'
                                       );

    public function __construct()
    {   
        foreach ( $this->_referenceMap as $attrName => $value )
            // Verifica existencia das definicoes de referencia
            $this->_checkReference( $attrName );
    }
    
    public function __call( $method, $args )
    {
        if ( preg_match_all('/[A-Z]?[a-z0-9]+/', $method, $match ) && in_array( $match[0][0], array('get', 'set')) ) {

            // Operacao a ser realizada
            $operation = $match[0][0];

            // Retira posicao da operacao
            array_shift( $match[0] );

            // Trata propriedade da classe
            $property = $this->_toProperty( $match[0] );

            // Verifica se a propriedade existe e n�o � privada
            if ( !property_exists( $this, $property ) || in_array( $property, $this->_nativeProperties ) )
                throw new Exception ('Atributo ' . $property . ' não existente.');

            array_unshift( $args, $property);

            if ( $operation == 'set' ) {
                call_user_func_array( array( $this, '_setAttribute'), $args);
                return $this;
            } else {
                return call_user_func_array( array( $this, '_getAttribute'), $args);
            }
            
        } else
            throw new Exception('M�todo ' . $method . ' n�o encontrado na classe.');
    }

    protected function _toProperty( $camelcase )
    {
        return '_' . strtolower( implode('_', $camelcase ) );
    }

    protected function _toCamelCase( $property )
    {
        $property = preg_replace('/^_/', '', $property );
        $pieces = explode('_', $property);
        
        $property = '';
        foreach ( $pieces as $piece ) {
            $property .= ucfirst( $piece );
        }

        return $property;
    }

    protected function _checkReference( $attr )
    {
        if ( empty( $this->_referenceMap[$attr]['vo'] ) || !class_exists( $this->_referenceMap[$attr]['vo'] ) )
            throw new Exception ( 'Classe VO não existe para atributo ' . $attr );
        else if ( empty( $this->_referenceMap[$attr]['dao'] ) || !class_exists( $this->_referenceMap[$attr]['dao'] ) )
            throw new Exception ( 'Classe DAO não existe para atributo ' . $attr );
        else if ( empty(  $this->_referenceMap[$attr]['remoteAttr']  ) )
            throw new Exception ( 'Atributo remoteAttr não existe para atributo ' . $attr );
        else if ( empty(  $this->_referenceMap[$attr]['localAttr']  ) )
            throw new Exception ( 'Atributo localAttr não existe para atributo ' . $attr );
    }

    protected function _setAttribute( $attr, $value, $populating = false )
    {
        $property = preg_replace('/^_/', '', $attr);
        if ( array_key_exists( $property, $this->_referenceMap ) ) {

            // Verifica existencia das definicoes de referencia
            $this->_checkReference( $property );

            // Se for array ja popula o VO
            if ( is_array( $value ) ) {
                
                $genericVO = new $this->_referenceMap[$property]['vo']();
                $genericVO->setValues( $value );
                $value = $genericVO;
            }
            
            $this->$attr = $value;
            $attr = $this->_referenceMap[$property]['localAttr'];
            
        } else {
            
            $this->$attr = $value;
            $attr = preg_replace('/^_/', '', $attr);
        }

        if ( !$populating )
            $this->_modifiedData[$attr] = true;
    }

    public function populateAttr( $attr )
    {
        $value = $this->$attr;
        
        if ( empty( $value ) )
            return false;

        // retira _ no inicio
        $attrName = preg_replace('/^_/', '', $attr);

        if ( array_key_exists( $attrName, $this->_referenceMap ) ) {

            // Verifica existencia das definicoes de referencia
            $this->_checkReference( $attrName );

            // Verifica se ja e uma instancia da classe VO
            if ( !( $value instanceof $this->_referenceMap[$attrName]['vo'] ) ) {

                if ( is_numeric( $value ) ) {

                    $genericDAO = new $this->_referenceMap[$attrName]['dao']();
                    $genericVO = $genericDAO->fetchRow( array( $this->_referenceMap[$attrName]['remoteAttr'] => $value ) );

                    $this->$attr = $genericVO;

                } else
                    throw new Exception('Valor ' . $value . ' inválido para a propriedade: ' . $attr );
            }
        }
    }

    protected function _getValidAttrs()
    {
        $properties = get_object_vars( $this );

        $validProperties = array();
        foreach ( $properties as $property => $value ) {
            if ( !in_array( $property, $this->_nativeProperties ) )
                $validProperties[$property] = $value;
        }

        return $validProperties;
    }

    public function populateAttrs()
    {
        $properties = $this->_getValidAttrs();
        foreach ( $properties as $property => $value ) {
            $this->populateAttr( $property );
        }

        return $this;
    }

    public function _getAttribute( $attr )
    {
        $this->populateAttr( $attr );
        return $this->$attr;
    }

    public function setValues( $values, $populating = false )
    {
        // Renderiza data para popular dados
        $values = $this->_parseData( $values );

        foreach ( $values as $key => $value ) {
            
            $property = '_' . $key;

            // Verifica se propriedade existe
            if ( property_exists( $this, $property ) && !in_array( $key, $this->_nativeProperties ) )
                $this->_setAttribute( $property, $value, $populating );
            else if ( null != ( $property = $this->_searchMapAttr( $property ) ) ) {
                $this->_setAttribute( $property, $value, $populating );
            }
        }

        return $this;
    }

    protected function _searchMapAttr( $property )
    {
        $property = preg_replace('/^_/', '', $property );
        foreach ( $this->_referenceMap as $key => $mapper ) {
            if ( $property == $mapper['localAttr'] )
                return '_' . $key;
        }

        return null;
    }

    protected function _parseData( $data )
    {
        $dataParsed = array();
        foreach ( $data as $key => $value ) {

            if ( preg_match('/([\w_]+)__([\w_]+)/i', $key, $match ) )
                $dataParsed[$match[1]][$match[2]] = $value;
            else
                $dataParsed[strtolower($key)] = $value;
        }

        return $dataParsed;
    }

    public function getValues()
    {
        $this->populateAttrs();

        $properties = $this->_getValidAttrs();

        $validProperties = array();
        foreach ( $properties as $key => $value ) {
            $validProperties[preg_replace('/^_/', '', $key)] = $value;
        }

        return $validProperties;
    }

    public function toArray()
    {
        $properties = $this->_getValidAttrs();

        foreach ( $properties as $key => $value ) {

            $attrName = preg_replace('/^_/', '', $key);

            // Verifica se e um dos atributos mapeados
            if ( array_key_exists( $attrName, $this->_referenceMap ) ) {
                
                // Se ele ja for um objeto e da classe especificada
                if ( is_object( $value ) && get_class( $value ) ==  $this->_referenceMap[$attrName]['vo'] ) {

                    // Pega o nome da propriedade referente no objeto
                    $remoteProperty = $this->_referenceMap[$attrName]['remoteAttr'];
                    $localProperty = $this->_referenceMap[$attrName]['localAttr'];
                    
                    // Pega valor referente no objeto
                    $method = 'get' . $this->_toCamelCase( $remoteProperty );
                    $properties[$localProperty] = $value->$method();
                    
                } else {
                    
                    $property = $this->_referenceMap[$attrName]['localAttr'];
                    // Apenas renomeia propriedadae
                    $properties[$property] = $value;
                }
                
            } else {
                $properties[$attrName] = $value;
            }

            unset( $properties[$key] );
        }

        return $properties;
    }

    public function reset()
    {
        $data = $this->toArray();
        foreach ( $data as $key => $value )
            $data[$key] = null;

        $this->setValues( $data );

        $this->_modifiedData = array();
    }

    public function getModifiedData()
    {
        return $this->_modifiedData;
    }
}