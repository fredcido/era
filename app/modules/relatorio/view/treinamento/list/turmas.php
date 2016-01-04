 <h1><?php echo $this->t( 'Resultado Relatorio lista Treinamento', 594 ); ?> </h1>
 
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
	    <th><?php echo $this->t( 'Data Turma', 397 ); ?></th>
	    <th><?php echo $this->t( 'Turma', 209 ); ?></th>
	    <th><?php echo $this->t( 'Curso', 219 ); ?></th>
	    <th><?php echo $this->t( 'Total de Participantes', 398 ); ?></th>
	    <th><?php echo $this->t( 'Treinador Principal', 399 ); ?></th>
	    <th><?php echo $this->t( 'Turma finalizada', 400 ); ?></th>
	    <th><?php echo $this->t( 'Competências', 221 ); ?></th>
	</tr>
    </thead>

    <tbody>
	<?php foreach ( $this->report as $dataInicial => $data ) : ?>
	
		<tr>
		    <td rowspan="<?php echo $data['total']; ?>">
			<?php echo $dataInicial; ?>
		    </td>
			
			<?php 
			    $cont = 0;
			    foreach ( $data['rows'] as $row ) : 
			?>
		    
			    <?php if ( $cont != 0  ) : ?>
				<tr>
			    <?php endif; ?>
	
			    <td rowspan="<?php echo count( $row['units'] ); ?>">
				<?php echo $row['numero_turma']; ?>
			    </td>
			    <td rowspan="<?php echo count( $row['units'] ); ?>">
				<?php echo $row['course']; ?>
			    </td>
			    <td rowspan="<?php echo count( $row['units'] ); ?>">
				<?php echo $row['total_student']; ?>
			    </td>
			    <td rowspan="<?php echo count( $row['units'] ); ?>">
				<?php echo $row['name_trainer']; ?>
			    </td>
			    <td rowspan="<?php echo count( $row['units'] ); ?>">
				<?php echo $row['active'] == 'I' ?  $this->t( 'Sim', 86 ) : $this->t( 'Não', 87 ) ; ?>
			    </td>

			    <?php foreach ( $row['units'] as $key => $unit ) : ?>

				<?php if ( $key != 0  ) : ?>
				    <tr>
				<?php endif; ?>

				    <td>
					<?php echo $unit; ?>
				    </td>

				    </tr>
			    <?php endforeach; ?>
			
			<?php 
			    $cont++;
			    endforeach; 
			?>
			
	    </tr>
	<?php endforeach; ?>

    </tbody>
</table>