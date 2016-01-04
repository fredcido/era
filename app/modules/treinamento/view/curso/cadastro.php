<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/treinamento/curso.js"></script>

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
        <span class="title_wrapper_middle"></span>
        <div class="title_wrapper_content">
            <h2>
                <?php echo $this->t( 'Curso', 692 ); ?> 
            </h2>
	    
	    <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_back',
				  'url'		=> BASE . '/treinamento/curso/',
				  'label'	=> 'Listar dados',
				  'trans_id'	=> 9,
				  'role'	=> '/treinamento/curso/',
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
            <form action="<?php echo BASE; ?>/treinamento/curso/save/" method="post"  id="form-curso"
                  class="search_form general_form" onsubmit="return save( this );">
                <!--[if !IE]>start fieldset<![endif]-->
                <fieldset>

                    <input name="id_course" id="id_course" value="" type="hidden" />

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
                                    <input class="text required tip-error" name="course" id="course" msgError="<?php echo $this->t( 'Preencha o nome', 11 ); ?>" type="text" />
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Nome do curso', 694 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->
			
			<!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <label>
                                <?php echo $this->t( 'Acreditado', 707 ); ?>:
                                <span>*</span>
                            </label>
                            <div class="inputs">
                                <span class="input_wrapper">
				    <select class="text required tip-error" name="certificate" id="certificate" >
					<option value="1"><?php echo $this->t( 'Sim', 86 ); ?></option>
					<option value="0"><?php echo $this->t( 'Não', 87 ); ?></option>
				    </select>
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Acrônimo do curso', 696 ); ?>"></span>
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
                                    <input class="text required tip-error" name="acronym" maxlength="10" id="acronym" msgError="<?php echo $this->t( 'Preencha o acrônimo', 695 ); ?>" type="text" />
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Acrônimo do curso', 696 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->


                        <!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <div class="inputs">
				<?php if ( ILO_Auth_Permissao::has( '/treinamento/curso/', 'salvar' ) ) : ?>
				    <span class="button blue_button">
					<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
					<input name="operacao" type="submit" />
				    </span>
				<?php endif; ?>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->
			
			<?php if ( !empty( $this->dadosForm ) ) : ?>
			
			    <div class="row">
				<h3><?php echo $this->t( 'Unidades de competência', 697 ); ?></h3>
				<hr>
			    </div>

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<div id="gridAvailableUnit" class="gridTela"></div>
				<div id="divPagAvailableUnit" class="pagingBlock"></div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

			    <div class="row row-button" style="text-align: center">
				<span id="add-unit" class="button blue_button">
				    <span><span><?php echo $this->t( 'Aumentar', 620 ); ?></span></span>
				    <input type="button" name="operacao">
				</span>
				<span id="remove-unit" class="button green_button">
				    <span><span><?php echo $this->t( 'Remover', 214 ); ?></span></span>
				    <input type="button" name="operacao">
				</span>
			    </div>

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<div id="gridUnitCourse" class="gridTela"></div>
				<div id="divPagUnitCourse" class="pagingBlock"></div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->
			
			<?php endif; ?>

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
		$( '#acronym' ).attr('readonly', true);
		
		initGridAvailableUnit();
		initGridUnitCourse();
		
		gridAvailableUnit.parse( <?php echo $this->unit_competency; ?>, 'json' );
		gridUnitCourse.parse( <?php echo $this->unit_course; ?>, 'json' );
		
	    <?php endif; ?>
	}
    );
</script>