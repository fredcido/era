<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/empresa/registro.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/empresa/registro.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
        <span class="title_wrapper_middle"></span>
        <div class="title_wrapper_content">
            <h2>
                 <?php echo $this->t('Registro de Empresa', 284); ?>
            </h2>

            <label> <?php echo $this->numEmpresa?> </label>
            
            <?php
		echo $this->_helper->aba()
			->addButton(
				array(
				    'class'	=> 'section_back',
				    'url'	=> BASE . '/empresa/registro/',
				    'label'	=> 'Listar dados',
				    'trans_id'	=> 9,
				    'role'	=> '/empresa/registro/',
				    'operation' => 'Consultar'
				)
		);
            ?>
        </div>
    </div>
    <span class="title_wrapper_bottom"></span>
</div>
<!--[if !IE]>end title wrapper<![endif]-->

<!--[if !IE]>start section content<![endif]-->
<div class="section_content">
    <span class="section_content_top"></span>

    <div class="section_content_inner">

        <?php 
        
	    require_once dirname( __FILE__ ) . '/abas.php'; 
	    require_once dirname( __FILE__ ) . '/' . $this->action . '.php'; 
	?>

    </div>
</div>
<!--[if !IE]>end section content<![endif]-->