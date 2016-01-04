 <h1><?php echo $this->t( 'Relatório Snapshot', 659 ); ?> </h1>
 
 
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

<table id="relatorio">
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
		<?php echo $this->report['indicators']['key']['dem_male_census']; ?>
	    </td>
	    <td>
		<?php echo $this->report['indicators']['key']['dem_male_suku']; ?>
	    </td>
	</tr>
	<tr>
	    <th># females</th>
	    <td>
		<?php echo $this->report['indicators']['key']['dem_female_census']; ?>
	    </td>
	    <td>
		<?php echo $this->report['indicators']['key']['dem_female_suku']; ?>
	    </td>
	</tr>
	<tr>
	    <th>Total Population</th>
	    <td>
		<?php echo $this->report['indicators']['key']['dem_total_census']; ?>
	    </td>
	    <td>
		<?php echo $this->report['indicators']['key']['dem_total_suku']; ?>
	    </td>
	</tr>
	<tr>
	    <th># Households</th>
	    <td>
		<?php echo $this->report['indicators']['key']['dem_hh_census']; ?>
	    </td>
	    <td>
		<?php echo $this->report['indicators']['key']['dem_hh_suku']; ?>
	    </td>
	</tr>
    </tbody>
</table>
 
 <table id="relatorio">
   <thead>
	<tr>
	    <th>Aldeia Name</th>
	    <th>Aldeia Code</th>
	    <th>Total</th>
	    <th># Women</th>
	    <th># Men</th>
	    <th># HHs</th>
	</tr>
    </thead>

    <tbody>
	<?php foreach ( $this->report['villages'] as $village ) : ?>
	    <tr>
		<td><?php echo $village['village']; ?></td>
		<td><?php echo $village['code']; ?></td>
		<td><?php echo $village['total']; ?></td>
		<td><?php echo $village['women']; ?></td>
		<td><?php echo $village['men']; ?></td>
		<td><?php echo $village['hh']; ?></td>
	    </tr>
	<?php endforeach; ?>
    </tbody>
</table>