<?php foreach ( $this->questions as $key =>  $question ) : ?>
    <div class="modules">
	<div class="module">
	    <div class="module_top">
		<h5>
		    <span><?php echo $key; ?></span>
		    - <?php echo $question['data']['title']; ?>
		    
		    <?php if ( !empty( $question['data']['required'] ) ) : ?>
			<span>*</span>
		    <?php endif; ?>
			
		    <?php if ( !empty( $question['data']['multiple'] ) && $question['data']['choices'] > 1 ) : ?>
			<em>Max. <?php echo $question['data']['choices']; ?></em>
		    <?php endif; ?>
			    
		    <?php if ( !empty( $question['data']['class'] ) ) : ?>
			<em>(Tipu: <?php echo implode( ' ', array_map('ucfirst', explode('_', $question['data']['class']))); ?>)</em>
		    <?php endif; ?>
		</h5>
	    </div>
	    <div class="module_bottom">
		<div class="inputs">
			<span class="input_wrapper large_input">
			    <?php if ( $question['type'] == 'T' ) : ?>

				<?php if ( 'text' == $question['data']['class'] ) :?>
			    
				    <textarea msgError="<?php echo $this->t( 'Preencha esse campo', 648 ); ?>"
					    name="question[text][<?php echo $question['data']['id_text_question']; ?>]" 
					    rows="2" cols="80"
					    class="text <?php echo !empty( $question['data']['required'] ) ? 'required' : ''; ?> tip-error" 
					><?php echo @$this->answer['text'][$question['data']['id_text_question']]; ?></textarea>
			    
				<?php else : ?>
			    
				    <input type="text" msgError="<?php echo $this->t( 'Preencha esse campo', 648 ); ?>"
					    name="question[text][<?php echo $question['data']['id_text_question']; ?>]"
					    class="text <?php echo !empty( $question['data']['required'] ) ? 'required' : ''; ?> 
						mask_<?php echo $question['data']['class']; ?> tip-error"
						value="<?php echo @$this->answer['text'][$question['data']['id_text_question']]; ?>">
				    
				<?php endif; ?>
				    
			    <?php 
				else :
				    $idQuestion = $question['data']['id_option_question'];
			    ?>
			    
				<?php if ( !empty( $question['data']['multiple'] ) && $question['data']['choices'] > 1 ) : ?>
			    
				
					<div class="list-option <?php echo !empty( $question['data']['required'] ) ? 'is-required' : ''; ?>"
					     data-max="<?php echo $question['data']['choices']; ?>">
					    <?php
						foreach ( $question['options'] as $id => $label ) : 
					    ?>
						<div>
						    <label>
							<input <?php echo !empty( $this->answer['option'][$idQuestion] ) && in_array( $id, $this->answer['option'][$idQuestion] ) ? 'checked' : ''; ?>
							    type="checkbox" name="question[option][<?php echo $question['data']['id_option_question']; ?>][]"
							    value="<?php echo $id; ?>" />
							<?php echo $label; ?>
						    </label>
						</div>
					    <?php endforeach; ?>
					</div>
				
				<?php else : ?>
			    
				    <select class="text <?php echo !empty( $question['data']['required'] ) ? 'required' : ''; ?> tip-error" 
					    name="question[option][<?php echo $question['data']['id_option_question']; ?>]"
					    msgError="<?php echo $this->t( 'Preencha esse campo', 648 ); ?>" >
					<option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

					<?php foreach ( $question['options'] as $id => $label ) : ?>
					    <option value="<?php echo $id; ?>"
						     <?php echo !empty( $this->answer['option'][$idQuestion] ) && in_array( $id, $this->answer['option'][$idQuestion] ) ? 'selected' : ''; ?>>
						<?php echo $label; ?>
					    </option>
					<?php endforeach; ?>
				    </select>
			    
				<?php endif; ?>
			    
			    <?php endif; ?>
			</span>
		</div>
	    </div>
	</div>
    </div>

<?php endforeach; ?>
