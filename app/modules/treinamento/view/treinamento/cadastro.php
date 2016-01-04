<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/treinamento/savegeral/" method="post"  id="form-treinamento-geral"
	  class="search_form general_form" onsubmit="return saveGeral( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_student_class" id="id_student_class" type="hidden" />
	    <input name="address[fk_id_add_country]" id="address_fk_id_add_country" type="hidden" value="1" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Nome turma', 172 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error" name="class_name" maxlength="100" type="text"
					       msgError="<?php echo $this->t( 'Preencha o nome da turma', 173 ); ?>" id="class_name" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Nome turma', 172 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Ano', 162 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text required" name="num_year" id="num_year">
					    <?php for( $i = 2009; $i <= 2020; $i++ ) : ?>
					    <option value="<?php echo substr( $i, -2 ); ?>" <?php if( $i == date('Y') )  echo 'selected'; ?>><?php echo $i;?></option>
					    <?php endfor; ?>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Ano', 162 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Data inicial', 174 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error date-mask" name="start_date" 
					       msgError="<?php echo $this->t( 'Preencha a data inicial', 175 ); ?>" id="start_date" maxlength="10" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Data inicial da turma', 176 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Data final', 177 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error date-mask" name="finish_date" 
					       msgError="<?php echo $this->t( 'Preencha a data final', 178 ); ?>" maxlength="10" id="finish_date" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Data final da turma', 179 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Homens', 180 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text required tip-error text-numeric" name="man_student" maxlength="5" type="text" value="0"
					       msgError="<?php echo $this->t( 'Preencha a quantidade de participantes homens', 181 ); ?>" id="man_student"  />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Quantidade de participantes homens', 182 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Mulheres', 183 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text required tip-error text-numeric" name="woman_student" value="0" id="woman_student" type="text"
					       msgError="<?php echo $this->t( 'Preencha a quantidade de participantes mulheres', 184 ); ?>" maxlength="5"  />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Quantidade de participantes mulheres', 185 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Total', 186 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text" name="total_student" readonly id="total_student" value="0" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Total de participantes', 187 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
                    
                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
			    <?php echo $this->t( 'Loron iha Klasse', 0 ); ?>:
			</label>
                        <div class="inputs">
                            <ul>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text required tip-error text-numeric" name="class_days" id="class_days" maxlength="5" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Loron hira ba klasse deit', 0 ); ?>"></span>
				</li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Loron Field', 0 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text required tip-error text-numeric" name="field_days" id="field_days" maxlength="5" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Loron hira ba klasse deit', 0 ); ?>"></span>
				</li>
                                <li>
				    <label>
					<?php echo $this->t( 'Loron total turma', 0 ); ?>:
					<span>*</span>
				    </label>
				</li>
                                <li>
				    <span class="input_wrapper medium_input">
                                        <input class="text" readonly name="duration_time" maxlength="5" id="duration_time"
					       msgError="<?php echo $this->t( 'Preencha o tempo de duração do curso', 193 ); ?>"  type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Tempo de duração do curso', 194 ); ?>"></span>
				</li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
                        
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Horário inicial', 188 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text time-mask" name="start_time" id="start_time" maxlength="5" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Horário inicial da turma', 189 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Horário final', 190 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text time-mask" name="finish_time" maxlength="5" id="finish_time" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Horário final da turma', 191 ); ?>"></span>
				</li>
				
				
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Valor Pagamento', 195 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text money" name="payment_value" type="text" id="payment_value" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Valor de pagamento do curso', 196 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Descrição do pagamento', 197 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper large_input">
					<input class="text" name="payment_description" maxlength="500" id="payment_description" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Descrição do pagamento', 197 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Custo treinamento', 198 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text money" name="training_cost" type="text" id="training_cost" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Custo de treinamento', 198 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Distrito da turma', 431 ); ?>:
					 <span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_add_district"
						msgError="<?php echo $this->t( 'Selecione o CDE Responsável', 200 ); ?>" id="fk_id_add_district">
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

					    <?php foreach ( $this->districts as $district ) : ?>
						<option value="<?php echo $district->getIdAddDistrict(); ?>">
						    <?php echo $district->getDistrict(); ?>
						</option>      
					    <?php endforeach; ?>

					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'CDE Responsável', 199 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Descrição turma', 205 ); ?>:
			</label>
			<div class="inputs">										
			    <span class="input_wrapper textarea_wrapper">
				<textarea rows="3" cols="40" class="text" name="class_description" id="class_description"></textarea>
			    </span>
			    <span class="tip-form" title="<?php echo $this->t( 'Descrição da turma', 205 ); ?>"></span>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    
		    <?php if ( empty( $this->altera) ) : ?>
		    
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'ID Treinamento', 436 ); ?>:
			    </label>
			    <div class="inputs">
				<ul>
				    <li>
					<span class="input_wrapper large_input">
					    <select class="text required tip-error" name="fk_id_course" id="fk_id_course"  msgError="<?php echo $this->t( 'Selecione o curso da turma', 434 ); ?>">
						<option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
						<?php foreach ( $this->courses as $acronym => $course ) : ?>
						    <option value="<?php echo $acronym; ?>">
							<?php echo $course; ?>
						    </option>
						<?php endforeach; ?>
					    </select>
					</span>
					-
				    </li>
				    <li>
					<span class="input_wrapper medium_input" style="height: 20px; width: 25px !important">
					    <input class="text required tip-error" readonly name="num_year_short" type="text" value="<?php echo substr( date('Y'), -2 ); ?>" id="num_year_short" />
					</span>
					-
				    </li>
				    <li>
					<span class="input_wrapper medium_input">
					    <select class="text  required tip-error" name="num_title" id="num_title" msgError="<?php echo $this->t( 'Selecione o tipo da turma', 435 ); ?>" >
						<option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
						<option value="E">E</option>
						<option value="S">S</option>
						<option value="D">D</option>
						<option value="T">T</option>
					    </select>
					</span>
				    </li>
				</ul>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
		    
		    <?php endif; ?>
		    

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
    $( document ).ready(
	function()
	{
	    $( '#form-treinamento-geral' ).populate( dataForm );

	    if ( !empty( $( '#id_student_class').val() ) ) {

		$( '#num_year' ).attr( 'disabled', true );
		$( '#fk_id_add_district' ).attr( 'disabled', true );
	    }
	}
    );
</script>