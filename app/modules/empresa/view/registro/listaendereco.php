<?php foreach ( $this->enderecos as $key => $endereco ) : ?>

    <tr>
	<td><?php echo ++$key; ?></td>
	<td><?php echo $endereco->getFkIdAddDistrict()->getDistrict(); ?></td>
	<td><?php echo $endereco->getFkIdAddSubdistrict()->getSubdistrict(); ?></td>
	<td><?php echo $endereco->getFkIdAddSuku()->getSuku(); ?></td>
	<td><?php echo $endereco->getVilage(); ?></td>
	<td><?php echo $endereco->getType(); ?></td>
	<td>
	    <div class="actions">
		<ul>
		    <li>
			<a onclick='excluiEndereco( <?php echo json_encode( $endereco->toArray() ); ?>, this );' class="action4" href="javascript:;">4</a>
		    </li>
		</ul>
	    </div>
	</td>
    </tr>
<?php endforeach; ?>