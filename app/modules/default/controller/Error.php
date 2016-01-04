<?php

class Default_Controller_Error extends ILO_Controller_Padrao
{
    public function init()
    {
        $this->view->renderLayout( false );

        $this->view->error = $this->getParam( 'error' );

        $this->view->renderNewView( 'error' );
    }

    public function errorAction()
    {
        $this->view->type = 'error';
    }

    public function permissaoAction()
    {
        $this->view->type = 'permissao';
        $this->view->rota = $this->getParam( 'routeDenied' );
    }
}