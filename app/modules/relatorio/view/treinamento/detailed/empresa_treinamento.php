 <h1><?php echo $this->t( 'Relatorio Numero empresa em treinamento', 581 ); ?> </h1>
 
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
		 <label><?php echo $this->t( 'Empresas', 295 ); ?></label>
	     </th>
	     <td>
		 <span class="qtde-summary"><?php echo $this->report['empresas']; ?></span>
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

<?php require_once __DIR__ . '/../body/empresa_treinamento.php'; ?>