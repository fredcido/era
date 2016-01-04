<div class="modules">
    <div class="module">
	<div class="module_top">
	    <h5>
		<span>1</span>
		 - <?php echo $this->t( 'Pergunta opção', 675 ); ?>
	    </h5>
	    <a href="javascript:;" onclick="removeQuestion( this )" class="edit_module remove_module">
		<?php echo $this->t( 'Remove', 214 ); ?>
	    </a>
	    <a href="javascript:;" onclick="upModule( this )" class="edit_module up_module">
		X
	    </a>
	    <a href="javascript:;" onclick="downModule( this )" class="edit_module down_module">
		X
	    </a>
	</div>
	<div class="module_bottom">
	    <div class="row">
		<input type="hidden" name="question_option[order_question][]" class="order" value="<?php echo @$this->data['order_question']; ?>"/>
		<input type="hidden" name="question_option[id][]" value="<?php echo @$this->data['id_option_question']; ?>" />
		<label>
		    <?php echo $this->t( 'Título', 670 ); ?>:
		    <span>*</span>
		</label>
		<div class="inputs">
		    <div class="inputs">
			<span class="input_wrapper" style="width: 100%">
			    <textarea name="question_option[title][]" msgError="<?php echo $this->t( 'Preencha o título', 672 ); ?>" 
				      rows="2" cols="70" class="text required tip-error" 
				      maxlength="200"><?php echo @$this->data['title']; ?></textarea>
			</span>
		    </div>
		</div>
	    </div>
	    <div class="row">
		<label>
		    <?php echo $this->t( 'Obrigatório', 676 ); ?>:
		    <span>*</span>
		</label>
		<div class="inputs">
		    <ul>
			<li>
			    <span class="input_wrapper short_input">
				<select class="text required tip-error" name="question_option[required][]">
				    <option value="1" <?php echo !empty( $this->data ) && $this->data['required'] == 1 ? 'selected' : ''; ?>><?php echo $this->t( 'Sim', 86 ); ?></option>
				    <option value="0" <?php echo !empty( $this->data ) && $this->data['required'] == 0 ? 'selected' : ''; ?>><?php echo $this->t( 'Não', 87 ); ?></option>
				</select>
			    </span>
			</li>
			<li>
			    <label>
				<?php echo $this->t( 'Múltiplo', 678 ); ?>:
				<span>*</span>
			    </label>
			</li>
			<li>
			    <span class="input_wrapper short_input">
				<select class="text required tip-error handle-multiples" onchange="handleMultiples( this )" name="question_option[multiple][]">
				    <option value="0" <?php echo !empty( $this->data ) && $this->data['multiple'] == 0 ? 'selected' : ''; ?>><?php echo $this->t( 'Não', 87 ); ?></option>
				    <option value="1" <?php echo !empty( $this->data ) && $this->data['multiple'] == 1 ? 'selected' : ''; ?>><?php echo $this->t( 'Sim', 86 ); ?></option>
				</select>
			    </span>
			</li>
			<li>
			    <label>
				<?php echo $this->t( 'Quantidade', 413 ); ?>:
				<span>*</span>
			    </label>
			</li>
			<li>
			    <span class="input_wrapper medium_input">
				<input class="text text-numeric4 choices" readonly 
				       name="question_option[choices][]" value="<?php echo empty( $this->data['choices'] ) ? '1' : $this->data['choices']; ?>" type="text" />
			    </span>
			</li>
		    </ul>
		</div>
	    </div>
	    <div class="row">
		<div class="table_wrapper">
		    <div class="table_wrapper_inner">
			<table width="100%" cellspacing="0" cellpadding="0" class="table-option">
			    <thead>
				<tr>
				    <th><?php echo $this->t( 'Label', 677 ); ?></th>
				    <th>
					    <span class="button blue_button">
					    <span>
						<span>
						    ADD
						</span>
					    </span>
					    <input name="operacao" onClick="addOption( this );" type="button" />
					</span>
				    </th>
				</tr>
			    </thead>
			    <tbody>
			    </tbody>
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>