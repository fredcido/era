<?php

class Relatorio_Controller_Index extends ILO_Controller_Padrao
{
    /**
     * 
     */
    public function init()
    {
	$this->view->relatorio_mode = true;
    }
}