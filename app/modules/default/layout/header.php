<!--[if !IE]>start header<![endif]-->
<div id="header">
    <div class="inner">
	<h1 id="logo">
            <a href="<?php echo BASE; ?>">
		<?php echo $config->geral->appname; ?>
	    </a>
	</h1>

	
	<!--[if !IE]>start user details<![endif]-->
	<div id="user_details">
	    
	    <?php if ( ILO_Router_Dispatcher::getModule() != 'relatorio' ) : ?>
	    
		<ul id="user_details_menu">
		    <li class="welcome">
			<?php echo $this->t( 'Bem-vindo', 4 ); ?> 
			<strong>
			    <?php echo ILO_Auth_Acesso::getIdentity()->getName(); ?>
			</strong>
		    </li>

		    <li>
			<ul id="user_access">
			    <li class="first">
				<a href="<?php echo BASE; ?>/index/dados/">
				    <?php echo $this->t( 'Meus dados', 5 ); ?> 
				</a>
			    </li>
			    <li class="last">
				<a href="<?php echo BASE; ?>/auth/logout/">
				    <?php echo $this->t( 'Sair', 8 ); ?> 
				</a>
			    </li>
			</ul>
		    </li>


		</ul>
	    
	    <?php endif; ?>

	    <div id="server_details">
		<dl>
		    <dt>
		    <?php echo $this->t( 'Data/hora', 6 ); ?> :
		    </dt>
		    <dd><?php echo date( 'd/m/Y | H:i' ); ?></dd>
		</dl>
		<dl>
		    <dt>IP:</dt>
		    <dd><?php echo $_SERVER['REMOTE_ADDR']; ?></dd>
		</dl>
	    </div>

	</div>

	<!--[if !IE]>end user details<![endif]-->
    </div>
</div>
<!--[if !IE]>end header<![endif]-->