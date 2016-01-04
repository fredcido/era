<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Distrito', 96 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	</tr>
    </thead>
    
    <tfoot>
	<tr>
	    <th><?php echo $this->t( 'Total geral', 375 ); ?></th>
	    <th><?php echo $this->report['participantes_distrito']['total']; ?></th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->report['participantes_distrito']['distritos'] as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['distrito']; ?></td>
		<td><b><?php echo $row['total']; ?></b></td>
	    </tr>
	    
	<?php endforeach; ?>
	    
    </tbody>
</table>