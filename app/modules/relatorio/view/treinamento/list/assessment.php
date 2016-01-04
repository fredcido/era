 <h1><?php echo $this->t( 'Resultado Relatorio Final Assessment', 588 ); ?> </h1>
 
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
	    <th><?php echo $this->t( 'Test Classroom', 589 ); ?></th>
	    <th><?php echo $this->t( 'Practical training', 528 ); ?></th>
	    <th><?php echo $this->t( 'Final score', 516 ); ?></th>
	    <th><?php echo $this->t( 'Class Attendance', 529 ); ?>%</th>
	    <th><?php echo $this->t( 'Field Attendance', 999 ); ?>%</th>
	    <th><?php echo $this->t( 'Resultado', 208 ); ?></th>
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
			    <td><?php echo (float)$dado['test_class']; ?></td>
			    <td><?php echo is_null($dado['practical']) ?  'N/A' : (float)$dado['practical']; ?></td>
			    <td><?php echo (float)$dado['score_final']; ?></td>
			    <td><?php echo is_null($dado['present_percent']) ?  'N/A' : (float)$dado['present_percent'] . '%'; ?></td>
			    <td><?php echo is_null($dado['present_percent_field']) ?  'N/A' : (float)$dado['present_percent_field'] . '%'; ?></td>
			    <td><?php echo $dado['pass']; ?></td>
			
			<?php endforeach; ?>
		    
		    <?php 
			$keyE++;
			endforeach;
		    ?>
		    
		</tr>

	<?php endforeach; ?>

    </tbody>
</table>