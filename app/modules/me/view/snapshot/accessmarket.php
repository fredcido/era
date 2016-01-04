<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/me/snapshot/saveaccessmarket/" method="post"  id="form-snapshot-market"
	  class="search_form general_form" onsubmit="return saveMarket( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_snapshot" id="id_snapshot" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

		    <div class="row">
			<h3>1.1 Access to all weather roads</h3>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th colspan="2">Road is passable by:</th>
					</tr>
					<tr>
					    <th>Wet</th>
					    <th>Dry</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <td>
						<input class="checkbox required road" name="key[road_vehicles_wet_all]" id="key_road_vehicles_wet_all" type="checkbox" value="1"> 
						All vehicles
					    </td>
					    <td>
						<input class="checkbox required" name="key[road_vehicles_dry_all]" id="key_road_vehicles_dry_all" type="checkbox" value="1"> 
						All vehicles
					    </td>
					</tr>
					<tr>
					    <td>
						<input class="checkbox road" name="key[road_vehicles_wet_trucks]" id="key_road_vehicles_wet_trucks" type="checkbox" value="1"> 
						High-axel trucks
					    </td>
					    <td>
						<input class="checkbox" name="key[road_vehicles_dry_trucks]" id="road_vehicles_dry_trucks" type="checkbox" value="1"> 
						Only high-axel trucks
					    </td>
					</tr>
					<tr>
					    <td>
						<input class="checkbox road" name="key[road_vehicles_wet_4wd]" id="key_road_vehicles_wet_4wd" type="checkbox" value="1"> 
						4WD
					    </td>
					    <td>
						<input class="checkbox" name="key[road_vehicles_dry_4wd]" id="road_road_vehicles_dry_4wd" type="checkbox" value="1"> 
						4WD
					    </td>
					</tr>
					<tr>
					    <td>
						<input class="checkbox road" name="key[road_vehicles_wet_bikes]" id="key_road_vehicles_wet_bikes" type="checkbox" value="1"> 
						Motor bikes
					    </td>
					    <td>
						<input class="checkbox" name="key[road_vehicles_dry_bikes]" id="road_road_vehicles_dry_bikes" type="checkbox" value="1"> 
						Motor bikes
					    </td>
					</tr>
					<tr>
					    <td>
						<input class="checkbox road" name="key[road_vehicles_wet_no]" id="key_road_vehicles_wet_bikes" type="checkbox" value="1"> 
						no motorized vehicles
					    </td>
					    <td>
						<input class="checkbox" name="key[road_vehicles_dry_bikes]" id="road_road_vehicles_dry_bikes" type="checkbox" value="1"> 
						no motorized vehicles
					    </td>
					</tr>
					<tr>
					    <td>
						<input class="checkbox road" name="key[road_vehicles_wet_walking]" id="key_road_vehicles_wet_walking" type="checkbox" value="1"> 
						walking
					    </td>
					    <td>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			    Further Comments/Notes: (eg type and quality of surface, difficult river corrings, landslides etc)
		    </div>
		    <div class="row">
			<span class="input_wrapper textarea_wrapper">
			    <textarea rows="3" cols="40" class="text" name="key[comments_market_roads]" id="key_comments_market_roads"></textarea>
			</span>
		    </div>
		    
		    <div class="row">
			<h3>1.2 Public transport services to the suco from the main road/market</h3>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th>Public transport</th>
					    <th>Service</th>
					    <th>Frequency</th>
					    <th>Cost</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_public_angguna]" id="key_market_public_angguna" type="checkbox" value="1"> 
							Angguna
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_public_microlet]" id="key_market_public_microlet" type="checkbox" value="1"> 
							Microlet
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_public_mctaxi]" id="key_market_public_mctaxi" type="checkbox" value="1"> 
							MC Taxi
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_public_taxi]" id="key_market_public_taxi" type="checkbox" value="1"> 
							Taxi
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_public_other]" id="key_market_public_other" type="checkbox" value="1"> 
							Other
						    </dd>
						</dl>
					    </td>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_service]" id="key_market_service_wet" type="radio" value="wet"> 
							Wet season
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_service]" id="key_market_service_dry" type="radio" value="dry"> 
							Dry season only
						    </dd>
						    <dd>
							<input class="checkbox" checked name="key[market_service]" id="key_market_service_no" type="radio" value="no"> 
							No service
						    </dd>
						</dl>
					    </td>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_public_frequency_hired]" id="key_market_public_frequency_hired" type="checkbox" value="1"> 
							As hired
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_public_frequency_nil]" id="key_market_public_frequency_nil" type="checkbox" value="1"> 
							Nill
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_public_frequency_daily]" id="key_market_public_frequency_daily" type="checkbox" value="1"> 
							Daily
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_public_frequency_weekly]" id="key_market_public_frequency_weekly" type="checkbox" value="1"> 
							Weekly
						    </dd>
						</dl>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[market_public_cost]" id="key_market_public_cost" type="text" />
						</span>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			<h3>1.3 Private transport services to the suco from the main road/market</h3>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th>Private transport</th>
					    <th>For hire</th>
					    <th>Frequency</th>
					    <th>Cost</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_private_4wd]" id="key_market_private_4wd" type="checkbox" value="1"> 
							4WD
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_private_pickup]" id="key_market_private_pickup" type="checkbox" value="1"> 
							Pick up
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_private_truck]" id="key_market_private_truck" type="checkbox" value="1"> 
							Truck
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_private_other]" id="key_market_private_other" type="checkbox" value="1"> 
							Other
						    </dd>
						</dl>
					    </td>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_forhire]" id="key_market_forhire_wet" type="radio" value="wet"> 
							Wet season
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_forhire]" id="key_market_forhire_dry" type="radio" value="dry"> 
							Dry season only
						    </dd>
						    <dd>
							<input class="checkbox" checked name="key[market_forhire]" id="key_market_forhire_no" type="radio" value="no"> 
							No service
						    </dd>
						</dl>
					    </td>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_private_frequency_nil]" id="key_market_private_frequency_nil" type="checkbox" value="1"> 
							Nill
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_private_frequency_ashired]" id="key_market_private_frequency_ashired" type="checkbox" value="1"> 
							As hired
						    </dd>
						</dl>
					    </td>
					    <td>
						<span class="input_wrapper short_input">
						    <input class="text  tip-error float" msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" 
							name="key[market_private_cost]" id="key_market_private_cost" type="text" />
						</span>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			    Further Comments/Notes: Indicate type of available transport services
		    </div>
		    <div class="row">
			<span class="input_wrapper textarea_wrapper">
			    <textarea rows="3" cols="40" class="text" name="key[comments_transport_service]" id="key_comments_transport_service"></textarea>
			</span>
		    </div>
		    
		    <div class="row">
			<h3>1.4 How do the people most commonly travel to the main road/markets to buy and/or sell items? <br />(availability and affordability)</h3>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th rowspan="2">Means of Transport</th>
					    <th colspan="2">Travel Time</th>
					    <th rowspan="2">Proportion walk/motorised (wet season)</th>
					</tr>
					<tr>
					    <th>wet</th>
					    <th>Dry</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <td>
						<stong>1. Walk/animal</stong>
					    </td>
					    <td>
						<select class="text tip-error" name="key[market_travel_wet_animal]" id="key_market_travel_wet_animal"
							msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
						    <option value="0 - 30 min">0 - 30 min</option>
						    <option value="31 - 59 min">31 - 59 min</option>
						    <option value="1 - 2 h">1 - 2 h</option>
						    <option value=">2h">>2h</option>
						</select>
					    </td>
					    <td>
						<select class="text tip-error" name="key[market_travel_dry_animal]" id="key_market_travel_dry_animal"
							msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
						    <option value="0 - 30 min">0 - 30 min</option>
						    <option value="31 - 59 min">31 - 59 min</option>
						    <option value="1 - 2 h">1 - 2 h</option>
						    <option value=">2h">>2h</option>
						</select>
					    </td>
					    <td rowspan="2">
						<dl>
						    <dd>
							<input class="radio" name="key[market_travel_motorised]" id="key_market_travel_manymotorised" type="radio" value="many">
							Many use motorised at least one way > 30%
						    </dd>
						    <dd>
							<input class="radio" name="key[market_travel_motorised]" id="key_market_travel_somemotorised" type="radio" value="some"> 
							Some use motorised at least one way 5-30%
						    </dd>
						    <dd>
							<input class="radio" checked name="key[market_travel_motorised]" id="key_market_travel_walkmotorised" type="radio" value="walk"> 
							Almost all walk >95%
						    </dd>
						</dl>
					    </td>
					</tr>
					<tr>
					    <td>
						<dl>
						    <dt>
							<strong>2. Motorised transport</strong>
						    </dt>
						    <dd>
							<input class="checkbox" name="key[market_motorised_angguna]" id="key_market_motorised_angguna" type="checkbox" value="1"> 
							Angguna
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_motorised_microlet]" id="key_market_motorised_microlet" type="checkbox" value="1"> 
							Microlet
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_motorised_motorbike]" id="key_market_motorised_motorbike" type="checkbox" value="1"> 
							Motorbike
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_motorised_4wd]" id="key_market_motorised_4wd" type="checkbox" value="1"> 
							4WD
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_motorised_pickup]" id="key_market_motorised_pickup" type="checkbox" value="1"> 
							Pick up
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_motorised_truck]" id="key_market_motorised_truck" type="checkbox" value="1"> 
							Truck
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_motorised_other]" id="key_market_motorised_other" type="checkbox" value="1"> 
							Other
						    </dd>
						</dl>
					    </td>
					    <td>
						<select class="text tip-error" name="key[market_motorised_wet_cost]" id="key_market_motorised_wet_cost"
							msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
						    <option value="0 - 30 min">0 - 30 min</option>
						    <option value="31 - 59 min">31 - 59 min</option>
						    <option value="1 - 2 h">1 - 2 h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					    <td>
						<select class="text tip-error" name="key[market_motorised_dry_cost]" id="key_market_motorised_dry_cost"
							msgError="<?php echo $this->t( 'Preencha este campo', 648 ); ?>" >
						    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
						    <option value="0 - 30 min">0 - 30 min</option>
						    <option value="31 - 59 min">31 - 59 min</option>
						    <option value="1 - 2 h">1 - 2 h</option>
						    <option value=">2h">>2h</option>
                                                    <option value="n/a">>N/A</option>
						</select>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    
		    <div class="row">
			    Further Comments/Notes: (indicate type of transporte available)
		    </div>
		    <div class="row">
			<span class="input_wrapper textarea_wrapper">
			    <textarea rows="3" cols="40" class="text" name="key[comments_transport_available]" id="key_comments_transport_available"></textarea>
			</span>
		    </div>
		    
		    <div class="row">
			<h3>1.5-1.6 Access to Markets (in order of <span style="text-decoration: underline">most commonly</span> used by most of the population)</h3>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th rowspan="2">Market location</th>
					    <th rowspan="2"># Days/week</th>
					    <th colspan="2">Travel Time</th>
					    <th rowspan="2">Transport</th>
					    <th rowspan="2">Travel cost</th>
					    <th rowspan="2">
						 <span class="button blue_button">
						    <span>
							<span>
							    ADD
							</span>
						    </span>
						    <input name="operacao" onClick="addAccessMarket();" type="button" />
						</span>
					    </th>
					</tr>
					<tr>
					    <th>Wet Season</th>
					    <th>Dry Season</th>
					</tr>
				    </thead>
				    <tbody id="access-market">
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
			    <textarea rows="3" cols="40" class="text" name="key[comments_access_markets]" id="key_comments_access_markets"></textarea>
			</span>
		    </div>
		    
		    <div class="row">
			<h3>1.7 Visiting Traders</h3>
		    </div>
		    
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th>Visiting traders</th>
					    <th>Products</th>
					    <th>Buy/sell</th>
					    <th>Transport</th>
					    <th>Frequency</th>
					</tr>
				    </thead>
				    <tbody>
					<tr>
					    <td>
						<dl>
						    <dd>
							<input class="radio" name="key[market_visiting_traders]" checked id="key_market_visiting_traders_no" type="radio" value="no"> 
							No visiting traders
						    </dd>
						    <dd>
							<input class="radio" name="key[market_visiting_traders]" id="key_market_visiting_traders_no" type="radio" value="dry"> 
							Dry season only
						    </dd>
						    <dd>
							<input class="radio" checked name="key[market_visiting_traders]" id="key_market_visiting_traders_no" type="radio" value="both"> 
							Both dry/wet
						    </dd>
						</dl>
					    </td>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_traders_products_clothes]" id="key_market_traders_products_clothes" type="checkbox" value="1"> 
							Clothes
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_products_cattle]" id="key_market_traders_products_cattle" type="checkbox" value="1"> 
							Cattle
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_products_coffee]" id="key_market_traders_products_coffee" type="checkbox" value="1"> 
							Coffee
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_products_corn]" id="key_market_traders_products_corn" type="checkbox" value="1"> 
							Corn / Rice
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_products_vegetable]" id="key_market_traders_products_vegetable" type="checkbox" value="1"> 
							Vegetable
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_products_household]" id="key_market_traders_products_household" type="checkbox" value="1"> 
							Household products
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_products_other]" id="key_market_traders_products_other" type="checkbox" value="1"> 
							Other
						    </dd>
						</dl>
					    </td>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_traders_buy_sell]" id="market_traders_buy_sell_buy" type="radio" value="buy"> 
							Buy
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_buy_sell]" id="market_traders_buy_sell_sell" type="radio" value="buy"> 
							Sell
						    </dd>
						    <dd>
							<input class="checkbox" checked name="key[market_traders_buy_sell]" id="market_traders_buy_sell_both" type="radio" value="both"> 
							Buy & Sell
						    </dd>
						</dl>
					    </td>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_traders_transport_microlet]" id="key_market_traders_transport_microlet" type="checkbox" value="1"> 
							Microlet
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_transport_angguna]" id="key_market_traders_transport_angguna" type="checkbox" value="1"> 
							Angguna
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_transport_motor]" id="key_market_traders_transport_motor" type="checkbox" value="1"> 
							Motor cycle
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_transport_bycicle]" id="key_market_traders_transport_bycicle" type="checkbox" value="1"> 
							Bicycle
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_transport_truck]" id="key_market_traders_transport_truck" type="checkbox" value="1"> 
							Truck
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_transport_pickup]" id="key_market_traders_transport_pickup" type="checkbox" value="1"> 
							Pick up
						    </dd>
						</dl>
					    </td>
					    <td>
						<dl>
						    <dd>
							<input class="checkbox" name="key[market_traders_frequency_regular]" id="key_market_traders_frequency_regular" type="checkbox" value="1"> 
							Regular
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_frequency_daily]" id="key_market_traders_frequency_daily" type="checkbox" value="1"> 
							Daily
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_frequency_times]" id="key_market_traders_frequency_times" type="checkbox" value="1"> 
							2-3 times week
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_frequency_weekly]" id="key_market_traders_frequency_weekly" type="checkbox" value="1"> 
							Weekly
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_frequency_monthly]" id="key_market_traders_frequency_monthly" type="checkbox" value="1"> 
							Monthly
						    </dd>
						    <dd>
							<input class="checkbox" name="key[market_traders_frequency_irregular]" id="key_market_traders_frequency_irregular" type="checkbox" value="1"> 
							Irregular
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
			    <textarea rows="3" cols="40" class="text" name="key[comments_visiting_traders]" id="key_comments_visiting_traders"></textarea>
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
	    $( '#form-snapshot-market' ).populate( dataForm  );
	    
	    var dataAccessMarket = <?php echo json_encode( $this->access ); ?>;
	    if ( !empty( dataAccessMarket ) )
		for ( x in dataAccessMarket )
		    addAccessMarket( dataAccessMarket[x] );
	}
    );
</script>