<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/admin/formulario.js"></script>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2>
		<?php echo $this->t( 'Formulário', 3 ); ?> 
	    </h2>
	    
	    <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_add',
				  'label'	=> 'Novo',
				  'trans_id'	=> 17,
				  'id'		=> 'novo',
				  'role'	=> '/admin/formulario/',
				  'operation'	=> 'Salvar'
			      )
			  )
			  ->addButton(
			      array(
				  'class'	=> 'section_edit',
				  'label'	=> 'Editar',
				  'trans_id'	=> 18,
				  'id'		=> 'editar',
				  'role'	=> '/admin/formulario/',
				  'operation'	=> 'Salvar'
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
	
	<div id="gridFormulario" class="gridTela"></div>
	<div id="divPagFormulario" class="pagingBlock"></div>
	
    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    initGrid();
	    grid.parse( <?php echo $this->data; ?>, 'json' );
	    
	    <?php if ( ILO_Auth_Permissao::has( '/admin/formulario/', 'salvar' ) ) : ?>
		grid.attachEvent( 'onRowDblClicked', editItem );
	    <?php endif; ?>
	}
    )
</script>