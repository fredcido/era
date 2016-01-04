<div class="container-report">
     
    <table class="summary">
	<tr>
	    <th>
		<label><?php echo $this->t( 'Distrito', 96 ); ?>:</label>
	    </th>
	    <td>
		<?php echo $this->snapshot->getFkIdAddDistrict()->getDistrict(); ?>
	    </td>
	    <th>
		<label><?php echo $this->t( 'Sub-distrito', 98 ); ?>:</label>
	    </th>
	    <td>
		<?php echo $this->snapshot->getFkIdAddSubdistrict()->getSubdistrict(); ?>
	    </td>
	</tr>
	<tr>
	    <th>
		<label><?php echo $this->t( 'Suku', 100 ); ?>:</label>
	    </th>
	    <td>
		<?php echo $this->snapshot->getFkIdAddSuku()->getSuku(); ?>
	    </td>
	    <th>
		<label><?php echo $this->t( 'Reference', 621 ); ?>:</label>
	    </th>
	    <td>
		<?php echo $this->snapshot->getReference() == 0 ? 'Baseline' : 'Endline'; ?>
	    </td>
	</tr>
	<tr>
	    <th>
		<label><?php echo $this->t( 'Road location', 626 ); ?>:</label>
	    </th>
	    <td>
		<?php echo $this->snapshot->getRoadLocation(); ?>
	    </td>
	    <th>
		<label><?php echo $this->t( 'Code', 628 ); ?>:</label>
	    </th>
	    <td>
		<?php echo $this->snapshot->getCode(); ?>
	    </td>
	</tr>
    </table>

 </div>