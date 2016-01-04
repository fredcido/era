<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/treinamento/participantes.js"></script>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
        <span class="title_wrapper_middle"></span>
        <div class="title_wrapper_content">
            <h2>
                <?php echo $this->t('Participantes', 211); ?> 
            </h2>

            <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_add',
				  'label'	=> 'Novo',
				  'trans_id'	=> 17,
				  'id'		=> 'novo',
				  'role'	=> '/treinamento/participantes/',
				  'operation'	=> 'Salvar'
			      )
			  )
			  ->addButton(
			      array(
				  'class'	=> 'section_edit',
				  'label'	=> 'Editar',
				  'trans_id'	=> 18,
				  'id'		=> 'editar',
				  'role'	=> '/treinamento/participantes/',
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
	
	<div id="gridParticipantes" class="gridTela"></div>
	<div id="divPagParticipantes" class="pagingBlock"></div>
	
    </div>

    <span class="section_content_bottom"></span>
    
</div>
<!--[if !IE]>end section content<![endif]-->

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    initGridParticipantes();
	    gridParticipantes.parse( <?php echo $this->dataParticipantes; ?>, 'json' );
            
            <?php if ( ILO_Auth_Permissao::has( '/treinamento/participantes/', 'salvar' ) ) : ?>
		gridParticipantes.attachEvent( 'onRowDblClicked', editItem );
	    <?php endif; ?>
            
	}
    )
</script>