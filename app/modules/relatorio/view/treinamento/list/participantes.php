 <h1><?php echo $this->t( 'Resultado Relatorio Participantes', 591 ); ?> </h1>
 
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
	    <th><?php echo $this->t( 'Turma', 223 ); ?></th>
	    <th><?php echo $this->t( 'Nome Completo', 530 ); ?></th>
	    <th><?php echo $this->t( 'Sexo', 69 ); ?></th>
	</tr>
    </thead>

    <tbody>
	<?php foreach ( $this->report as $row ) : ?>
	   	
		<tr>
		    <td rowspan="<?php echo count( $row['participantes'] ); ?>">
			<?php echo $row['turma']->getNumeroTurma(); ?>
		    </td>
		    
		    <?php foreach ( $row['participantes'] as $key => $data ) : ?>
		    
			<?php if ( $key != 0 ) : ?>
			    <tr>
			<?php endif; ?>
		    
			    <td><?php echo $data['nome']; ?></td>
			    <td><?php echo $data['gender']; ?></td>
			</tr>
			
		    <?php endforeach; ?>
	<?php endforeach; ?>

    </tbody>
</table>