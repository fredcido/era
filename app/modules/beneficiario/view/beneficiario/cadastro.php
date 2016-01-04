<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/beneficiario/beneficiario.js"></script>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2>
		<?php echo $this->t( 'Beneficiário', 47 ); ?> 
	    </h2>
	    
	    <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_back',
				  'url'		=> BASE . '/beneficiario/beneficiario/',
				  'label'	=> 'Listar dados',
				  'trans_id'	=> 9,
				  'role'	=> '/beneficiario/beneficiario/',
				  'operation'	=> 'Consultar'
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
	
	<h3 style="margin-bottom: 10px;"><?php echo $this->t( 'Contrato', 37 ); ?> </h3>
	
	<div id="gridProjetos" class="gridTela"></div>
	<div id="divPagProjetos" class="pagingBlock"></div>
	
    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->


<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    initGridProjetos();
	    gridProjetos.parse( <?php echo $this->dataProjetos; ?>, 'json' );
	}
    )
</script>