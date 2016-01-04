<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/treinamento/savepracticaltraining/" method="post" id="form-treinamento-practicaltraining"
	  class="search_form general_form" onsubmit="return savePracticaltraining( this );">
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
			<div id="gridParticipantesPracticalTraining" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagParticipantesPracticalTraining" class="pagingBlock"></div>
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
		    <div class="row practical-training-container" style="margin-top: 30px;">
			<div>
			    <label>
				<?php echo $this->t( 'I - Road Construction', 514 ); ?>
			    </label>
			</div>
			<div>
			    <label>
				<?php echo $this->t( 'II - Discipline + Activeness', 515 ); ?>
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
		     <div class="row practical-training-container" style="margin-bottom: 30px">
			<div>
			    <span class="input_wrapper short_input">
				<input class="text required tip-error float" value="0" name="road_construction" msgError="<?php echo $this->t( 'Preencha o Road Construction', 517 ); ?>" maxlength="4" id="road_construction" type="text" />
			    </span>
			    <input type="checkbox" class="optional-check" name="optional[road_construction]" id="option-road_construction" value="1" >
			    <span class="tip-form" title="<?php echo $this->t( 'Opcional', 711 ); ?>"></span>
			</div>
			<div>
			    <span class="input_wrapper short_input">
				<input class="text required tip-error float" value="0" name="discipline" msgError="<?php echo $this->t( 'Discipline + Activeness', 518 ); ?>" maxlength="4" id="discipline" type="text" />
			    </span>
			    <input type="checkbox" class="optional-check" name="optional[discipline]" id="option-discipline" value="1" >
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
    			    <input name="operacao" type="button" id="avancar-practicaltraining" />
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
	    $( '#form-treinamento-practicaltraining' ).populate( <?php echo $this->data; ?> );
	    
	    initGridParticipantesPracticalTraining();
	    gridParticipantesPracticalTraining.parse( <?php echo $this->participantes; ?>, 'json' );
	    
	    $( '#road_construction, #discipline' ).change( calcFinalScorePracticalTraining );
	}
    )
</script>