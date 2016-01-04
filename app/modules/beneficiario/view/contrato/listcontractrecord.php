<?php // var_dump($this->registros);
//die();
?>
<table cellspacing="0" cellpadding="0">
    <thead>
	<tr>
	    <th colspan="2" style="text-align: center"><?php echo $this->t( 'Referência', 453 ); ?></th>
	    <th>&nbsp;</th>
	    <th>&nbsp;</th>
	    <th colspan="6" style="text-align: center"><?php echo $this->t( 'Progress payment', 454 ); ?></th>
	    <th>&nbsp;</th>
	    <th>&nbsp;</th>
	</tr>
	<tr>
	    <th><?php echo $this->t( 'Data', 455 ); ?></th>
	    <th><?php echo $this->t( 'Cert. No', 456 ); ?></th>
	    <th><?php echo $this->t( 'Categoria', 457 ); ?></th>
	    <th><?php echo $this->t( 'Origem pagamento', 458 ); ?></th>
	    <th><?php echo $this->t( 'Invoice amount', 459 ); ?></th>
	    <th><?php echo $this->t( 'Net Payment', 460 ); ?></th>
	    <th><?php echo $this->t( 'Invoice Amount', 461 ); ?></th>
	    <th><?php echo $this->t( 'Advances', 462 ); ?></th>
	    <th><?php echo $this->t( 'Retention', 463 ); ?></th>
	    <th><?php echo $this->t( 'Contract balance', 464 ); ?></th>
	    <th><?php echo $this->t( 'Finan. % Compl.', 465 ); ?></th>
	    <th><?php echo $this->t( 'Delete', 999 ); ?></th>
	</tr>
    </thead>
    <tfoot>
	<tr>
	    <th colspan="4" rowspan="2"><?php echo $this->t( 'Total', 19 ); ?></th>
	    <th><?php echo $this->t( 'Invoices', 466 ); ?></th>
	    <th><?php echo $this->t( 'Net Pays', 467 ); ?></th>
	    <th><?php echo $this->t( 'Progress Pay', 468 ); ?></th>
	    <th><?php echo $this->t( 'Advances', 462 ); ?></th>
	    <th><?php echo $this->t( 'Retentions', 469 ); ?></th>
	    <th><?php echo $this->t( 'Balances', 470 ); ?></th>
	    <th><?php echo $this->t( '% Compl.', 471 ); ?></th>
            <th>&nbsp;</th>
	</tr>
	<tr>
	    <th><?php echo $this->registros['invoices']; ?></th>
	    <th><?php echo $this->registros['net_pays']; ?></th>
	    <th><?php echo $this->registros['progress_pay']; ?></th>
	    <th><?php echo $this->registros['advances']; ?></th>
	    <th><?php echo $this->registros['retentions']; ?></th>
	    <th><?php echo $this->registros['balances']; ?></th>
	    <th><?php echo $this->registros['compl']; ?>%</th>
            <th>&nbsp;</th>
	</tr>
    </tfoot>
    <tbody>
	<?php foreach ( $this->registros['rows'] as $registro ) : ?>
	    <tr>
		<td><?php echo $registro['date_record']; ?></td>
		<td><?php echo $registro['cert_num']; ?></td>
		<td>
                    <?php 
                        if ( (($registro['category'] == 'Wages') or ($registro['category'] == 'Final Payment')) && ($registro['other_value'] != null) ){
                            ?><a href="javascript:;" class="tip_left" title="<?php echo $registro['other_justification']; ?>"><?php echo $registro['category'];?></a>
                            <?php
                        }else{
                            echo $registro['category']; 
                        }
                        
                    ?>
                </td>
		<td><?php echo $registro['payment_origin']; ?></td>
		<td><?php echo $registro['invoice_amount']; ?></td>
		<td><?php echo $registro['net_payment']; ?></td>
		<td><?php echo $registro['amount']; ?></td>
		<td><?php echo $registro['advances']; ?></td>
		<td><?php echo $registro['retention']; ?></td>
		<td><?php echo $registro['contract_balance']; ?></td>
		<td><?php echo $registro['finan_compl']; ?>%</td>
                <td>
                    <a href="javascript:;" class="" onclick="deleteRecord(<?php echo $registro['id_relationship']; ?>)">
                        Delete
                    </a>
                </td>
	    </tr>
	<?php endforeach; ?>
    </tbody>
</table>