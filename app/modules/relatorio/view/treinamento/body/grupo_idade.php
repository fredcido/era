<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Grupo de idade', 404 ); ?></th>
	    <th><?php echo $this->t( 'Homem', 373 ); ?></th>
	    <th><?php echo $this->t( 'Homem', 373 ); ?>(%)</th>
	    <th><?php echo $this->t( 'Mulher', 374 ); ?></th>
	    <th><?php echo $this->t( 'Mulher', 374 ); ?>(%)</th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?>(%)</th>
	</tr>
    </thead>
    
    <tfoot>
	<tr>
	    <th><?php echo $this->t( 'Total geral', 375 ); ?></th>
	    <th><?php echo $this->report['grupo_idade']['total_homens']; ?></th>
	    <th><?php echo $this->report['grupo_idade']['total_homens_porcent']; ?>%</th>
	    <th><?php echo $this->report['grupo_idade']['total_mulheres']; ?></th>
	    <th><?php echo $this->report['grupo_idade']['total_mulheres_porcent']; ?>%</th>
	    <th><?php echo $this->report['grupo_idade']['total']; ?></th>
	    <th>100%</th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->report['grupo_idade']['rows'] as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['grupo']; ?></td>
		<td><?php echo $row['total_homens']; ?></td>
		<td><?php echo $row['total_homens_porcent']; ?>%</td>
		<td><?php echo $row['total_mulheres']; ?></td>
		<td><?php echo $row['total_mulheres_porcent']; ?>%</td>
		<td><b><?php echo $row['total']; ?></b></td>
		<td><b><?php echo $row['total_porcent']; ?>%</b></td>
	    </tr>
	    
	<?php endforeach; ?>
	    
    </tbody>
</table>