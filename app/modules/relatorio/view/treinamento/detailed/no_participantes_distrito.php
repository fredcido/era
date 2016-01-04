 <h1><?php echo $this->t( 'Relatorio Numero participante distrito', 584 ); ?> </h1>
 
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
		 <span class="qtde-summary"><?php echo $this->report['participantes_distrito']['total']; ?></span>
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

<?php require_once __DIR__ . '/../body/participantes_distrito.php'; ?>