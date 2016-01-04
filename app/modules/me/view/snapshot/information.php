<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/me/snapshot/saveinformation/" method="post"  id="form-snapshot-information"
	  class="search_form general_form" onsubmit="return saveInformation( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_snapshot" id="id_snapshot" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Distrito', 96 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_add_district" id="fk_id_add_district"
						onChange="carregaCombo( '/me/snapshot/subdistritos/id/' + this.value, 'fk_id_add_subdistrict' );"
						msgError="<?php echo $this->t( 'Selecione o distrito', 97 ); ?>" >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					    
					    <?php foreach ( $this->distritos as $distrito ) : ?>
						<option value="<?php echo $distrito->getIdAddDistrict(); ?>">
						    <?php echo $distrito->getDistrict(); ?>
						</option>
					    <?php endforeach; ?>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Distrito', 96 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Sub-distrito', 98 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_add_subdistrict" id="fk_id_add_subdistrict"
						onChange="carregaCombo( '/me/snapshot/sukus/id/' + this.value, 'fk_id_add_suku' );"
						msgError="<?php echo $this->t( 'Selecione o sub-distrito', 99 ); ?>" disabled >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Sub-distrito', 98 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Suku', 100 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_add_suku" id="fk_id_add_suku"
						msgError="<?php echo $this->t( 'Selecione o sub-distrito', 101 ); ?>" disabled >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Suku', 100 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Reference', 621 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="reference" id="reference"
						msgError="<?php echo $this->t( 'Selecione a referência', 622 ); ?>" >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					    <option value="0"><?php echo $this->t( 'Baseline', 623 ); ?></option>
					    <option value="1"><?php echo $this->t( 'Endline', 624 ); ?></option>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Snapshot Reference', 625 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Road location', 626 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error" name="road_location" 
					       msgError="<?php echo $this->t( 'Preencha a Road location', 627 ); ?>" 
					       maxlength="200" id="road_location" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Road location', 626 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Code', 628 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error" msgError="<?php echo $this->t( 'Preencha o code', 629 ); ?>" 
					       name="code" id="code" maxlength="50" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Code', 628 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Data de registro', 76 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error date-mask" name="date_snapshot" 
					       msgError="<?php echo $this->t( 'Preencha a data de registro', 77 ); ?>" 
					       maxlength="10" id="date_snapshot" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Data de registro', 76 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th></th>
					    <th>2010 Census</th>
					    <th>Suco data</th>
					</tr>
					<tr>
					    <th>Demographic data</th>
					    <th></th>
					    <th></th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <th># males</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[dem_male_census]" id="key_dem_male_census" maxlength="5" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[dem_male_suku]" id="key_dem_male_suku" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th># females</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[dem_female_census]" id="key_dem_female_census" maxlength="5" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[dem_female_suku]" id="key_dem_female_suku" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th>Total Population</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[dem_total_census]" id="key_dem_total_census" maxlength="5" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[dem_total_suku]" id="key_dem_total_suku" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
					<tr>
					    <th># Households</th>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[dem_hh_census]" id="key_dem_hh_census" maxlength="5" type="text" />
						</span>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error text-numeric" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[dem_hh_suku]" id="key_dem_hh_suku" maxlength="5" type="text" />
						</span>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0" id="villages">
				    <thead>
					<tr>
					    <th>Aldeia Name</th>
					    <th>Aldeia Code</th>
					    <th>Total</th>
					    <th># Women</th>
					    <th># Men</th>
					    <th># HHs</th>
					    <th>
						 <span class="button blue_button">
						    <span>
							<span>
							    ADD
							</span>
						    </span>
						    <input name="operacao" onClick="addVillage();" type="button" />
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
		    
		    <div class="row">
			<label>
			    Further Comments/Notes:
			</label>
			<div class="inputs">										
			    <span class="input_wrapper textarea_wrapper">
				<textarea rows="3" cols="40" class="text" name="key[comments_village]" id="key_comments_village"></textarea>
			    </span>
			</div>
		    </div>
		    
		    <div class="row">
			<h3>Communications</h3>
		    </div>
		    
		    <div class="row">
			<span class="label-button">Does the solar electricity (or electricity) system is working?</span>
			<span class="input_wrapper">
			    <label>
				<input name="key[electricity]" id="key_electricity" value="1" type="radio">
				YES
			    </label>
			    <label>
				<input name="key[electricity]" id="key_electricity" value="0" type="radio" checked>
				NO
			    </label>
			</span>
		    </div>
		    
		    <div class="row">
			<span class="label-button">Does the television (and parabola) in the Suco Office Work?</span>
			<span class="input_wrapper">
			    <label>
				<input name="key[television]" id="key_television" value="1" type="radio">
				YES
			    </label>
			    <label>
				<input name="key[television]" id="key_television" value="0" type="radio" checked>
				NO
			    </label>
			</span>
		    </div>
		    
		    <div class="row">
			<span class="label-button">Does the DVD player (with television) in the suco office work?</span>
			<span class="input_wrapper">
			    <label>
				<input name="key[dvd]" id="key_dvd" value="1" type="radio">
				YES
			    </label>
			    <label>
				<input name="key[dvd]" id="key_dvd" value="0" type="radio" checked>
				NO
			    </label>
			</span>
		    </div>
		    
		     <div class="row">
			<label>
			    Further Comments/Notes:
			</label>
			<div class="inputs">										
			    <span class="input_wrapper textarea_wrapper">
				<textarea rows="3" cols="40" class="text" name="key[comments_communications]" id="key_comments_village"></textarea>
			    </span>
			</div>
		    </div>
		    
		    <div class="row">
			<dl>
			    <dt>
				<span class="label-button" style="float: none;">What radio stations can you receive? (Tick all that apply)</span>
			    </dt>
			    <dd>
				<input class="checkbox" name="key[radio_timor]" id="key_radio_timor" type="checkbox" value="1"> 
				Radio Timor-Leste
			    </dd>
			    <dd>
				<input class="checkbox" name="key[radio_community]" id="key_radio_community" type="checkbox" value="1"> 
				Radio Komunidade
			    </dd>
			    <dd>
				<label>
				    <input class="checkbox" name="key[radio_other]" id="key_radio_other" type="checkbox" value="1"> 
				    Other: (specify)
				</label>
				
				<span class="input_wrapper large_input" style="margin-left: 20px">
				    <input type="text" maxlength="200" id="key_radio_other_desc" name="key[radio_other_desc]" class="text">
				</span>
			    </dd>
			</dl>
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
    villageData = <?php echo json_encode( $this->villages ); ?>;
    
    $( document ).ready(
	function()
	{
	    $( '#form-snapshot-information' ).populate( dataForm  );
	    

	    if ( dataForm.fk_id_add_district ) {

		// Busca subdistritos e popula combo
		carregaCombo( 
		    '/me/snapshot/subdistritos/id/' + dataForm.fk_id_add_district, 
		    'fk_id_add_subdistrict',
		    function()
		    {
			$( '#fk_id_add_subdistrict' ).val( dataForm.fk_id_add_subdistrict );
		    }
		);
		    
		// Busca sukus e popula combo
		carregaCombo( 
		    '/me/snapshot/sukus/id/' + dataForm.fk_id_add_subdistrict, 
		    'fk_id_add_suku',
		    function()
		    {
			$( '#fk_id_add_suku' ).val( dataForm.fk_id_add_suku );
			
			if ( !empty( villageData ) )
			    searchVillageSuku();
		    }
		);
	    }
	}
    );
</script>