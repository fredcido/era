<?php

abstract class ILO_Model_DAO
{
    protected $_cnn;

    protected $_table;

    protected $_class;

    static $_transaction = false;

    public function __construct()
    {
        $this->_cnn = ILO_Model_Connection::getInstance();
    }
    
    /**
     * 
     */
    public function getTable()
    {
	return $this->_table;
    }

    public function insert( ILO_Model_VO $VO )
    {
        try {

            $sql = 'INSERT INTO ' . $this->getTable();

            // Pega valores do VO
            $columns = $VO->toArray();
            // Pega dados que foram alterados
            $modifiedData = $VO->getModifiedData();

            // Combina para ver dados alterados
            $finalData = array_intersect_key( $columns, $modifiedData);

            // Insere colunas a serem salvas
            $sql .= '(' . implode(',', array_keys( $finalData ) ) . ')';

            $bindColumns = array();
            foreach ( $finalData as $key => $value )
                $bindColumns[':' . $key] = $value;

            // Cria as posicoes de BIND para o PDO
            $sql .= ' VALUES(' . implode( ',', array_keys( $bindColumns ) ) . ')';
	    
            $stmt = $this->_cnn->prepare( $sql );

            $stmt->execute( $bindColumns );

            return $this->lastInsertedId();

        } catch ( Exception $e ) {

	    var_dump( $e );
	    exit;
            $this->_debugError( $e );

            if ( self::$_transaction )
                throw $e;
            else
                return false;
        }
    }

    public function update( ILO_Model_VO $VO, $where )
    {
        try {

            $sql = 'UPDATE ' . $this->getTable() . ' SET ';

            // Pega valores do VO
            $columns = $VO->toArray();
            // Pega dados que foram alterados
            $modifiedData = $VO->getModifiedData();

            // Combina para ver dados alterados
            $finalData = array_intersect_key( $columns, $modifiedData );

            // Cria campos para bind e adicionar a clausula
            $updateFields = array();
            $bindColumns = array();
            
            // Cria campos e posicoes para dar um bind pelo PDO
            foreach ( $finalData as $key => $data ) {
                $updateFields[] = $key . ' = :' . $key;
                $bindColumns[':' . $key] = $data;
            }

            // Adiciona campos a serem atualizados
            $sql .= implode(',', $updateFields);
            
            // Se houver where a ser executado
            $sql .= $this->_parseWhere( $where, $bindColumns );
	    
            $stmt = $this->_cnn->prepare( $sql );

            return $stmt->execute( $bindColumns );

        } catch ( Exception $e ) {

            $this->_debugError( $e );

            if ( self::$_transaction )
                throw $e;
            else
                return false;
        }
    }

    public function delete( $where )
    {
        try {

            $sql = 'DELETE FROM ' . $this->getTable();

            $bindColumns = array();
            // Se houver where a ser executado
            $sql .= $this->_parseWhere( $where, $bindColumns );
	    
            $stmt = $this->_cnn->prepare( $sql );
            return $stmt->execute( $bindColumns );

        } catch ( Exception $e ) {

            $this->_debugError( $e );

            if ( self::$_transaction )
                throw $e;
            else
                return false;
        }
    }

    public function fetchRow( array $identifiers, $fields = '*' )
    {
        try {

            if ( is_array( $fields ) ) {
                $fields = implode(',', $fields );
            }

            $sql = 'SELECT ' . $fields . ' FROM ' . $this->getTable();
	    	    
            $bindColumns = array();
            // Se houver where a ser executado
            $sql .= $this->_parseWhere( $identifiers, $bindColumns );
	    
            $stmt = $this->_cnn->prepare( $sql );
            $stmt->execute( $bindColumns );

            $result = $stmt->fetchAll( PDO::FETCH_ASSOC );

            switch ( true ) {
                case empty( $result ):
                    return null;
                    break;
                /*
                case count( $result ) > 1:
                    throw new Exception('Consulta retornou mais de um resultado');
                    break;
                 */
                default:
                    $objectVO = new $this->_class();
                    $objectVO->setValues( $result[0], true );
                    return $objectVO;
            }

        } catch ( Exception $e ) {

            $this->_debugError( $e );
            return null;
        }
    }

    public function fetchAll( $order = null, array $identifiers = array(), $fields = '*', $limite = null )
    {
        try {

            if ( is_array( $fields ) ) {
                $fields = implode(',', $fields );
            }
	    
	    if ( !$fields ) $fields = '*';

            $sql = 'SELECT ' . $fields . ' FROM ' . $this->getTable();

            $bindColumns = array();
            // Se houver where a ser executado
            $sql .= $this->_parseWhere( $identifiers, $bindColumns );

            // Se tiver ordem na consulta
            if ( !empty( $order ) ) {
                
                if ( !is_array( $order ) ) {
                    $order = (array)$order;
                }

                $sql .= ' ORDER BY ' . implode(',', $order);
            }
	    
	    if ( $limite )
		$sql .= ' LIMIT ' . ( is_array( $limite ) ? implode( ',', $limite ) : $limite );
	    
            $stmt = $this->_cnn->prepare( $sql );
            $stmt->execute( $bindColumns );
            $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
	    
            $returnsVO = array();
            $objectVO = new $this->_class();

            foreach ( $result as $vo )
                $returnsVO[] = clone $objectVO->setValues( $vo, true );

            return $returnsVO;
         
        } catch ( Exception $e ) {

            $this->_debugError( $e );
            return null;
        }
    }

    protected function _parseWhere( $identifiers, &$bindColumns )
    {
        $where = '';
        
        // Se houver where a ser executado
        if ( !empty( $identifiers ) ) {

            $whereBind = array();
            foreach ( $identifiers as $key => $value ) {
                
                if ( is_null( $value ) ) {
                    $whereBind[] = $key . ' IS NULL';
                } else if ( is_numeric( $key ) ) {
                    $whereBind[] = $value;
                } else {

                    if ( is_array( $value ) ) {

                        $whereBind[] = $key . ' ' . $value[0] . ' :w_' . $key;
                        $bindColumns[':w_' . $key] = $value[1];

                    } else {
                        $whereBind[] = $key . ' = :w_' . $key;
                        $bindColumns[':w_' . $key] = $value;
                    }
                }
            }

            $where .= ' WHERE ' . implode(' AND ', $whereBind );
        }

        return $where;
    }

    public function query( $sql, $bindColumns = array() )
    {
        try {

            $stmt = $this->_cnn->prepare( $sql );
            return $stmt->execute( $bindColumns );

        } catch ( Exception $e ) {

            $this->_debugError( $e );
            return false;
        }
    }

    public function queryResult( $sql, $bindColumns = array() )
    {
        try {
            $stmt = $this->_cnn->prepare( $sql );
            $stmt->execute( $bindColumns );

            return $stmt->fetchAll( PDO::FETCH_ASSOC );

        } catch ( Exception $e ) {

            $this->_debugError( $e );
            return null;
        }
    }

    protected function _debugError( $e )
    {
        // Se for para debugar erro
        $debug = (int)ILO_Config::get( 'geral/debug' );
        if ( !empty( $debug ) )
            ILO_Util_Log::debug( $e, 'error_sql' );
    }

    public function beginTransaction()
    {
        if ( !self::$_transaction ) {
            $this->_cnn->beginTransaction();
            self::$_transaction = true;
        } else {
            throw new Exception('Bloco de transa��o j� em andamento' );
        }
    }

    public function commit()
    {
        if ( self::$_transaction ) {
            $this->_cnn->commit();
            self::$_transaction = false;
        } else {
            throw new Exception('Nao existe bloco de transacao em andamento para efetuar commit.' );
        }
    }

    public function rollBack()
    {
        if ( self::$_transaction ) {
            $this->_cnn->rollBack();
            self::$_transaction = false;
        } else {
            throw new Exception('Nao existe bloco de transacao em andamento para efetuar rollback.' );
        }
    }

    public function lastInsertedId()
    {
        return $this->_cnn->lastInsertId();
    }
}