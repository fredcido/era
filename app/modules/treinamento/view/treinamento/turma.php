<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/treinamento/saveturma/" method="post"  id="form-treinamento-turma"
	  class="search_form general_form" onsubmit="return saveTurma( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_student_class" id="id_student_class" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Curso', 219 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input type="hidden" name="fk_id_course" id="fk_id_course" value="<?php echo $this->course->getIdCourse(); ?>" >
					<b>
					    <?php 
						$acronym = $this->course->getAcronym();
						$label = sprintf('%s - %s', $acronym, $this->course->getCourse());
						if ( empty($acronym) )
						    $label = $this->course->getCourse();
						
						echo $label; 
					    ?>
					</b>
				    </span>
				<span class="tip-form" title="<?php echo $this->t( 'Curso', 219 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Treinador principal', 201 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_trainer_prin"
						msgError="<?php echo $this->t( 'Selecione o treinador principal', 202 ); ?>" id="fk_id_trainer_prin">
                                            <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					    
                                            <?php foreach ( $this->trainers as $trainer ) : ?>
						<option value="<?php echo $trainer->getIdTrainer(); ?>">
						    <?php echo $trainer->getNameTrainer(); ?>
						</option>      
					    <?php endforeach; ?>
						
                                        </select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Treinador principal', 201 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Competências', 221 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<ul id="unit-compentency" class="ul-container">
					</ul>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Unidades de compentência', 222 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Treinador assistente', 203 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<ul class="ul-container" id="trainers-sec">
					    <?php foreach ( $this->trainers as $trainer ) : ?>
						<li>
						    <label for="fk_id_trainer_sec_<?php echo $trainer->getIdTrainer(); ?>">
							<input type="checkbox" name="fk_id_trainer_sec[]" 
							       id="fk_id_trainer_sec_<?php echo $trainer->getIdTrainer(); ?>"
							       <?php echo in_array( $trainer->getIdTrainer(), $this->assistentes ) ? 'checked' : ''; ?>
							       value="<?php echo $trainer->getIdTrainer(); ?>" />
							<?php echo $trainer->getNameTrainer(); ?>
						    </label>
						</li>    
					    <?php endforeach; ?>
					</ul>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Treinador assistente', 203 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<?php if ( empty( $this->finalizada ) && ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
    			<span class="button blue_button">
    			    <span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
    			    <input name="operacao" type="submit" />
    			</span>
			<?php endif; ?>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

		</div>
	    </div>

	</fieldset>
	<!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    
    var dataForm = <?php echo $this->data; ?>;
    var units = <?php echo $this->units; ?>;
    
    $( document ).ready(
	function()
	{
	    $( '#form-treinamento-turma' ).populate( dataForm );
	    
	    if ( units.length )
			buscaUnidadesCompentencia( units );
	    else
			buscaUnidadesCompentencia();
	}
    );
</script>