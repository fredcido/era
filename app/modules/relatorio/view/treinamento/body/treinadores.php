<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Treinador', 580 ); ?></th>
	    <th><?php echo $this->t( 'Treinador principal', 201 ); ?></th>
	    <th><?php echo $this->t( 'Treinador assistente', 203 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	    <th>%</th>
	</tr>
    </thead>
    
    <tfoot>
	<tr>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	    <th><?php echo $this->report['treinadores']['total_principal']; ?></th>
	    <th><?php echo $this->report['treinadores']['total_assistente']; ?></th>
	    <th><?php echo $this->report['treinadores']['total_geral']; ?></th>
	    <th>100%</th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->report['treinadores']['rows'] as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['treinador']; ?></td>
		<td><b><?php echo $row['total_principal']; ?></b></td>
		<td><b><?php echo $row['total_assistente']; ?></b></td>
		<td><b><?php echo $row['total_geral']; ?></b></td>
		<td><b><?php echo $row['total_percent']; ?>%</b></td>
	    </tr>
	    
	<?php endforeach; ?>
	    
    </tbody>
</table>