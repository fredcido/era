<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/me/snapshot/savesocio/" method="post"  id="form-snapshot-socio"
	  class="search_form general_form" onsubmit="return saveSocio( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_snapshot" id="id_snapshot" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

		    <div class="row">
			<h3>Education</h3>
		    </div>
		    
		     <div class="row large-labels">
			<label>
			    % Primary Enrollments
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<select class="text required tip-error" name="key[primary_enrollments]"
					id="key_primary_enrollments"
					msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
				    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
				    <option value="60-100">60-100</option>
				    <option value="40-59.9">40-59.9</option>
				    <option value="0-39.9">0-39.9</option>
				</select>
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % Completed SD
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[enrolled_sd]" id="key_enrolled_sd" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % completed SMP
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[completed_smp]" id="key_completed_smp" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % completed SMA
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[completed_sma]" id="key_completed_sma" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row">
			<h3>Economic Activity</h3>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % population between 15 and 59.
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[population_15_59]" id="key_population_15_59" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <tbody>
					<tr>
					    <td rowspan="3">
						Employment <br /> (aged 15 to 59)
					    </td>
					    <th>
						% Employed
					    </th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error  float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[emp_employed]" id="key_emp_employed" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>
						% Unemployed
					    </th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error  float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[emp_unemployed]" id="key_emp_unemployed" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>
						% Inactive
					    </th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error  float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[emp_inactive]" id="key_emp_inactive" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % HHs who raise animals
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error  float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[hh_animals]" id="key_hh_animals" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % HHs with agricultural production
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error  float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[hh_agricultural]" id="key_hh_agricultural" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <td></td>
					    <th>Name of Crop</th>
					    <th>%HH</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <th>#1 cultivation</th>
					    <th>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error " msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[crop_name_cult_1]" id="key_crop_name_cult_1" maxlength="50" type="text" />
						</span>
					    </th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error  float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[crop_value_cult_1]" id="key_value_cult_1" maxlength="50" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>#2 cultivation</th>
					    <th>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error " msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[crop_name_cult_2]" id="key_crop_name_cult_2" maxlength="50" type="text" />
						</span>
					    </th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error  float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[crop_value_cult_2]" id="key_value_cult_2" maxlength="50" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>#3 cultivation</th>
					    <th>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error " msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[crop_name_cult_3]" id="key_crop_name_cult_3" maxlength="50" type="text" />
						</span>
					    </th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error  float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[crop_value_cult_3]" id="crop_value_cult_3" maxlength="50" type="text" />
						</span>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			<h3>Wealth/Quality of Life</h3>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % HHs with cattle or buffalo
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[hh_cattle_buffalo]" id="key_hh_cattle_buffalo" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % HHs with cattle or buffalo (Timor)
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[hh_cattle_buffalo_timor]" id="key_hh_cattle_buffalo_timor" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % Houses with brick/cement walls
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<select class="text tip-error" name="key[house_brick_walls]" id="key_house_brick_walls"
					msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
				    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
				    <option value="60-100">60-100</option>
				    <option value="40-59.9">40-59.9</option>
				    <option value="0-39.9">0-39.9</option>
				</select>
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % Houses with cement or tiled floor
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<select class="text tip-error" name="key[house_cement_floor]" id="key_house_cement_floor"
					msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
				    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
				    <option value="60-100">60-100</option>
				    <option value="40-59.9">40-59.9</option>
				    <option value="0-39.9">0-39.9</option>
				</select>
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % improved sanitation
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<select class="text tip-error" name="key[improved_sanitation]" id="key_improved_sanitation"
					msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
				    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
				    <option value="60-100">60-100</option>
				    <option value="40-59.9">40-59.9</option>
				    <option value="0-39.9">0-39.9</option>
				</select>
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % improved drinking water
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<select class="text tip-error" name="key[improved_water]" id="key_improved_water"
					msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
				    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
				    <option value="60-100">60-100</option>
				    <option value="40-59.9">40-59.9</option>
				    <option value="0-39.9">0-39.9</option>
				</select>
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % births assisted by a qualified midwife/dr/nurse
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<select class="text  tip-error" name="key[births_assisted]" id="key_births_assisted"
					msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
				    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
				    <option value="60-100">60-100</option>
				    <option value="40-59.9">40-59.9</option>
				    <option value="0-39.9">0-39.9</option>
				</select>
			    </span>
			</div>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th>Transport</th>
					    <th>% census report</th>
					    <th># suco information</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <th>car/truck/ Angguna & Microlet</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[trans_cens_car]" id="key_trans_cens_car" maxlength="5" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[trans_suco_car]" id="key_trans_suco_car" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>motor bike</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[trans_cens_motor]" id="key_trans_cens_motor" maxlength="5" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[trans_suco_motor]" id="key_trans_suco_motor" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>bicyle</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[trans_cens_bicyle]" id="key_trans_cens_bicyle" maxlength="5" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[trans_suco_bicyle]" id="key_trans_suco_bicyle" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			<h3>Communication</h3>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % mobile telephone
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[comm_mobile_telephone]" id="key_comm_mobile_telephone" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row large-labels">
			<label>
			    % television
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[comm_television]" id="key_comm_television" />
			    </span>
			</div>
		    </div>
		    
		     <div class="row large-labels">
			<label>
			    % radio
			</label>
			<div class="inputs">										
			    <span class="input_wrapper medium_input">
				<input type="text" class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
				       name="key[comm_radio]" id="key_comm_radio" />
			    </span>
			</div>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th>Type of Enterprise</th>
					    <th>Suko information # enterprises</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <th>Kiosk</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[enterprise_kiosk]" id="key_enterprise_kiosk" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>Roadside stall (petrol,fuit etc.)</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[enterprise_roadsite_stall]" id="key_enterprise_roadsite_stall" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>Buy/sell products (small trading)</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[enterprise_small_tradings]" id="key_enterprise_small_tradings" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>Produce and sell (agricultural, kripik, local produce)</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[enterprise_agricultural]" id="key_enterprise_agricultural" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
                                        <tr>
					    <th>Small factory (eg: chicken, coffee, coconut oil)</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[small_factory]" id="key_small_factory" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>Construction Contractor</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[enterprise_construction]" id="key_enterprise_construction" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>Transport services (motor taxi, angguna)</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[enterprise_transport]" id="key_enterprise_transport" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>Other</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[enterprise_other]" id="key_enterprise_other" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			<label>
			    Further Comments/Notes:
			</label>
			<div class="inputs">										
			    <span class="input_wrapper textarea_wrapper">
				<textarea rows="3" cols="40" class="text" name="key[comments_socio]" id="key_comments_socio"></textarea>
			    </span>
			</div>
		    </div>
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<?php if ( ILO_Auth_Permissao::has( '/me/snapshot/', 'salvar' ) ) : ?>
			    <span class="button blue_button">
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
    
    var dataForm = <?php echo $this->data; ?>;

    $( document ).ready(
	function()
	{
	    $( '#form-snapshot-socio' ).populate( dataForm  );
	}
    );
</script>