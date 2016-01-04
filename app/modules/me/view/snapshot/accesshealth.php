<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/me/snapshot/saveaccesshealth/" method="post"  id="form-snapshot-health"
	  class="search_form general_form" onsubmit="return saveHealth( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_snapshot" id="id_snapshot" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

		    <div class="row">
			<h3>3.1-3.3 Access to Health Services</h3>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <tbody>
					<tr>
					    <td>
						SISCA
					    </td>
					    <td>
						<select name="key[health_sisca]" id="key_health_sisca">
						    <option value="both">Yes, wet and dry season</option>
						    <option value="dry">Dry season only</option>
						    <option value="no">No</option>
						</select>
					    </td>
					</tr>
					<tr>
					    <td>
						Outreach medical services (Gov, NGOs, Church)
					    </td>
					    <td>
						<select name="key[health_medical]" id="key_health_medical">
						    <option value="both">Yes, wet and dry season</option>
						    <option value="dry">Dry season only</option>
						    <option value="no">No</option>
						</select>
					    </td>
					</tr>
					<tr>
					    <td>
						Emergency health transport (ambulance, private)
					    </td>
					    <td>
						<select name="key[health_emergency]" id="key_health_emergency">
						    <option value="both">Yes, wet and dry season</option>
						    <option value="dry">Dry season only</option>
						    <option value="no">No</option>
						</select>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			<h3>3.4-3.9 Access to Health Services</h3>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th rowspan="2"></th>
					    <th rowspan="2">Location</th>
					    <th colspan="2">Travel Time</th>
					    <th rowspan="2">Means of Transport</th>
					    <th rowspan="2">Cost of travel</th>
					</tr>
					<tr>
					    <th>wet</th>
					    <th>dry</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <td rowspan="2">
						<strong>Health Post</strong>
					    </td>
					    <td rowspan="2">
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[health_post_location]" id="key_health_post_location" type="text" />
						</span>
					    </td>
					    <td>
						<select name="key[health_post_walk_wet]" id="key_health_post_walk_wet">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
						</select>
					    </td>
					    <td>
						<select name="key[health_post_walk_dry]" id="key_health_post_walk_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
						</select>
					    </td>
					    <td>
						Walking
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[health_post_walk_cost]" id="key_health_post_walk_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td>
						<select name="key[health_post_motor_wet]" id="key_health_post_motor_wet">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					    <td>
						<select name="key[health_post_motor_dry]" id="key_health_post_motor_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					    <td>
						Motorised
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[health_post_motor_cost]" id="key_health_post_motor_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td rowspan="2">
						<strong>Health Centre</strong>
					    </td>
					    <td rowspan="2">
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[health_centre_location]" id="key_health_centre_location" type="text" />
						</span>
					    </td>
					    <td>
						<select name="key[health_centre_walk_wet]" id="key_health_centre_walk_wet">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
						</select>
					    </td>
					    <td>
						<select name="key[health_centre_walk_dry]" id="key_health_centre_walk_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
						</select>
					    </td>
					    <td>
						Walking
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[health_centre_walk_cost]" id="key_health_centre_walk_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td>
						<select name="key[health_centre_motor_wet]" id="key_health_centre_motor_wet">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					    <td>
						<select name="key[health_centre_motor_dry]" id="key_health_centre_motor_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					    <td>
						Motorised
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[health_centre_motor_cost]" id="key_health_centre_motor_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td rowspan="2">
						<strong>Midwife</strong>
					    </td>
					    <td rowspan="2">
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[health_midwife_location]" id="key_health_midwife_location" type="text" />
						</span>
					    </td>
					    <td>
						<select name="key[health_midwife_walk_wet]" id="key_health_midwife_walk_wet">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
						</select>
					    </td>
					    <td>
						<select name="key[health_midwife_walk_dry]" id="key_health_midwife_walk_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
						</select>
					    </td>
					    <td>
						Walking
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[health_midwife_walk_cost]" id="key_health_midwife_walk_cost" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <td>
						<select name="key[health_midwife_motor_wet]" id="key_health_midwife_motor_wet">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					    <td>
						<select name="key[health_midwife_motor_dry]" id="key_health_midwife_motor_dry">
						    <option value="<1h"><1h</option>
						    <option value="1-2h">1-2h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					    <td>
						Motorised
					    </td>
					    <td>
						<span class="input_wrapper medium_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[health_midwife_motor_cost]" id="key_health_midwife_motor_cost" type="text" />
						</span>
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
	    $( '#form-snapshot-health' ).populate( dataForm  );
	}
    );
</script>