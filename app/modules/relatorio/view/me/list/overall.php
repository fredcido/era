 <h1><?php echo $this->t( 'Overall Rankings', 641 ); ?></h1>
 
 
 <div class="container-report">
     <table class="summary">
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
 
 <hr />

<table id="relatorio">
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
	    <td class="<?php echo $this->report['colors']['ranking_health']; ?>">
		<span ></span>
	    </td>
	    <td>
		<?php echo $this->report['data']['ranking_health']; ?>%
	    </td>
	    <td>
		<?php echo $this->report['comments']['health_comment']; ?>
	    </td>
	</tr>
	<tr>
	    <th>Access to Education</th>
	    <td class="<?php echo $this->report['colors']['ranking_education']; ?>"><span ></span></td>
	    <td>
		<?php echo $this->report['data']['ranking_education']; ?>%
	    </td>
	    <td>
		<?php echo $this->report['comments']['education_comment']; ?>
	    </td>
	</tr>
	<tr>
	    <th>Access to Markets</th>
	    <td class="<?php echo $this->report['colors']['ranking_market']; ?>"><span ></span></td>
	    <td>
		<?php echo $this->report['data']['ranking_market']; ?>%
	    </td>
	    <td>
		<?php echo $this->report['comments']['market_comment']; ?>
	    </td>
	</tr>
    </tbody>
</table>