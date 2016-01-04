<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/treinamento/saveassessment/" method="post" id="form-treinamento-assessment"
	  class="search_form general_form" onsubmit="return saveAssessment( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>
	    
	    <input name="fk_id_course" id="fk_id_course" type="hidden" />
	    <input name="fk_id_client" id="fk_id_client" type="hidden" />
	    <input name="id_student_class" id="id_student_class" type="hidden" />
	    <input name="unit_competency" id="unit_competency" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Participantes turma', 212 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div id="gridParticipantesAssessment" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagParticipantesAssessment" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Participante escolhido', 430 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span id="name-participant"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Curso', 219 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper large_input">
					<input class="text" name="course" type="text" readOnly id="course" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Curso', 219 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row assessment-container" style="margin-top: 30px;">
			<div>
			    <label>
				<?php echo $this->t( 'Klasse Laran', 426 ); ?>
			    </label>
			</div>
			<div>
			    <label>
				<?php echo $this->t( 'Pratika ika kampu', 427 ); ?>
			    </label>
			</div>
			<div>
			    <label>
				<?php echo $this->t( 'Resultadu', 428 ); ?>
			    </label>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		     <div class="row assessment-container" style="margin-bottom: 30px">
			<div>
			    <span class="input_wrapper">
				<select class="text required tip-error" msgError="<?php echo $this->t( 'Selecione algum valor', 429 ); ?>" 
					name="assessment[ass_k]" id="assessment_ass_k">
				    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
				    <option value="A">A</option>
				    <option value="B">B</option>
				    <option value="C">C</option>
				    <option value="D">D</option>
				    <option value="E">E</option>
				</select>
			    </span>
			</div>
			<div>
			    <span class="input_wrapper">
				<select class="text required tip-error" msgError="<?php echo $this->t( 'Selecione algum valor', 429 ); ?>"
					name="assessment[ass_p]" id="assessment_ass_p">
				    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
				    <option value="A">A</option>
				    <option value="B">B</option>
				    <option value="C">C</option>
				    <option value="D">D</option>
				    <option value="E">E</option>
				</select>
			    </span>
			</div>
			<div>
			    <span class="input_wrapper">
				<select class="text required tip-error" msgError="<?php echo $this->t( 'Selecione algum valor', 429 ); ?>"
					name="assessment[ass_r]" id="assessment_ass_r">
				    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
				    <option value="A">A</option>
				    <option value="B">B</option>
				    <option value="C">C</option>
				    <option value="D">D</option>
				    <option value="E">E</option>
				</select>
			    </span>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			
			<span class="button blue_button">
    			    <span><span><?php echo $this->t( 'Avançar', 213 ); ?></span></span>
    			    <input name="operacao" type="button" id="avancar-assessment" />
    			</span>
			
			<?php if ( empty( $this->finalizada ) && ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
			    <span class="button green_button">
				<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
				<input name="operacao" type="submit" />
			    </span>
			<?php endif; ?>
			
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		</div>
	    </div>
	    <!--[if !IE]>end forms<![endif]-->

	</fieldset>
	<!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    $( '#form-treinamento-assessment' ).populate( <?php echo $this->data; ?> );
	    
	    initGridParticipantesAssessment();
	    gridParticipantesAssessment.parse( <?php echo $this->participantes; ?>, 'json' );
	}
    )
</script>