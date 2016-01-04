<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/me/snapshot/saveaccesseducation/" method="post"  id="form-snapshot-education"
	  class="search_form general_form" onsubmit="return saveEducation( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_snapshot" id="id_snapshot" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

		    <div class="row">
			<h3>2.2-2.8 Access do Education</h3>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th rowspan="2">Type of school</th>
					    <th rowspan="2">Location</th>
					    <th rowspan="2">Total # students</th>
					    <th rowspan="2"># boys</th>
					    <th rowspan="2"># girls</th>
					    <th colspan="2">One way travel time</th>
					    <th rowspan="2">Means of Transp.</th>
					    <th rowspan="2">Travel Cost</th>
					</tr>
					<tr>
					    <th>wet</th>
					    <th>dry</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <td>
						SD
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sd_location]" id="key_education_sd_location" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sd_total_students]" id="key_education_sd_total_students" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sd_total_boys]" id="key_education_sd_total_boys" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sd_total_girls]" id="key_education_sd_total_girls" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <select class="text required tip-error" name="key[education_sd_travel_wet]" id="key_education_sd_travel_wet">
							<option value="<1h"><1h</option>
							<option value="1-2h">1-2h</option>
							<option value=">2h">>2h</option>
						    </select>
						</span>
					    </td>
					    <td>
						<select name="key[education_sd_travel_dry]" id="key_education_sd_travel_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
						</select>
					    </td>
					    <td>
						Walk
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sd_travel_cost]" id="key_education_sd_travel_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td rowspan="3">
						SMP
					    </td>
					    <td rowspan="3">
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_smp_location]" id="key_education_smp_location" type="text" />
						</span>
					    </td>
					    <td rowspan="3">
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_smp_total_students]" id="key_education_smp_total_students" type="text" />
						</span>
					    </td>
					    <td rowspan="3">
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_smp_total_boys]" id="key_education_smp_total_boys" type="text" />
						</span>
					    </td>
					    <td rowspan="3">
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_smp_total_girls]" id="key_education_smp_total_girls" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <select class="text required tip-error" name="key[education_smp_walk_travel_wet]" id="key_education_smp_walk_travel_wet">
							<option value="<1h"><1h</option>
                                    			<option value="1-2h">1-2h</option>
							<option value=">2h">>2h-board</option>
						    </select>
						</span>
					    </td>
					    <td>
						<select name="key[education_smp_walk_travel_dry]" id="key_education_smp_walk_travel_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h-board</option>
						</select>
					    </td>
					    <td>
						Walk
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_smp_walk_travel_cost]" id="key_education_smp_walk_travel_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td>
						<span class="input_wrapper medium_input">
						    <select class="text required tip-error" name="key[education_smp_motor_travel_wet]" id="key_education_smp_motor_travel_wet">
							<option value="<1h"><1h</option>
							<option value="1-2h">1-2h</option>
							<option value=">2h">>2h</option>
                                                        <option value="n/a">>N/A</option>
						    </select>
						</span>
					    </td>
					    <td>
						<select name="key[education_smp_motor_travel_dry]" id="key_education_smp_motor_travel_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					    <td>
						Motor/bicyle
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_smp_motor_travel_cost]" id="key_education_smp_motor_travel_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td colspan="4">
						<dl>
						    <dd>
							<input class="radio" name="key[education_smp_transport]" id="key_education_smp_transport_many" type="radio" value="many"> 
							Many use bicyle/motorised transport >30%
						    </dd>
						    <dd>
							<input class="radio" name="key[education_smp_transport]" id="key_education_smp_transport_some" type="radio" value="some"> 
							Some use bicyle/motorised transport 5-30%
						    </dd>
						    <dd>
							<input class="radio" checked name="key[education_smp_transport]" id="key_education_smp_transport_walk" type="radio" value="walk"> 
							Almost all walk >95%
						    </dd>
						</dl>
					    </td>
					</tr>
					<tr>
					    <td rowspan="3">
						SMA
					    </td>
					    <td rowspan="3">
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sma_location]" id="key_education_sma_location" type="text" />
						</span>
					    </td>
					    <td rowspan="3">
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sma_total_students]" id="key_education_sma_total_students" type="text" />
						</span>
					    </td>
					    <td rowspan="3">
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sma_total_boys]" id="key_education_sma_total_boys" type="text" />
						</span>
					    </td>
					    <td rowspan="3">
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sma_total_girls]" id="key_education_sma_total_girls" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <select class="text required tip-error" name="key[education_sma_walk_travel_wet]" id="key_education_sma_walk_travel_wet">
							<option value="<1h"><1h</option>
							<option value="1-2h">1-2h</option>
							<option value=">2h">>2h-board</option>
						    </select>
						</span>
					    </td>
					    <td>
						<select name="key[education_sma_walk_travel_dry]" id="key_education_sma_walk_travel_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h-board</option>
						</select>
					    </td>
					    <td>
						Walk
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sma_walk_travel_cost]" id="key_education_sma_walk_travel_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td>
						<span class="input_wrapper medium_input">
						    <select class="text required tip-error" name="key[education_sma_motor_travel_wet]" id="key_education_sma_motor_travel_wet">
							<option value="<1h"><1h</option>
							<option value="1-2h">1-2h</option>
							<option value=">2h">>2h</option>
                                                        <option value="n/a">>N/A</option>
						    </select>
						</span>
					    </td>
					    <td>
						<select name="key[education_sma_motor_travel_dry]" id="key_education_sma_motor_travel_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					    <td>
						Motor/bicyle
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[education_sma_motor_travel_cost]" id="key_education_sma_motor_travel_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td colspan="4">
						<dl>
						    <dd>
							<input class="radio" name="key[education_sma_transport]" id="key_education_sma_transport_many" type="radio" value="many"> 
							Many use bicyle/motorised transport >30%
						    </dd>
						    <dd>
							<input class="radio" name="key[education_sma_transport]" id="key_education_sma_transport_some" type="radio" value="some"> 
							Some use bicyle/motorised transport 5-30%
						    </dd>
						    <dd>
							<input class="radio" checked name="key[education_sma_transport]" id="key_education_sma_transport_walk" type="radio" value="walk"> 
							Almost all walk >95%
						    </dd>
						</dl>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			    Further Comments/Notes:
		    </div>
		    <div class="row">
			<span class="input_wrapper textarea_wrapper">
			    <textarea rows="3" cols="40" class="text" name="key[comments_education]" id="key_comments_education"></textarea>
			</span>
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
	    $( '#form-snapshot-education' ).populate( dataForm  );
	}
    );
</script>