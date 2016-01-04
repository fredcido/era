<h1>Access to Markets</h1>

<div class="container-report">
     <table class="summary" id="relatorio">
	 <tr>
	     <th>
		 <label><?php echo $this->t( 'Distritu', 96 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['snapshot']->getFkIdAddDistrict()->getDistrict(); ?>
	     </td>
	     <th>
		 <label><?php echo $this->t( 'Sub-distrito', 98 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['snapshot']->getFkIdAddSubdistrict()->getSubdistrict(); ?>
	     </td>
	 </tr>
	 <tr>
	     <th>
		 <label><?php echo $this->t( 'Suku', 100 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['snapshot']->getFkIdAddSuku()->getSuku(); ?>
	     </td>
	     <th>
		 <label><?php echo $this->t( 'Reference', 621 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['snapshot']->getReference() == 0 ? 'Baseline' : 'Endline'; ?>
	     </td>
	 </tr>
	 <tr>
	     <th>
		 <label><?php echo $this->t( 'Road location', 626 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['snapshot']->getRoadLocation(); ?>
	     </td>
	     <th>
		 <label><?php echo $this->t( 'Code', 628 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['snapshot']->getCode(); ?>
	     </td>
	 </tr>
	 <tr>
	     <th>
		 <label><?php echo $this->t( 'Data de registro', 76 ); ?></label>
	     </th>
	     <td>
		 <?php echo ILO_Util_Geral::dateToBr( $this->report['snapshot']->getDateSnapshot() ); ?>
	     </td>
	 </tr>
     </table>
 </div>
 
 <div class="container-report">
     <table class="summary table-rankings" id="relatorio">
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
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][0]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			All vehicles can pass in wet and dry season
		    </a>
		</td>
		<td class="<?php echo $this->report['indicators'][0]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
		    <a href="javascript:;" >
			
			At least some months only motor bikes and 4WD vehicles can pass
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][0]['value'] == 0 ? 'fixed-ranking red-ranking ' : ''; ?>">
			
			At least some months where no motorised transport can pass
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    1.2 Public Transport services to the suco
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][1]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Regular service
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][1]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			Dry season only
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][1]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			No service
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    1.3 Hire of transport services
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][2]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Available and will wet and dry season
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][2]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			Dry season only
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][2]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			Difficult to hire in wet season
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    1.4 Affordabilty, commonly used mode of transport for travel to the market to buy or sell items
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][3]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			60-100% of small business people regurlaly use motorised transport (at least one way)
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][3]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			20-60% of small business people regularly use motorised transport (at least one way)
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][3]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			0-20% of small business people regularly use motorised transport (at least one way)
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    1.5 Walking time to most common market
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][4]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Less than one hour
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][4]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			Between 1-2 hours
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][4]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			More than two hours
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    1.6 Transport time to most common market
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][5]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Less than one hour
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][5]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			Between 1-2 hours
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][5]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			More than two hours
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    1.7 Visiting traders
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][6]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Traders regularly visit suco to buy produce as well as sell to HHs in both and dry wet season
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][6]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			There is trade for specific produce during the dry season (eg: coffee)
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][6]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			No traders visit the suco in either dry or wet season
		    </a>
		</td>
	    </tr>
	</tbody>
     </table>
 </div>
 
 <hr />

<table id="relatorio">
    <thead>
	<tr>
	    <th></th>
	    <th>Total (/12)</th>
	    <th>% Score</th>
	</tr>
    </thead>
    <tbody>
	<tr>
	    <th>Access to Markets</th>
	    <td>
		<?php echo $this->report['total']['total']; ?>
	    </td>
	    <td>
		<?php echo $this->report['total']['score']; ?>%
	    </td>
	</tr>
    </tbody>
</table>