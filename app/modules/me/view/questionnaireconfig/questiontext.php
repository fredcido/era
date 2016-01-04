<div class="modules">
    <div class="module">
	<div class="module_top">
	    <h5>
		<span>1</span>
		 - <?php echo $this->t( 'Pergunta texto', 674 ); ?>
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
		<input type="hidden" name="question_text[id][]" value="<?php echo @$this->data['id_text_question']; ?>" />
		<input type="hidden" name="question_text[order_question][]" class="order" value="<?php echo @$this->data['order_question']; ?>" />
		    <label>
			<?php echo $this->t( 'Título', 670 ); ?>:
			<span>*</span>
		    </label>
		<div class="inputs">
		    <div class="inputs">
			<span class="input_wrapper" style="width: 100%">
			    <textarea msgError="<?php echo $this->t( 'Preencha o título', 672 ); ?>" 
				      name="question_text[title][]" rows="2" cols="70" class="text required tip-error" 
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
				<select class="text required tip-error" name="question_text[required][]" name="required">
				    <option value="1" <?php echo !empty( $this->data ) && $this->data['required'] == 1 ? 'selected' : ''; ?>><?php echo $this->t( 'Sim', 86 ); ?></option>
				    <option value="0" <?php echo !empty( $this->data ) && $this->data['required'] == 0 ? 'selected' : ''; ?>><?php echo $this->t( 'Não', 87 ); ?></option>
				</select>
			    </span>
			</li>
			<li>
			     <label>
				<?php echo $this->t( 'Tipo', 712 ); ?>:
				<span>*</span>
			    </label>
			</li>
			<li>
			    <span class="input_wrapper">
				<select class="text required tip-error" name="question_text[class][]" name="required">
				    <option value="text" <?php echo !empty( $this->data ) && $this->data['class'] == 'text' ? 'selected' : ''; ?>><?php echo $this->t( 'Texto', 713 ); ?></option>
				    <option value="date" <?php echo !empty( $this->data ) && $this->data['class'] == 'date' ? 'selected' : ''; ?>><?php echo $this->t( 'Data', 714 ); ?></option>
				    <option value="hour" <?php echo !empty( $this->data ) && $this->data['class'] == 'hour' ? 'selected' : ''; ?>><?php echo $this->t( 'Hora', 717 ); ?></option>
				    <option value="date_hour" <?php echo !empty( $this->data ) && $this->data['class'] == 'date_hour' ? 'selected' : ''; ?>><?php echo $this->t( 'Data/Hora', 718 ); ?></option>
				    <option value="numeric" <?php echo !empty( $this->data ) && $this->data['class'] == 'numeric' ? 'selected' : ''; ?>><?php echo $this->t( 'Numérico', 715 ); ?></option>
				    <option value="money" <?php echo !empty( $this->data ) && $this->data['class'] == 'money' ? 'selected' : ''; ?>><?php echo $this->t( 'Monetário', 716 ); ?></option>
				</select>
			    </span>
			</li>
			<li>
			     <label>
				<?php echo $this->t( 'Visualiza relatorio?', 719 ); ?>:
				<span>*</span>
			    </label>
			</li>
			<li>
			    <span class="input_wrapper">
				<select class="text required tip-error" name="question_text[report][]" name="required">
				    <option value="N" <?php echo !empty( $this->data ) && $this->data['report'] == 'N' ? 'selected' : ''; ?>><?php echo $this->t( 'Não', 87 ); ?></option>
				    <option value="A" <?php echo !empty( $this->data ) && $this->data['report'] == 'A' ? 'selected' : ''; ?>><?php echo $this->t( 'Average', 720 ); ?></option>
				    <option value="S" <?php echo !empty( $this->data ) && $this->data['report'] == 'S' ? 'selected' : ''; ?>><?php echo $this->t( 'Sum', 721 ); ?></option>
				    <option value="B" <?php echo !empty( $this->data ) && $this->data['report'] == 'B' ? 'selected' : ''; ?>><?php echo $this->t( 'Average/Sum', 722 ); ?></option>
				</select>
			    </span>
			</li>
		</div>
	    </div>
	</div>
    </div>
</div>