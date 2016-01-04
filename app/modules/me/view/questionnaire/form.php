<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/me/questionnaire.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/me/questionnaire.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
        <span class="title_wrapper_middle"></span>
        <div class="title_wrapper_content">
            <h2>
                <?php echo $this->t( 'Questionnaires', 669 ); ?> 
            </h2>
	    
	    <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_back',
				  'url'		=> BASE . '/me/questionnaire/',
				  'label'	=> 'Listar dados',
				  'trans_id'	=> 9,
				  'role'	=> '/me/questionnaire/',
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
            <form action="<?php echo BASE; ?>/me/questionnaire/save/" method="post"  id="form-questionnaire"
                  class="search_form general_form" onsubmit="return save( this );">
                <!--[if !IE]>start fieldset<![endif]-->
                <fieldset>

                    <input name="id_questionnaire" id="id_questionnaire" value="" type="hidden" />

                    <!--[if !IE]>start forms<![endif]-->
                    <div class="forms">

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Título', 670 ); ?>:
				    <span>*</span>
				</label>
				<div class="inputs">
				    <span class="input_wrapper large_input">
					<select class="text required tip-error" name="fk_id_questionnaire_config" id="fk_id_questionnaire_config"
						onChange="getQuestionnaire();"
						msgError="<?php echo $this->t( 'Selecione o questionario', 684 ); ?>" >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

					    <?php foreach ( $this->questions as $question ) : ?>
						<option value="<?php echo $question->getIdQuestionnaireConfig(); ?>">
						    <?php echo $question->getTitle(); ?>
						</option>
					    <?php endforeach; ?>
					</select>
				    </span>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Identificador', 685 ); ?>:
				    <span>*</span>
				</label>
				<div class="inputs">
				    <span class="input_wrapper large_input">
					<input class="text required tip-error" name="identifier" 
						    msgError="<?php echo $this->t( 'Preencha esse campo', 648 ); ?>"
						    maxlength="200" id="identifier" type="text" />
				    </span>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

				<!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Distrito', 96 ); ?>:
				    <span>*</span>
				</label>
				<div class="inputs">
				    <ul>
					<li>
					    <span class="input_wrapper">
						<select class="text required tip-error" name="fk_id_add_district" id="fk_id_add_district"
							onChange="carregaCombo( '/me/questionnaire/subdistritos/id/' + this.value, 'fk_id_add_subdistrict' );"
							msgError="<?php echo $this->t( 'Selecione o distrito', 97 ); ?>" >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

						    <?php foreach ( $this->distritos as $distrito ) : ?>
							<option value="<?php echo $distrito->getIdAddDistrict(); ?>">
							    <?php echo $distrito->getDistrict(); ?>
							</option>
						    <?php endforeach; ?>
						</select>
					    </span>
					    <span class="tip-form" title="<?php echo $this->t( 'Distrito', 96 ); ?>"></span>
					</li>
					<li>
					    <label>
						<?php echo $this->t( 'Sub-distrito', 98 ); ?>:
						<span>*</span>
					    </label>
					</li>
					<li>
					    <span class="input_wrapper">
						<select class="text required tip-error" name="fk_id_add_subdistrict" id="fk_id_add_subdistrict"
							onChange="carregaCombo( '/me/questionnaire/sukus/id/' + this.value, 'fk_id_suku' );"
							msgError="<?php echo $this->t( 'Selecione o sub-distrito', 99 ); ?>" disabled >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

						</select>
					    </span>
					    <span class="tip-form" title="<?php echo $this->t( 'Sub-distrito', 98 ); ?>"></span>
					</li>
				    </ul>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Suku', 100 ); ?>:
				    <span>*</span>
				</label>
				<div class="inputs">
				    <ul>
					<li>
					    <span class="input_wrapper">
						<select class="text required tip-error" name="fk_id_suku" id="fk_id_suku"
							msgError="<?php echo $this->t( 'Selecione o sub-distrito', 101 ); ?>" disabled >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
						</select>
					    </span>
					    <span class="tip-form" title="<?php echo $this->t( 'Suku', 100 ); ?>"></span>
					</li>
					<li>
					    <label>
						<?php echo $this->t( 'Data de registro', 76 ); ?>:
						<span>*</span>
					    </label>
					</li>
					<li>
					    <span class="input_wrapper">
						<input class="text required tip-error date-mask" name="date_registration" 
						    msgError="<?php echo $this->t( 'Preencha a data de registro', 77 ); ?>" 
						    maxlength="10" id="date_registration" type="text" />
					    </span>
					    <span class="tip-form" title="<?php echo $this->t( 'Data de registro', 76 ); ?>"></span>
					</li>
				    </ul>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Road location', 626 ); ?>:
				    <span>*</span>
				</label>
				<div class="inputs">
				    <ul>
					<li>
					    <span class="input_wrapper">
						<input class="text required tip-error" name="road_location" 
						    msgError="<?php echo $this->t( 'Preencha a Road location', 627 ); ?>" 
						    maxlength="200" id="road_location" type="text" />
					    </span>
					    <span class="tip-form" title="<?php echo $this->t( 'Road location', 626 ); ?>"></span>
					</li>
					<li>
					    <label>
						<?php echo $this->t( 'Code', 628 ); ?>:
						<span>*</span>
					    </label>
					</li>
					<li>
					    <span class="input_wrapper">
						<input class="text required tip-error" msgError="<?php echo $this->t( 'Preencha o code', 629 ); ?>" 
						    name="code" id="code" maxlength="50" type="text" />
					    </span>
					    <span class="tip-form" title="<?php echo $this->t( 'Code', 628 ); ?>"></span>
					</li>
				    </ul>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

			    <div class="row">
				<div class="modules">
				    <div class="module">
					<div class="module_top">
					    <h5>&nbsp;&nbsp;<?php echo $this->t( 'Perguntas', 673 ); ?></h5>
					</div>
					<div class="module_bottom" id="question-container">
					</div>
				    </div>
				</div>
			    </div>

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<div class="inputs input-button">
				    <?php if ( ILO_Auth_Permissao::has( '/me/questionnaire/', 'salvar' ) ) : ?>
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
    $( document ).ready(
	function()
	{
	    var dataForm = <?php echo $this->data; ?>;
	    
	    <?php if ( !empty( $this->data ) ) : ?>
	
		$( '#form-questionnaire' ).populate( dataForm );
		
		if ( dataForm.fk_id_add_district ) {

		    // Busca subdistritos e popula combo
		    carregaCombo( 
			'/me/questionnaire/subdistritos/id/' + dataForm.fk_id_add_district, 
			'fk_id_add_subdistrict',
			function()
			{
			    $( '#fk_id_add_subdistrict' ).val( dataForm.fk_id_add_subdistrict );
			}
		    );

		    // Busca sukus e popula combo
		    carregaCombo( 
			'/me/questionnaire/sukus/id/' + dataForm.fk_id_add_subdistrict, 
			'fk_id_suku',
			function()
			{
			    $( '#fk_id_suku' ).val( dataForm.fk_id_suku );
			}
		    );
		}
		
		getQuestionnaire();

	    <?php endif; ?>
	}
    );
</script>