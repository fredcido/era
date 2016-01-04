<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="<?php echo BASE; ?>/public/styles/error.css" />
        <title>Error - <?php echo ILO_Config::get( 'geral/appname' ); ?></title>
    </head>
    <body>
        <div class="mainError">
        <div class="container">
            <div class="errorLabel"></div>
            <div class="contentHeader"></div>
            <div class="contentMiddle clear">
                <div class="leftContent">
                    <div class="<?php echo 'permissao' == $this->type ? 'denied' : 'smiley'; ?>"></div>
                </div>
                <div class="rightContent">
                    <h1>OOOPS...</h1>
                    <?php if ( 'permissao' == $this->type ) { ?>
                        <h3><?php echo $this->t( 'Acesso Negado', 150 ); ?></h3>
                        <p><?php echo $this->t( 'Você tentou acessar uma página não permitida', 152 ); ?></p>
                    <?php } else { ?>
                        <h3><?php echo $this->t( 'Ocorreu um erro', 151 ); ?></h3>
                        <p><?php echo $this->t( 'Você tentou executar uma operação com a qual o sistema se comportou de forma inadequada', 153 ); ?>.</p>
                    <?php } ?>

                    <?php if ( 'error' == $this->type ) { ?>
                      
                        <h3><?php echo $this->t( 'Causas', 154 ); ?></h3>
                        <ul>
                            <li><?php echo $this->error->getMessage(); ?></li>
                        </ul>
                        <?php if ( 1 == $this->debug ) : ?>
                            <div class="debug">
                                <?php ILO_Util_Debug::dump( $this->error ); ?>
                            </div>
                        <?php endif; ?>

                    <?php } else { ?>

                        <h3><?php echo $this->t( 'Rota', 155 ); ?></h3>
                        <ul>
                            <li>
                                <?php echo implode(' > ', $this->rota ); ?>
                            </li>
                        </ul>

                    <?php } ?>

                    <div class="space20"></div>
                </div>
            </div>
            <div class="contentFooter"></div>
        </div>
        </div>
    </body>
</html>