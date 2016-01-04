<?php foreach ( $this->pagamentos as $key=> $pagamento ) : ?>
    <tr>
	<td><?php echo ++$key; ?></td>
	<td><?php echo $pagamento->getFkIdWorkerPayment()->getTotalDays(); ?></td>
	<td>U$ <?php echo number_format( $pagamento->getFkIdWorkerPayment()->getSalaryDay(), 2, '.', ',' ); ?></td>
	<td>U$ <?php echo number_format( $pagamento->getFkIdWorkerPayment()->getTotalSalary(), 2, '.', ',' ); ?></td>
	<td><?php echo ILO_Util_Geral::dateToBr( $pagamento->getFkIdWorkerPayment()->getDatePayment() ); ?></td>
	<td>
	    <div class="actions">
		<ul>
		    <li>
			<a onclick='excluiPagamento( <?php echo json_encode( $pagamento->toArray() ); ?>, this );' class="action4" href="javascript:;">4</a>
		    </li>
		</ul>
	    </div>
	</td>
    </tr>
<?php endforeach; ?>