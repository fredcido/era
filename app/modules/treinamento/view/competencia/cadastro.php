<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/treinamento/competencia.js"></script>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
        <span class="title_wrapper_middle"></span>
        <div class="title_wrapper_content">
            <h2>
                <?php echo $this->t( 'Unidades de competência', 697 ); ?> 
            </h2>
	    
	    <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_back',
				  'url'		=> BASE . '/treinamento/competencia/',
				  'label'	=> 'Listar dados',
				  'trans_id'	=> 9,
				  'role'	=> '/treinamento/competencia/',
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
            <form action="<?php echo BASE; ?>/treinamento/competencia/save/" method="post"  id="form-curso"
                  class="search_form general_form" onsubmit="return save( this );">
                <!--[if !IE]>start fieldset<![endif]-->
                <fieldset>

                    <input name="id_unit_competency" id="id_unit_competency" value="" type="hidden" />

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
                                    <input class="text required tip-error" name="name_unit" id="name_unit" msgError="<?php echo $this->t( 'Preencha o nome', 11 ); ?>" type="text" />
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Nome da competência', 708 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <label>
                                <?php echo $this->t( 'Acrônimo', 693 ); ?>:
                                <span>*</span>
                            </label>
                            <div class="inputs">
                                <span class="input_wrapper">
                                    <input class="text required tip-error" maxlength="100" name="cod_unit" id="cod_unit" msgError="<?php echo $this->t( 'Preencha o acrônimo', 695 ); ?>" type="text" />
                                </span>
				<span class="tip-form" title="<?php echo $this->t( 'Acrônimo da competência', 709 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->


                        <!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <div class="inputs">
				<?php if ( ILO_Auth_Permissao::has( '/treinamento/competencia/', 'salvar' ) ) : ?>
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
    $(document).ready(
	function()
	{
	    <?php if ( !empty( $this->dadosForm ) ) : ?>
		$( '#form-curso' ).populate( <?php echo json_encode($this->dadosForm); ?> );
		$( '#cod_unit' ).attr('readonly', true);
	    <?php endif; ?>
	}
    );
</script>