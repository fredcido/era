<table>
    <tr>
	<td style="width:1%">
	    <img alt="" src="<?php echo BASE; ?>/public/images/segmentation.png" />
	</td>
	<td>
	    <h1><?php echo $this->t( 'Setores da empresa', 421 ); ?></h1>
	</td>
	<td style="width:1%">
	    <span><?php echo date( 'd/m/Y H:i:s' ); ?></span>
	</td>
    </tr>
</table>

<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Setor', 74 ); ?></th>
	    <th><?php echo $this->t( 'Quantidade', 413 ); ?></th>
	</tr>
    </thead>
    
    <tbody>
	<?php foreach ( $this->data['rows'] as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['name_sector']; ?></td>
		<td><?php echo $row['total']; ?></td>
	    </tr>
	    
	<?php endforeach; ?>

    </tbody>
</table>