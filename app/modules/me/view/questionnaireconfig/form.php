<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/me/questionnaireconfig.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/me/questionnaireconfig.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
        <span class="title_wrapper_middle"></span>
        <div class="title_wrapper_content">
            <h2>
                <?php echo $this->t( 'Questionnaires Config', 668 ); ?> 
            </h2>
	    
	    <?php 
		echo $this->_helper->aba()
			  ->addButton(
			      array(
				  'class'	=> 'section_back',
				  'url'		=> BASE . '/me/questionnaireconfig/',
				  'label'	=> 'Listar dados',
				  'trans_id'	=> 9,
				  'role'	=> '/me/questionnaireconfig/',
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
            <form action="<?php echo BASE; ?>/me/questionnaireconfig/save/" method="post"  id="form-questionnaireconfig"
                  class="search_form general_form" onsubmit="return save( this );">
                <!--[if !IE]>start fieldset<![endif]-->
                <fieldset>

                    <input name="id_questionnaire_config" id="id_questionnaire_config" value="" type="hidden" />

                    <!--[if !IE]>start forms<![endif]-->
                    <div class="forms">

                        <!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <label>
                                <?php echo $this->t( 'Título', 670 ); ?>:
                                <span>*</span>
                            </label>
                            <div class="inputs">
                                <span class="input_wrapper large_input" style="width: 450px">
                                    <input class="text required tip-error" maxlength="200" name="title" id="title" msgError="<?php echo $this->t( 'Preencha o título', 672 ); ?>" type="text" />
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Título Questionnaire Config', 671 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->
			
			<div class="row">
			    <div class="modules">
				<div class="module">
				    <div class="module_top">
					<h5>&nbsp;&nbsp;<?php echo $this->t( 'Perguntas', 673 ); ?></h5>
					    <a href="javascript:;" onclick="addQuestionText()" class="edit_module add_module">
						<?php echo $this->t( 'Pergunta texto', 674 ); ?>
					    </a>
					    <a href="javascript:;" onclick="addQuestionOption();" class="edit_module add_module">
						<?php echo $this->t( 'Pergunta opção', 675 ); ?>&nbsp;&nbsp;
					    </a>
				    </div>
				    <div class="module_bottom" id="question-container">
				    </div>
				</div>
			    </div>
			</div>

                        <!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <div class="inputs input-button">
				<?php if ( ILO_Auth_Permissao::has( '/me/questionnaireconfig/', 'salvar' ) ) : ?>
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
	    <?php if ( !empty( $this->data ) ) : ?>
	
		$( '#form-questionnaireconfig' ).populate( <?php echo $this->data; ?> );
		loadQuestions();

	    <?php endif; ?>
	}
    );
</script>