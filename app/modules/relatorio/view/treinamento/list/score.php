 <h1><?php echo $this->t( 'Resultado Relatorio Score Classroom', 592 ); ?> </h1>
 
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
	    <th><?php echo $this->t( 'Empresa', 273 ); ?></th>
	    <th><?php echo $this->t( 'Nome Completo', 530 ); ?></th>
	    <th><?php echo $this->t( 'Sexo', 69 ); ?></th>
	    <th><?php echo $this->t( 'Pre-test', 522 ); ?></th>
	    <th><?php echo $this->t( 'Final test', 523 ); ?></th>
	    <th><?php echo $this->t( 'Understanding', 524 ); ?></th>
	    <th><?php echo $this->t( 'Final Score', 516 ); ?></th>
	</tr>
    </thead>

    <tbody>
	<?php foreach ( $this->report as $row ) : ?>
	   	
		<tr>
		    <td rowspan="<?php echo $row['total']; ?>"><?php echo $row['turma']->getNumeroTurma(); ?></td>
		    
		    <?php 
			$keyE = 0;
			foreach ( $row['empresas'] as $empresa => $data ) : 
		    ?>
		    
			<?php if ( $keyE != 0  ) : ?>
			    <tr>
			<?php endif; ?>
				
			<td rowspan="<?php echo count( $data ); ?>"><?php echo empty( $empresa ) ? '-' : $empresa; ?></td>
			
			<?php foreach ( $data as $key => $dado ) : ?>
			
			    <?php if ( $key != 0  ) : ?>
				<tr>
			    <?php endif; ?>
			
			    <td><?php echo $dado['nome']; ?></td>
			    <td><?php echo $dado['gender']; ?></td>
			    <td><?php echo (float)$dado['pre_test']; ?></td>
			    <td><?php echo (float)$dado['final_test']; ?></td>
			    <td><?php echo is_null($dado['understanding']) ? 'N/A' : (float)$dado['understanding']; ?></td>
			    <td><?php echo (float)$dado['final_score']; ?></td>
			
			
			<?php endforeach; ?>
		    
		    <?php 
			$keyE++;
			endforeach;
		    ?>
		</tr>
	<?php endforeach; ?>

    </tbody>
</table>