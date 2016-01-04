 <h1><?php echo $this->t( 'Resultado Relatorio Participante Pass Rate', 0 ); ?> </h1>
 
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
		 <label><?php echo $this->t( 'Quantidade participantes', 186 ); ?></label>
	     </th>
	     <td>
		 <span class="qtde-summary"><?php echo count( $this->report ); ?></span>
	     </td>
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
	    <th><?php echo $this->t( 'ID Turma', 223 ); ?></th>
	    <th><?php echo $this->t( 'Pass', 585 ); ?></th>
	    <th>%</th>
	    <th><?php echo $this->t( 'Fail', 586 ); ?></th>
	    <th>%</th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	</tr>
    </thead>
    
    <tbody>
	<?php foreach ( $this->report as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['turma']->getNumeroTurma(); ?></td>
		<td><?php echo $row['passed']; ?></td>
		<td><?php echo $row['passed_percent']; ?></td>
		<td><?php echo $row['failed']; ?></td>
		<td><?php echo $row['failed_percent']; ?></td>
		<td><?php echo $row['total']; ?></td>
	    </tr>
	    
	<?php endforeach; ?>
	    
    </tbody>
</table>