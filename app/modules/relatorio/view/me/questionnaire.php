<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/relatorio/questionnaire.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/relatorio/questionnaire.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2><?php echo $this->t( 'Relatorio Questionnaire', 686 ); ?> </h2>	    
	</div>
    </div>
    <span class="title_wrapper_bottom"></span>
</div>
<!--[if !IE]>end title wrapper<![endif]-->

<!--[if !IE]>start section content<![endif]-->
<div class="section_content report-container">
    <span class="section_content_top"></span>

    <div class="section_content_inner">

	<!--[if !IE]>start forms<![endif]-->
	<div class="forms_wrapper">
	    <form action="<?php echo BASE; ?>/relatorio/me/list/" method="post"
		  class="search_form general_form" id="form-report" onsubmit="return listQuestionnaire( this );">
		<!--[if !IE]>start fieldset<![endif]-->
                <fieldset>
		    
                    <!--[if !IE]>start forms<![endif]-->
                    <div class="forms">

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Título', 670 ); ?>:
				</label>
				<div class="inputs">
				    <span class="input_wrapper large_input">
					<select class="text" name="fk_id_questionnaire_config" id="fk_id_questionnaire_config" onChange="getQuestionnaire();">
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
				</label>
				<div class="inputs">
				    <span class="input_wrapper large_input">
					<input class="text" name="identifier" maxlength="200" id="identifier" type="text" />
				    </span>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

				<!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Distrito', 96 ); ?>:
				</label>
				<div class="inputs">
				    <ul>
					<li>
					    <span class="input_wrapper">
						<select class="text" name="fk_id_add_district" id="fk_id_add_district"
							onChange="carregaCombo( '/relatorio/me/subdistritos/id/' + this.value, 'fk_id_add_subdistrict' );" >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

						    <?php foreach ( $this->distritos as $distrito ) : ?>
							<option value="<?php echo $distrito->getIdAddDistrict(); ?>">
							    <?php echo $distrito->getDistrict(); ?>
							</option>
						    <?php endforeach; ?>
						</select>
					    </span>
					</li>
					<li>
					    <label>
						<?php echo $this->t( 'Sub-distrito', 98 ); ?>:
					    </label>
					</li>
					<li>
					    <span class="input_wrapper">
						<select class="text" name="fk_id_add_subdistrict" id="fk_id_add_subdistrict"
							onChange="carregaCombo( '/relatorio/me/sukus/id/' + this.value, 'fk_id_suku' );" disabled >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

						</select>
					    </span>
					</li>
				    </ul>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Suku', 100 ); ?>:
				</label>
				<div class="inputs">
				    <ul>
					<li>
					    <span class="input_wrapper">
						<select class="text" name="fk_id_suku" id="fk_id_suku" disabled >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
						</select>
					    </span>
					</li>
				    </ul>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Road location', 626 ); ?>:
				</label>
				<div class="inputs">
				    <ul>
					<li>
					    <span class="input_wrapper">
						<input class="text" name="road_location" maxlength="200" id="road_location" type="text" />
					    </span>
					</li>
					<li>
					    <label>
						<?php echo $this->t( 'Code', 628 ); ?>:
					    </label>
					</li>
					<li>
					    <span class="input_wrapper">
						<input class="text" name="code" id="code" maxlength="50" type="text" />
					    </span>
					</li>
				    </ul>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->
			    
			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<div class="inputs input-button">
				    <span class="button gray_button">
					<span><span><?php echo $this->t( 'Gerar Relatório', 362 ); ?></span></span>
					<input name="relatorio" class="btn-report" type="button" />
				    </span>
				    <span class="button green_button">
					<span><span><?php echo $this->t( 'Limpar', 16 ); ?></span></span>
					<input name="operacao" type="reset" />
				    </span>
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
				    <span class="button blue_button">
					<span><span><?php echo $this->t( 'Buscar', 141 ); ?></span></span>
					<input name="operacao" type="submit" />
				    </span>
				    <span class="button green_button">
					<span><span><?php echo $this->t( 'Limpar', 16 ); ?></span></span>
					<input name="operacao" type="reset" />
				    </span>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->
			    
			    <div class="row">
				<div id="gridQuestionnaire" class="gridTela"></div>
				<div id="divPagQuestionnaire" class="pagingBlock"></div>
			    </div>

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
    $( window ).load(
	function()
	{
	    initGridQuestionnaire();
	}
    )
</script>