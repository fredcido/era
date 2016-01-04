<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/default/meusdados.js"></script>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2>
		<?php echo $this->t( 'Meus dados', 5 ); ?> 
	    </h2>
	    
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
	    <form action="<?php echo BASE; ?>/index/save/" method="post"  id="form-meus-dados"
		  class="search_form general_form" onsubmit="return save( this );">
		<!--[if !IE]>start fieldset<![endif]-->
		<fieldset>

		    <input name="id_sysuser" id="id_sysuser" type="hidden" />

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
				    <input class="text required" name="name" id="name" msgError="<?php echo $this->t( 'Preencha o nome', 11 ); ?>" type="text" />
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Preencha o nome', 31 ); ?>"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Login', 21 ); ?>:
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <input class="text" disabled 
					   name="nick_name" id="nick_name" type="text" />
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Login do usuário', 32 ); ?>"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Senha', 34 ); ?>:
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <input class="text" name="password" id="password" type="password" />
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Senha do usuário', 43 ); ?>"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Confirma Senha', 44 ); ?>:
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <input class="text" name="confirm_password" id="confirm_password" type="password" />
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Confirma Senha', 44 ); ?>"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <div class="inputs">
				<?php if ( ILO_Auth_Permissao::has( '/admin/usuario/', 'salvar' ) ) : ?>
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
	$( '#form-meus-dados' ).populate( <?php echo json_encode( $this->dadosForm ); ?> );
</script>