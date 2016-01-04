<?php $workes = array(); ?>
<?php foreach ( $this->data as $pagamento ) : ?>
    <tr>
        <td>
            <input type="checkbox" value="<?php echo $pagamento['id_worker']; ?>" name="worker[]" id="worker" 
            <?php echo in_array( $pagamento['id_worker'], $workes ) ? "disabled='true'"  : "" ?> />
        </td>
	<td><?php echo $pagamento['name']; ?></td>
	<td><?php echo $pagamento['total_days']; ?></td>
	<td>U$ <?php echo number_format( $pagamento['salary_day'], 2, '.', ',' ); ?></td>
	<td>U$ <?php echo number_format( $pagamento['total_salary'], 2, '.', ',' ); ?></td>
	<td><?php echo ILO_Util_Geral::dateToBr( $pagamento['date_payment'] ); ?></td>
    </tr>
<?php array_push($workes, $pagamento['id_worker']); ?>
<?php endforeach; ?>