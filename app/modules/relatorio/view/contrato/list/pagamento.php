 <h1><?php echo $this->t( 'Resultado Relatorio Pagamento', 667 ); ?> </h1>
 
 <p>
    <?php
	if ( !empty( $this->data['date_start'] ) ) :
	    echo $this->t( 'Periodo', 549 ) . ': ' . $this->data['date_start'] . ' ' . $this->t( 'até', 548 ) . ' ' . $this->data['date_finish'];
	endif;
    ?>
 </p>
 
 <div class="container-report">
     <table class="summary">
	 <tr>
	     <th>
		 <label><?php echo $this->t( 'Data saida de dados', 569 ); ?></label>
	     </th>
	     <td>
		 <span class="qtde-summary"><?php echo date( 'd/m/Y' ); ?></span>
	     </td>
	 </tr>
     </table>
 </div>

<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Project Cod', 38 ); ?></th>
	    <th><?php echo $this->t( 'Beneficiário', 47 ); ?></th>
	    <th><?php echo $this->t( 'Salário do dia', 143 ); ?></th>
	    <th><?php echo $this->t( 'Total de dias', 106 ); ?></th>
	    <th>$<?php echo $this->t( 'Salário total', 145 ); ?></th>
	</tr>
	<tr>
	    <th colspan="3"><?php echo $this->t( 'Total geral', 375 ); ?></th>
	    <th><?php echo $this->report['totals']['days']; ?></th>
	    <th>$<?php echo number_format( $this->report['totals']['valor'], 2, '.', '' ); ?></th>
	</tr>
    </thead>
    
     <tfoot>
	<tr>
	    <th colspan="3"><?php echo $this->t( 'Total geral', 375 ); ?></th>
	    <th><?php echo $this->report['totals']['days']; ?></th>
	    <th>$<?php echo number_format( $this->report['totals']['valor'], 2, '.', '' ); ?></th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->report['rows'] as $row ) : ?>
	   	
		<tr>
		    <td rowspan="<?php echo $row['total']; ?>"><?php echo $row['contrato']->getProjectCode(); ?></td>
		    
		    <?php 
			$keyE = 0;
			foreach ( $row['beneficiarios'] as $beneficiario => $data ) : 
		    ?>
		    
			<?php if ( $keyE != 0  ) : ?>
			    <tr>
			<?php endif; ?>
				
			<td rowspan="<?php echo count( $data ); ?>">
			    <?php echo $beneficiario; ?>
			</td>
			
			<?php foreach ( $data as $key => $dado ) : ?>
			
			    <?php if ( $key != 0  ) : ?>
				<tr>
			    <?php endif; ?>

			    <td>$<?php echo number_format( $dado['salary_day'], 2, '.', '' ); ?></td>
			    <td><?php echo $dado['total_days']; ?></td>
			    <td>$<?php echo number_format( $dado['total_salary'], 2, '.', '' ); ?></td>
			
			<?php endforeach; ?>
		    
		    <?php 
			$keyE++;
			endforeach;
		    ?>
		</tr>
	<?php endforeach; ?>

    </tbody>
</table>