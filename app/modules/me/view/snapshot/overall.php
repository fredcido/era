<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
     <form action="<?php echo BASE; ?>/me/snapshot/saveoverall/" method="post"  id="form-snapshot-overall"
	  class="search_form general_form" onsubmit="return saveOverall( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_snapshot" id="id_snapshot" type="hidden" />

	    <div class="forms">

		<div class="abas-form">
		    
		    <div id="overall-rankings">
		    
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <h3><?php echo $this->t( 'Overall Rankings', 641 ); ?></h3>                        
			</div>
			<!--[if !IE]>end row<![endif]-->

			<div class="row">
			    <div class="table_wrapper" id="rankings">
				<div class="table_wrapper_inner">
				    <table width="100%" cellspacing="0" cellpadding="0">
					<tbody>
					    <tr>
						<th rowspan="2" class="red-ranking">Red</th>
						<td>0-20%</td>
					    </tr>
					    <tr>
						<td>21-40%</td>
					    </tr>
					    <tr>
						<th rowspan="2" class="yellow-ranking">Yellow</th>
						<td>41-60%</td>
					    </tr>
					    <tr>
						<td>61-80%</td>
					    </tr>
					    <tr>
						<th class="green-ranking">Green</th>
						<td>81-100%</td>
					    </tr>
					</tbody>
				    </table>
				</div>
			    </div>
			</div>

			<div class="row">
			    <hr />
			</div>

			<div class="row">
			    <div class="table_wrapper">
				<div class="table_wrapper_inner">
				    <table width="100%" cellspacing="0" cellpadding="0" id="ranking-notes">
					<thead>
					    <tr>
						<th></th>
						<th>Status</th>
						<th>Ranking (%)</th>
						<th>Comment/Note</th>
					    </tr>
					</thead>
					<tbody>
					    <tr>
						<th>Access to Health Services</th>
						<td>
						    <span class="ranking"></span>
						</td>
						<td>
						    <span class="input_wrapper short_input">
							<input class="text" name="ranking_health" value="0" readonly id="ranking_health" type="text" />
						    </span>
						</td>
						<td>
						    <span class="input_wrapper large_input">
							<input class="text" name="health_comment" id="health_comment" type="text" />
						    </span>
						</td>
					    </tr>
					    <tr>
						<th>Access to Education</th>
						<td><span class="ranking"></span></td>
						<td>
						    <span class="input_wrapper short_input">
							<input class="text" name="ranking_education" value="0" readonly id="ranking_education" type="text" />
						    </span>
						</td>
						<td>
						    <span class="input_wrapper large_input">
							<input class="text" name="education_comment" id="education_comment" type="text" />
						    </span>
						</td>
					    </tr>
					    <tr>
						<th>Access to Markets</th>
						<td><span class="ranking"></span></td>
						<td>
						    <span class="input_wrapper short_input">
							<input class="text" name="ranking_market" value="0" readonly id="ranking_market" type="text" />
						    </span>
						</td>
						<td>
						    <span class="input_wrapper large_input">
							<input class="text" name="market_comment" id="market_comment" type="text" />
						    </span>
						</td>
					    </tr>
					</tbody>
				    </table>
				</div>
			    </div>
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
		<!--[if !IE]>end product gallery<![endif]-->
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
	$( '#form-snapshot-overall' ).populate( dataForm  );
	
	if ( dataForm.indicators ) {
		
	    $( '#overall-rankings' ).show();

	    switch ( true ) {
		case dataForm.ranking_health >= 41 && dataForm.ranking_health <= 80:
		    ranking = 'yellow-ranking';
		    break;
		case dataForm.ranking_health >= 81:
		    ranking = 'green-ranking';
		    break;
		default:
		    ranking = 'red-ranking';
	    }

	    $( '#ranking-notes tbody tr span.ranking' ).eq( 0 ).addClass( ranking );

	    switch ( true ) {
		case dataForm.ranking_education >= 41 && dataForm.ranking_education <= 80:
		    ranking = 'yellow-ranking';
		    break;
		case dataForm.ranking_education >= 81:
		    ranking = 'green-ranking';
		    break;
		default:
		    ranking = 'red-ranking';
	    }

	    $( '#ranking-notes tbody tr span.ranking' ).eq( 1 ).addClass( ranking );

	    switch ( true ) {
		case dataForm.ranking_market >= 41 && dataForm.ranking_market <= 80:
		    ranking = 'yellow-ranking';
		    break;
		case dataForm.ranking_market >= 81:
		    ranking = 'green-ranking';
		    break;
		default:
		    ranking = 'red-ranking';
	    }

	    $( '#ranking-notes tbody tr span.ranking' ).eq( 2 ).addClass( ranking );
	}
    }
);
</script>