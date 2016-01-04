<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/treinamento/participantes.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/treinamento/participantes.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
        <span class="title_wrapper_middle"></span>
        <div class="title_wrapper_content">
            <h2>
                 <?php echo $this->t('Registro de Participantes', 276); ?> 
            </h2>
            
            <label> <?php echo $this->numCliente; ?> </label>

            <?php
		echo $this->_helper->aba()
			->addButton(
				array(
				    'class'	=> 'section_back',
				    'url'	=> BASE . '/treinamento/participantes/',
				    'label'	=> 'Listar dados',
				    'trans_id'	=> 9,
				    'role'	=> '/treinamento/participantes/',
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