<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2>
		<?php echo $this->t( 'Área de trabalho', 7 ); ?>
	    </h2>
	</div>
    </div>
    <span class="title_wrapper_bottom"></span>
</div>
<!--[if !IE]>end title wrapper<![endif]-->

<?php
    $dashboard = array(
	array(
	    'label' => 'Módulo',
	    'id'    => 2,
	    'url'   => '/admin/modulo/',
	    'class' => 'd2',
	),
	array(
	    'label' => 'Formulário',
	    'id'    => 3,
	    'url'   => '/admin/formulario/',
	    'class' => 'd11',
	),
	array(
	    'label' => 'Usuário',
	    'id'    => 1,
	    'url'   => '/admin/usuario/',
	    'class' => 'd1',
	),
	array(
	    'label' => 'Permissão',
	    'id'    => 30,
	    'url'   => '/admin/permissao/',
	    'class' => 'd8',
	),
	array(
	    'label' => 'Perfil Contrato',
	    'id'    => 138,
	    'url'   => '/beneficiario/contrato/',
	    'class' => 'd17',
	),
	array(
	    'label' => 'Contratados',
	    'id'    => 139,
	    'url'   => '/beneficiario/beneficiario/',
	    'class' => 'd18',
	),
	array(
	    'label' => 'Relatórios' ,
	    'id'    => 407,
	    'url'   => '/relatorio/',
	    'class' => 'd19',
	),
    );

?>

<!--[if !IE]>start section content<![endif]-->
<div class="section_content">
    <span class="section_content_top"></span>

    <div class="section_content_inner">
	<!--[if !IE]>start dashboard menu<![endif]-->
	<div class="dashboard_menu_wrapper">
	    <ul class="dashboard_menu">
		<?php foreach ( $dashboard as $dash ) : ?>
		
		    <?php
			$action = false;
			
			if ( !ILO_Auth_Permissao::has( $dash['url'] ) && $dash['url'] != '/relatorio/' )
			    continue;
                        
			if ( ILO_Auth_Permissao::has( $dash['url'], 'consultar' ) || $dash['url'] == '/relatorio/' )
			    $action = 'index';
			
			if ( !$action && ILO_Auth_Permissao::has( $dash['url'], 'salvar' ) )
			    $action = 'cadastro';
			
			if ( !$action )
			    continue;
		    ?>
		
		    <li>
			<a href="<?php echo BASE . $dash['url'] . $action; ?>" class="<?php echo $dash['class']; ?>">
			    <span>
				<?php echo $this->t( $dash['label'], $dash['id'] ); ?>
			    </span>
			</a>
		    </li>
		<?php endforeach; ?>
	    </ul>
	</div>
	<!--[if !IE]>end dashboard menu<![endif]-->	
    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->