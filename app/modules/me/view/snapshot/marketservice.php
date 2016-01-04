<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/me/snapshot.css" />
<?php require_once 'headersnapshot.php'; ?>

<div class="forms">

    <div class="abas-form">

	<div class="row">
	    <h3>1 - Access to Markets</h3>
	    <p>According to the data collected for the Community Snapshot, rank each of the indicators according to the following criteria.</p>
	</div>

	<div class="row">
	    <div class="table_wrapper table-rankings">
		<div class="table_wrapper_inner">
		    <table width="100%" cellspacing="0" cellpadding="0">
			<thead>
			    <tr>
				<th>Indicator</th>
				<th class="green-ranking">Green <br/> (2)</th>
				<th class="yellow-ranking">Yellow <br/> (1)</th>
				<th class="red-ranking">Red <br/> (0)</th>
			    </tr>
			</thead>
			<tbody>
			    <tr>
				<th>
				    1.1 Accessibility of road
				    <input name="indicator[1]" id="indicator_1" type="hidden" />
				</th>
				<td>
				    <a href="javascript:;" class="green-ranking no-color">
					<span></span>
					All vehicles can pass in wet and dry season
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="yellow-ranking no-color">
					<span></span>
					At least some months only motor bikes and 4WD vehicles can pass
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="red-ranking no-color">
					<span></span>
					At least some months where no motorised transport can pass
				    </a>
				</td>
			    </tr>
			    <tr>
				<th>
				    1.2 Public Transport services to the suco
				    <input name="indicator[2]" id="indicator_2" type="hidden" />
				</th>
				<td>
				    <a href="javascript:;" class="green-ranking no-color">
					<span></span>
					Regular service
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="yellow-ranking no-color">
					<span></span>
					Dry season only
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="red-ranking no-color">
					<span></span>
					No service
				    </a>
				</td>
			    </tr>
			    <tr>
				<th>
				    1.3 Hire of transport services
				    <input name="indicator[3]" id="indicator_3" type="hidden" />
				</th>
				<td>
				    <a href="javascript:;" class="green-ranking no-color">
					<span></span>
					Available and will wet and dry season
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="yellow-ranking no-color">
					<span></span>
					Dry season only
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="red-ranking no-color">
					<span></span>
					Difficult to hire in wet season
				    </a>
				</td>
			    </tr>
			    <tr>
				<th>
				    1.4 Affordabilty, commonly used mode of transport for travel to the market to buy or sell items
				    <input name="indicator[4]" id="indicator_4" type="hidden" />
				</th>
				<td>
				    <a href="javascript:;" class="green-ranking no-color">
					<span></span>
					60-100% of small business people regurlaly use motorised transport (at least one way)
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="yellow-ranking no-color">
					<span></span>
					20-60% of small business people regularly use motorised transport (at least one way)
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="red-ranking no-color">
					<span></span>
					0-20% of small business people regularly use motorised transport (at least one way)
				    </a>
				</td>
			    </tr>
			    <tr>
				<th>
				    1.5 Walking time to most common market
				    <input name="indicator[5]" id="indicator_5" type="hidden" />
				</th>
				<td>
				    <a href="javascript:;" class="green-ranking no-color">
					<span></span>
					Less than one hour
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="yellow-ranking no-color">
					<span></span>
					Between 1-2 hours
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="red-ranking no-color">
					<span></span>
					More than two hours
				    </a>
				</td>
			    </tr>
			    <tr>
				<th>
				    1.6 Transport time to most common market
				    <input name="indicator[6]" id="indicator_6" type="hidden" />
				</th>
				<td>
				    <a href="javascript:;" class="green-ranking no-color">
					<span></span>
					Less than one hour
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="yellow-ranking no-color">
					<span></span>
					Between 1-2 hours
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="red-ranking no-color">
					<span></span>
					More than two hours
				    </a>
				</td>
			    </tr>
			    <tr>
				<th>
				    1.7 Visiting traders
				    <input name="indicator[7]" id="indicator_7" type="hidden" />
				</th>
				<td>
				    <a href="javascript:;" class="green-ranking no-color">
					<span></span>
					Traders regularly visit suco to buy produce as well as sell to HHs in both and dry wet season
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="yellow-ranking no-color">
					<span></span>
					There is trade for specific produce during the dry season (eg: coffee)
				    </a>
				</td>
				<td>
				    <a href="javascript:;" class="red-ranking no-color">
					<span></span>
					No traders visit the suco in either dry or wet season
				    </a>
				</td>
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
		<div class="table_wrapper_inner total-score">
		    <table width="100%" cellspacing="0" class="summary" cellpadding="0">
			<thead>
			    <tr>
				<th></th>
				<th>Total (/14)</th>
				<th>% Score</th>
			    </tr>
			</thead>
			<tbody>
			    <tr>
				<th>Access to Markets</th>
				<td>
				    <span class="input_wrapper short_input">
					<input class="text" name="total" value="0" readonly id="total" type="text" />
				    </span>
				</td>
				<td>
				    <span class="input_wrapper short_input">
					<input class="text" name="score" id="score" value="0" readonly type="text" />
				    </span>
				</td>
			    </tr>
			</tbody>
		    </table>
		</div>
	    </div>
	</div>


    </div>
</div>

<script type="text/javascript">
    $( document ).ready(
    function()
    {
	parent.loadIndicators();
    }
);
</script>