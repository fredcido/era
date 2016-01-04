<?php foreach ( $this->questions as $key =>  $question ) : ?>
    <div class="modules">
	<div class="module">
	    <div class="module_top">
		<h5>
		    <span><?php echo $key; ?></span>
		    - <?php echo $question['data']['title']; ?>
		</h5>
	    </div>
	    <div class="module_bottom">
		<div class="inputs">
			<span class="input_wrapper large_input">
			    <?php if ( $question['type'] == 'T' ) : ?>
			    
				<?php if ( 'text' == $question['data']['class'] ) :?>

				    <textarea name="question[text][<?php echo $question['data']['id_text_question']; ?>]" 
					    rows="2" cols="80"
					    class="text"></textarea>
					
				<?php else : ?>
			    
					<input type="text"name="question[text][<?php echo $question['data']['id_text_question']; ?>]"
						class="text mask_<?php echo $question['data']['class']; ?> tip-error">
				    
				<?php endif; ?>

			    <?php else : ?>
			    
				<div class="list-option">
				    <?php
					foreach ( $question['options'] as $id => $label ) : 
				    ?>
					<div>
					    <label>
						<input type="checkbox" name="question[option][<?php echo $question['data']['id_option_question']; ?>][]"
						    value="<?php echo $id; ?>" />
						<?php echo $label; ?>
					    </label>
					</div>
				    <?php endforeach; ?>
				</div>
			    
			    <?php endif; ?>
			</span>
		</div>
	    </div>
	</div>
    </div>

<?php endforeach; ?>
