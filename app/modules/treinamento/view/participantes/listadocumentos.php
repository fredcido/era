<?php foreach ( $this->documentos as $key => $documento ) : ?>
    <tr>
        <td><?php echo ++$key; ?></td>
	<td><?php echo $documento->getFkIdDocument()->getFkIdTypeDocument()->getTypeDocument(); ?></td>
	<td><?php echo $documento->getFkIdDocument()->getNumberDoc(); ?></td>
	<td><?php echo $documento->getFkIdDocument()->getFkIdAddDistrict()->getDistrict(); ?></td>
	<td><?php echo ILO_Util_Geral::dateToBr( $documento->getFkIdDocument()->getIssueDate() ); ?></td>
        <td>
	    <div class="actions">
		<ul>
		    <li>
			<a onclick='excluiDocumento( <?php echo json_encode( $documento->toArray() ); ?>, this );' class="action4" href="javascript:;">4</a>
		    </li>
		</ul>
	    </div>
	</td>
    </tr>

<?php endforeach; ?>