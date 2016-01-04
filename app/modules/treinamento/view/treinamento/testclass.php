<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/treinamento/savetestclass/" method="post" id="form-treinamento-testclass"
	  class="search_form general_form" onsubmit="return saveTestclass( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>
	    
	    <input name="fk_id_client" id="fk_id_client" type="hidden" />
	    <input name="id_student_class" id="id_student_class" type="hidden" />

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
			<div id="gridParticipantesTestClass" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagParticipantesTestClass" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Partisipante ita hili tiha ona', 212 ); ?>:
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
		    <div class="row testclass-container" style="margin-top: 30px;">
			<div>
			    <label>
				<?php echo $this->t( 'I - Pre-Test', 522 ); ?>
			    </label>
			</div>
			<div>
			    <label>
				<?php echo $this->t( 'II - Final Test', 523 ); ?>
			    </label>
			</div>
			<div>
			    <label>
				<?php echo $this->t( 'III - Understanding', 524 ); ?>
			    </label>
			</div>
			<div>
			    <label>
				<?php echo $this->t( 'Final Score', 516 ); ?>
			    </label>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		     <div class="row testclass-container" style="margin-bottom: 30px">
			<div>
			    <span class="input_wrapper short_input">
				<input class="text required tip-error float" value="0" name="pre_test" msgError="<?php echo $this->t( 'Preencha o Pre-teste', 525 ); ?>" maxlength="4" id="pre_test" type="text" />
			    </span>
			</div>
			<div>
			    <span class="input_wrapper short_input">
				<input class="text required tip-error float" value="0" name="final_test" msgError="<?php echo $this->t( 'Preencha o Final teste', 526 ); ?>" maxlength="4" id="final_test" type="text" />
			    </span>
			</div>
			<div>
			    <span class="input_wrapper short_input">
				<input class="text required tip-error float" value="0" name="understanding" msgError="<?php echo $this->t( 'Preencha o Understanding', 527 ); ?>" maxlength="4" id="understanding" type="text" />
			    </span>
			    <input type="checkbox" class="optional-check" name="optional[understanding]" id="option-understanding" value="1" >
			    <span class="tip-form" title="<?php echo $this->t( 'Opcional', 711 ); ?>"></span>
			</div>
			<div>
			    <span class="input_wrapper short_input">
				<input class="text required tip-error" value="0" name="final_score" readonly id="final_score" type="text" />
			    </span>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			
			<span class="button blue_button">
    			    <span><span><?php echo $this->t( 'Avançar', 213 ); ?></span></span>
    			    <input name="operacao" type="button" id="avancar-testclass" />
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
	    $( '#form-treinamento-testclass' ).populate( <?php echo $this->data; ?> );
	    
	    initGridParticipantesTestClass();
	    gridParticipantesTestClass.parse( <?php echo $this->participantes; ?>, 'json' );
	    
	    $( '#final_test, #understanding' ).change( calcFinalScoreTestClass );
	}
    )
</script>