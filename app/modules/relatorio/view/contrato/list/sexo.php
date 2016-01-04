<h1><?php echo $this->t( 'Sexo', 69 ); ?> </h1>

<p>
    <?php

	if ( !empty( $this->data['date_start'] ) ) :
	    echo $this->t( 'Periodo', 549 ) . ': ' . $this->data['date_start'] . ' ' . $this->t( 'até', 568 ) . ' ' . $this->data['date_finish'];
	endif;

    ?>
 </p>
 
<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Total Geral', 375 ); ?></th>
	    <th colspan="2"><?php echo $this->report['total']; ?></th>
	</tr>
	<tr>
	    <th><?php echo $this->t( 'Sexo', 69 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	    <th><?php echo $this->t( 'Porcentagem', 383 ); ?></th>
	</tr>
    </thead>

    <tbody>
	<?php foreach ( $this->report['rows'] as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['sexo']; ?></td>
		<td><?php echo $row['total']; ?></td>
		<td><?php echo $row['porcentagem']; ?>%</td>
	    </tr>
	    
	<?php endforeach; ?>
	    
    </tbody>
</table>