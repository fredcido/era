<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/admin/permissao.js"></script>

<?php $checkDisabled = ILO_Auth_Permissao::has( '/admin/permissao/', 'salvar' ) ? '' : 'disabled'; ?>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2><?php echo $this->t( 'Permissão', 30 ); ?></h2>
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

		    <!--[if !IE]>start forms<![endif]-->
		    <div class="forms">
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Usuário', 1 ); ?>
				<span>*</span>
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <select class="text" name="id_sysuser" id="id_sysuser" onChange="buscaPermissoes();">
					<option value="">Selecione</option>
					<?php foreach ( $this->usuarios as $usuario ) : ?>
    					<option value="<?php echo $usuario->getIdSysuser(); ?>">
						<?php echo $usuario->getName(); ?>
    					</option>
					<?php endforeach; ?>
				    </select>
				</span>
				<span class="tip-form" title="Seleção do módulo"></span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->

		    </div>
		    <!--[if !IE]>end forms<![endif]-->
		    
		</fieldset>
		<!--[if !IE]>end fieldset<![endif]-->
		
		<div class="module">
		    <!--[if !IE]>start module top<![endif]-->
		    <div class="module_top">
			<h5><?php echo $this->t( 'Permissão', 30 ); ?></h5>
		    </div>
		    <!--[if !IE]>end module top<![endif]-->
		    <!--[if !IE]>start module bottom<![endif]-->
		    <div class="module_bottom">
			<ul id="permissoes_usuario" class="filetree">
			    <?php foreach ( $this->permissoes as $modulo ) : ?>
				<li>
				    <span class="folder"><?php echo $modulo['modulo']->getModule(); ?></span>
				    <ul>
					<?php foreach ( $modulo['telas'] as  $tela ) : ?>
					    <li>
						<span class="folder"><?php echo $tela['form']->getFormName(); ?></span>
						<ul>
						    <?php foreach ( $tela['operacoes'] as $operacao ) : ?>
							<li>
							    <span>
								<input type="checkbox" <?php echo $checkDisabled; ?> 
								       id="oper_<?php echo $tela['form']->getIdSysform(); ?>_<?php echo $operacao->getFkIdSysoperation()->getIdSysoperation(); ?>" 
								       value='<?php echo json_encode( $operacao->toArray() ); ?>' />
								<label for="oper_<?php echo $tela['form']->getIdSysform(); ?>_<?php echo $operacao->getFkIdSysoperation()->getIdSysoperation(); ?>" >
								    <?php echo $operacao->getFkIdSysoperation()->getOperation(); ?>
								</label>
							    </span>
							</li>
						    <?php endforeach; ?>
						</ul>
					    </li>
					<?php endforeach; ?>
				    </ul>
				</li>
			    <?php endforeach; ?>
			</ul>
		    </div>
		    <!--[if !IE]>end module bottom<![endif]-->
		</div>
	    </form>
	</div>
	<!--[if !IE]>end forms<![endif]-->
    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->