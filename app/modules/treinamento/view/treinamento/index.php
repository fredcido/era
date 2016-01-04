<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/treinamento/treinamento.js"></script>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2>
		<?php echo $this->t( 'Treinamento', 210 ); ?> 
	    </h2>
	     
	    <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_add',
				  'label'	=> 'Novo',
				  'trans_id'	=> 17,
				  'id'		=> 'novo',
				  'role'	=> '/treinamento/treinamento/',
				  'operation'	=> 'Salvar'
			      )
			  )
			  ->addButton(
			      array(
				  'class'	=> 'section_edit',
				  'label'	=> 'Editar',
				  'trans_id'	=> 18,
				  'id'		=> 'editar',
				  'role'	=> '/treinamento/treinamento/',
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
	
	<div id="gridTreinamento" class="gridTela"></div>
	<div id="divPagTreinamento" class="pagingBlock"></div>
	
    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    initGridTreinamento();
	    gridTreinamento.parse( <?php echo $this->data; ?>, 'json' );
	    
	    <?php if ( ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
		gridTreinamento.attachEvent( 'onRowDblClicked', editItem );
	    <?php endif; ?>
	}
    )
</script>