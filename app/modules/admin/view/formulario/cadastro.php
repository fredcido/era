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
				  'class'	=> 'section_back',
				  'url'		=> BASE . '/admin/formulario/',
				  'label'	=> 'Listar dados',
				  'trans_id'	=> 9,
				  'role'	=> '/admin/formulario/',
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
            <form action="<?php echo BASE; ?>/admin/formulario/save/" method="post"  id="form-formulario"
                  class="search_form general_form" onsubmit="return save( this );">
                <!--[if !IE]>start fieldset<![endif]-->
                <fieldset>

                    <input name="id_sysform" id="id_sysform" value="" type="hidden" />

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
                                    <input class="text required tip-error" name="form_name" id="form_name" msgError="<?php echo $this->t( 'Preencha o nome', 11 ); ?>" type="text" />
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Nome do formulário', 26 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->

                        <!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <label>
                                <?php echo $this->t( 'Caminho', 2 ); ?>:
                                <span>*</span>
                            </label>
                            <div class="inputs">
                                <span class="input_wrapper">
                                    <select class="text required tip-error" name="fk_id_sysmodule" id="fk_id_sysmodule" msgError="<?php echo $this->t( 'Selecione o módulo', 28 ); ?>">
                                        <option value="">Selecione</option>
                                        <?php foreach ($this->modules as $modulo) : ?>
                                            <option value="<?php echo $modulo->getIdSysmodule(); ?>">
                                                <?php echo $modulo->getModule(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Selecione o módulo', 28 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->

                        <!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <label>
                                <?php echo $this->t( 'Caminho', 27 ); ?> 
                                <span>*</span>
                            </label>
                            <div class="inputs">
                                <span class="input_wrapper">
                                    <input class="text required tip-error" name="file_system" id="file_system" msgError="<?php echo $this->t( 'Preencha o caminho', 29 ); ?>" type="text" />
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Preencha o caminho', 29 ); ?>"></span>
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
                                <span class="tip-form" title="<?php echo $this->t( 'Descrição', 13 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->

                        <!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <div class="inputs">
				<?php if ( ILO_Auth_Permissao::has( '/admin/formulario/', 'salvar' ) ) : ?>
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
                    
                    <div class="module_operation">
                            <!--[if !IE]>start module top<![endif]-->
                            <div class="module_top">
                                <h5>Opera&ccedil;&otilde;es</h5>
                            </div>
                            <!--[if !IE]>end module top<![endif]-->
                            <!--[if !IE]>start module bottom<![endif]-->
                            <div class="module_bottom">
                                <!--[if !IE]>start module options<![endif]-->
                                <div class="module_options">
                                    <div class="module_options_inner">
                                        <!--[if !IE]>start module option<![endif]-->
                                        <div class="module_option">
                                            <dl>
                                                
                                                <?php foreach ( $this->operations as $operation ) :?>
                                                    
                                                <dd><input class="checkbox" name="fk_id_sysoperation[]" type="checkbox" value="<?php echo $operation->getIdSysoperation(); ?>" /> <?php echo $operation->getOperation(); ?> </dd>
                                                
                                                <?php endforeach;?>
                                                
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end module options<![endif]-->
                            </div>
                            <!--[if !IE]>end module bottom<![endif]-->
                        </div>

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
<?php if (!empty($this->dadosForm)) : ?>
            $( '#form-formulario' ).populate( <?php echo json_encode($this->dadosForm); ?> );
<?php endif; ?>
</script>