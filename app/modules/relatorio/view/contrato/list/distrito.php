 <h1><?php echo $this->t( 'Relatorio Distrito Beneficiario', 664 ); ?> </h1>
 
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
		 <span class="qtde-summary"><?php echo $this->report['total']; ?></span>
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
	    <th><?php echo $this->t( 'Distrito', 96 ); ?></th>
	    <th><?php echo $this->t( 'Homem', 373 ); ?></th>
	    <th><?php echo $this->t( 'Homem', 373 ); ?>(%)</th>
	    <th><?php echo $this->t( 'Mulher', 374 ); ?></th>
	    <th><?php echo $this->t( 'Mulher', 374 ); ?>(%)</th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?>(%)</th>
	</tr>
    </thead>
    
    <tfoot>
	<tr>
	    <th><?php echo $this->t( 'Total geral', 375 ); ?></th>
	    <th><?php echo $this->report['total_homens']; ?></th>
	    <th><?php echo $this->report['total_homens_porcent']; ?>%</th>
	    <th><?php echo $this->report['total_mulheres']; ?></th>
	    <th><?php echo $this->report['total_mulheres_porcent']; ?>%</th>
	    <th><?php echo $this->report['total']; ?></th>
	    <th>100%</th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->report['rows'] as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['distrito']; ?></td>
		<td><?php echo $row['total_homens']; ?></td>
		<td><?php echo $row['total_homens_porcent']; ?>%</td>
		<td><?php echo $row['total_mulheres']; ?></td>
		<td><?php echo $row['total_mulheres_porcent']; ?>%</td>
		<td><b><?php echo $row['total']; ?></b></td>
		<td><b><?php echo $row['total_porcent']; ?>%</b></td>
	    </tr>
	    
	<?php endforeach; ?>
	    
    </tbody>
</table>