<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/admin/modulo.js"></script>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2>
		<?php echo $this->t( 'Módulo', 2 ); ?> 
	    </h2>
	    
	    <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_back',
				  'url'		=> BASE . '/admin/modulo/',
				  'label'	=> 'Listar dados',
				  'trans_id'	=> 9,
				  'role'	=> '/admin/modulo/',
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



	<!--[if !IE]>start forms<![endif]-->
	<div class="forms_wrapper">
	    <form action="<?php echo BASE; ?>/admin/modulo/save/" method="post"  id="form-module"
		  class="search_form general_form" onsubmit="return save( this );">
		<!--[if !IE]>start fieldset<![endif]-->
		<fieldset>

		    <input name="id_sysmodule" id="id_sysmodule" value="" type="hidden">

		    <!--[if !IE]>start forms<![endif]-->
		    <div class="forms">

			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Nome', 10 ); ?>:
				<span>*</span>
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <input class="text required" name="module" id="module" msgError="<?php echo $this->t( 'Preencha o nome', 11 ); ?>" type="text" />
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Nome do módulo', 12 ); ?>"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				Path:
				<span>*</span>
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <input class="text required" name="path" id="path" msgError="Preenchar o path" type="text" />
				</span>
				<span class="tip-form" title="Caminho do módulo"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Descrição', 13 ); ?>:
			    </label>
			    <div class="inputs">										
				<span class="input_wrapper textarea_wrapper">
				    <textarea rows="5" cols="40" class="text" name="description" id="description"></textarea>
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Descrição do módulo', 14 ); ?>"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->

			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <div class="inputs">
				<?php if ( ILO_Auth_Permissao::has( '/admin/modulo/', 'salvar' ) ) : ?>
				    <span class="button blue_button">
					<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
					<input name="operacao" type="submit" />
				    </span>
				<?php endif; ?>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->

		    </div>
		    <!--[if !IE]>end forms<![endif]-->

		</fieldset>
		<!--[if !IE]>end fieldset<![endif]-->
	    </form>
	</div>
	<!--[if !IE]>end forms<![endif]-->

	<!--[if !IE]>start section sidebar<![endif]-->


    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->


<script type="text/javascript">
    <?php if ( !empty( $this->dadosForm ) ) : ?>
	$( '#form-module' ).populate( <?php echo json_encode( $this->dadosForm ); ?> );
    <?php endif; ?>
</script>