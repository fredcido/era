<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/admin/usuario.js"></script>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2>
		<?php echo $this->t( 'Usuário', 1 ); ?> 
	    </h2>
	    
	    <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_back',
				  'url'		=> BASE . '/admin/usuario/',
				  'label'	=> 'Listar dados',
				  'trans_id'	=> 9,
				  'role'	=> '/admin/usuario/',
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
	    <form action="<?php echo BASE; ?>/admin/usuario/save/" method="post"  id="form-usuario"
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
				<span>*</span>
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <input class="text required" onChange="verificaUsuario();" 
					   name="nick_name" id="nick_name" msgError="<?php echo $this->t( 'Preencha o login do usuário', 33 ); ?>" type="text" />
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Login do usuário', 32 ); ?>"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Senha', 34 ); ?>:
				<span>*</span>
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <input class="text required" name="password" id="password" msgError="<?php echo $this->t( 'Preencha a senha', 42 ); ?>" type="password" />
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Senha do usuário', 43 ); ?>"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Confirma Senha', 44 ); ?>:
				<span>*</span>
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <input class="text required" name="confirm_password" id="confirm_password" msgError="<?php echo $this->t( 'Confirma Senha', 44 ); ?>" type="password" />
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Confirma Senha', 44 ); ?>"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Status', 22 ); ?>:
				<span>*</span>
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <select class="text required" name="active" id="active" msgError="<?php echo $this->t( 'Selecione o status', 45 ); ?>">
					<option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					<option value="1"><?php echo $this->t( 'Ativo', 88 ); ?></option>
					<option value="0"><?php echo $this->t( 'Inativo', 89 ); ?></option>
				    </select>
				</span>
				<span class="tip-form" title="<?php echo $this->t( 'Status', 45 ); ?>"></span>
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
    <?php if ( !empty( $this->dadosForm ) ) : ?>
	populaFormUser( <?php echo json_encode( $this->dadosForm ); ?> );
    <?php endif; ?>
</script>