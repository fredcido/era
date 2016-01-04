<tr>
    <td>
	<input type="hidden" class="option-item" name="options[<?php echo $this->order; ?>][id_options_question][]" />
	<span class="input_wrapper large_input">
	    <input class="text required tip-error option-item" name="options[<?php echo $this->order; ?>][title][]"
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