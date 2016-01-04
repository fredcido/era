<?php foreach ( $this->experiences as $key=> $experience ) : ?>
    <tr>
	<td><?php echo ++$key; ?></td>
	<td><?php echo $experience->getEnterpriseName(); ?></td>
	<td><?php echo ILO_Util_Geral::dateToBr( $experience->getStartDate() ); ?></td>
	<td><?php echo ILO_Util_Geral::dateToBr( $experience->getFinishDate() ); ?></td>
	<td><?php echo $experience->getPosition(); ?></td>
	<td><?php echo $experience->getJobDescription(); ?></td>
	<td>
	    <div class="actions">
		<ul>
                    <li>
                        <a onclick='editarExperiencia( <?php echo json_encode( $experience->toArray() ); ?> );' class="edit_product" href="javascript:;">Editar</a>
                    </li>
		    <li>
			<a onclick='excluiExperiencia( <?php echo json_encode( $experience->toArray() ); ?>, this );' class="action4" href="javascript:;">4</a>
		    </li>
		</ul>
	    </div>
	</td>
    </tr>
<?php endforeach; ?>