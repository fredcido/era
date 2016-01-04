<?php

    class ILO_Util_HttpClient
    {
	/**
	 *
	 * @var string
	 */
	protected $_url;
	
	/**
	 *
	 * @var string
	 */
	protected $_proxy;
	
	/**
	 *
	 * @var string
	 */
	protected $_agent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.168 Safari/535.19';
	
	/**
	 *
	 * @var string
	 */
	protected $_proxyUser;
	
	/**
	 *
	 * @var string
	 */
	protected $_proxyPass;
	
	/**
	 *
	 * @var int
	 */
	protected $_timeout = 30;
	
	/**
	 *
	 * @var array
	 */
	protected $_post = array();
	
	/**
	 *
	 * @var array
	 */
	protected $_parameters = array();
	
	/**
	 *
	 * @return string
	 */
	public function getUrl()
	{
	    return $this->_url;
	}

	/**
	 *
	 * @param string $url 
	 */
	public function setUrl( $url )
	{
	    $this->_url = $url;
	    return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function getProxy()
	{
	    return $this->_proxy;
	}

	/**
	 *
	 * @param string $proxy 
	 */
	public function setProxy( $proxy )
	{
	    $this->_proxy = $proxy;
	    return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function getAgent()
	{
	    return $this->_agent;
	}

	/**
	 *
	 * @param string $agent 
	 */
	public function setAgent( $agent )
	{
	    $this->_agent = $agent;
	    return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function getProxyUser()
	{
	    return $this->_proxyUser;
	}

	/**
	 *
	 * @param string $proxyUser 
	 */
	public function setProxyUser( $proxyUser )
	{
	    $this->_proxyUser = $proxyUser;
	    return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function getProxyPass()
	{
	    return $this->_proxyPass;
	}
	
	/**
	 *
	 * @param array $post 
	 */
	public function setPost( $post )
	{
	    $this->_post = $post;
	    return $this;
	}

	/**
	 *
	 * @param string $proxyPass 
	 */
	public function setProxyPass( $proxyPass )
	{
	    $this->_proxyPass = $proxyPass;
	    return $this;
	}
	
	/**
	 *
	 * @return int
	 */
	public function getTimeout()
	{
	    return $this->_timeout;
	}

	/**
	 *
	 * @param int $timeout 
	 */
	public function setTimeout( $timeout )
	{
	    $this->_timeout = $timeout;
	    return $this;
	}

	/**
	 *
	 * @param string $url
	 * @param string $proxy
	 * @return type
	 * @throws Exception 
	 */
	public function request( $url = null, $proxy = null )
	{
	    if ( !empty( $url ) )
		$this->setUrl( $url );
	    
	    if ( !empty( $proxy ) )
		$this->setProxy( $proxy );
	    
	    $ch = curl_init();
	    
	    $this->_parseParameters();
	    
	    // Set the parameters to request execution
	    curl_setopt_array( $ch, $this->_parameters );
	    $output = curl_exec( $ch );
            
	    //curl_close( $ch);

            if (empty($output) || curl_errno($ch))
	    //if ( $info['http_code'] != 200 )
		throw new ILO_Util_HttpException( curl_error( $ch ) );
	    
	    return trim( $output );
	}
        
	
	/**
	 * 
	 */
	protected function _parseDefaultParameters()
	{
	    $this->_parameters = array(
		CURLOPT_HEADER		=> 0,
		CURLOPT_RETURNTRANSFER	=> 1,
                CURLOPT_FOLLOWLOCATION  => 1
	    );
	}
	
	/**
	 *
	 * @throws Exception 
	 */
	protected function _parseParameters()
	{
	    // Setting the default parameters
	    $this->_parseDefaultParameters();
	    
	    if ( !empty( $this->_agent ) )
		$this->_parameters[CURLOPT_USERAGENT] = $this->getAgent();
		
	    if ( !empty( $this->_timeout ) )
		$this->_parameters[CURLOPT_CONNECTTIMEOUT] = $this->getTimeout();
	    
	    if ( empty( $this->_url ) )
		throw new Exception( 'The url must be set to do a request' );
	    else
		$this->_parameters[CURLOPT_URL] = $this->getUrl();
	    
	    if ( !empty( $this->_proxy ) ) {
		
		$this->_parameters[CURLOPT_PROXY] = $this->getProxy();
		$this->_parameters[CURLOPT_HTTPPROXYTUNNEL] = 1;
		
		if ( !empty( $this->_proxyPass ) ) {
		    
		    $proxyCredentials = $this->_proxyUser . ':' . $this->_proxyPass;
		    $this->_parameters[CURLOPT_PROXYUSERPWD] = $proxyCredentials;
		}
	    }
	    
	    if ( !empty( $this->_post ) ) {
		
		$paramsUri = http_build_query( $this->_post );
		
		$this->_parameters[CURLOPT_POST] = count( $this->_post );
		$this->_parameters[CURLOPT_POSTFIELDS] = $paramsUri;
	    }
	}
    }