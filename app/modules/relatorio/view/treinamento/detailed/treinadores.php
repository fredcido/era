 <h1><?php echo $this->t( 'Resultado Treinadores', 0 ); ?> </h1>
 
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
	    <th><?php echo$this->report['total_principal']; ?></th>
	    <th><?php echo$this->report['total_assistente']; ?></th>
	    <th><?php echo$this->report['total']; ?></th>
	    <th>100%</th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->report['rows'] as $row ) : ?>
	
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