<?php foreach ( $this->options as $option ) : ?>
    <tr>
	<td>
	    <input type="hidden" name="options[<?php echo $this->row['order_question']; ?>][id_options_question][]" value="<?php echo $option->getIdOptionsQuestion(); ?>" />
	    <span class="input_wrapper large_input">
		<input class="text required tip-error" value="<?php echo $option->getTitle(); ?>" name="options[<?php echo $this->row['order_question']; ?>][title][]"
		    type="text" msgError="<?php echo $this->t( 'Preencha esse campo', 648 ); ?>" />
	    </span>
	</td>
	<th>
		<span class="button green_button">
		<span>
		    <span>
			REMOVE
		    </span>
		</span>
		<input name="button" onClick="removeOption( this );" type="button" />
	    </span>
	</th>
    </tr>
<?php endforeach; ?>