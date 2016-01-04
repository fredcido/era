<table>
    <tr>
	<td style="width:1%">
	    <img alt="" src="<?php echo BASE; ?>/public/images/segmentation.png" />
	</td>
	<td>
	    <h1><?php echo $this->t( 'Atividades treinadores', 359 ); ?> </h1>
	</td>
	<td style="width:1%">
	    <span><?php echo date( 'd/m/Y H:i:s' ); ?></span>
	</td>
    </tr>
</table>

<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Treinador', 380 ); ?></th>
	    <th><?php echo $this->t( 'Principal', 381 ); ?></th>
	    <th><?php echo $this->t( 'Assistente', 382 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	    <th><?php echo $this->t( 'Porcentagem', 383 ); ?></th>
	</tr>
    </thead>

    <tfoot>
	<tr>
	    <th><?php echo $this->t( 'Total geral', 375 ); ?></th>
	    <th><?php echo$this->data['total_principal']; ?></th>
	    <th><?php echo$this->data['total_assistente']; ?></th>
	    <th><?php echo$this->data['total']; ?></th>
	    <th>100%</th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->data['rows'] as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['treinador']; ?></td>
		<td><?php echo $row['principal']; ?></td>
		<td><?php echo $row['assistente']; ?></td>
		<td><?php echo $row['total']; ?></td>
		<td><?php echo $row['porcentagem']; ?>%</td>
	    </tr>
	    
	<?php endforeach; ?>

    </tbody>
</table>