<h1>Access to Education</h1>

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
		    2.1 % Primary enrolments
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][0]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			60-100%
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][0]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			40-59.9%
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][0]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			0-39.9%
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    2.2 Access to Primary School
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][1]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			In the Suco
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][1]['value'] == 2 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			Between 1-2 hours
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][1]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			More than one hour
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    2.3 Walking to Junior High School (SMP)
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][2]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Less than one hour one way daily
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][2]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			Between 1-2 hours one way daily
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][2]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			More than 2 hourse/most students boarding
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    2.4 Transport to Junir High School
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][3]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Less than one hour one way daily
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][3]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			More than one hour one way daily
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][3]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			No access/Not available
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    2.5 Mode of transport to SMP
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][4]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Many use bicyle/motorised tranport >30%
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][4]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			Some use bicycle/motorised transport >5%
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][4]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			All students walk >95%
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    2.6 Walking to Senior High School (SMA)
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][5]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Less than one hour one way daily
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][5]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			More than one hour one way daily
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][5]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			No access/Not available
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    2.7 Transport to Senior High School (SMA)
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][6]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Less than one hour one way daily
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][6]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			More than one hour one way daily
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][6]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			No access/Not available
		    </a>
		</td>
	    </tr>
	    <tr>
		<th>
		    2.8 Mode of transport to SMA
		</th>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][7]['value'] == 2 ? 'fixed-ranking green-ranking' : ''; ?>">
			
			Many use bicyle/motorised tranport >30%
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][7]['value'] == 1 ? 'fixed-ranking yellow-ranking' : ''; ?>">
			
			Some use bicycle/motorised transport >5%
		    </a>
		</td>
		<td>
		    <a href="javascript:;" class="<?php echo $this->report['indicators'][7]['value'] == 0 ? 'fixed-ranking red-ranking' : ''; ?>">
			
			All students walk >95%
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
	    <th>Total (/10)</th>
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