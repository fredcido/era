 <h1><?php echo $this->t( 'Resultado Relatorio Attendance', 509 ); ?> </h1>
 
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
	    <th rowspan="2"><?php echo $this->t( 'Turma', 223 ); ?></th>
	    <th rowspan="2"><?php echo $this->t( 'Empresa', 273 ); ?></th>
	    <th rowspan="2"><?php echo $this->t( 'Nome Completo', 530 ); ?></th>
	    <th rowspan="2"><?php echo $this->t( 'Sexo', 69 ); ?></th>
	    <th colspan="5">Class Attendance</th>
	    <th colspan="5">Field Attendance</th>
	</tr>
	<tr>
	    <th><?php echo $this->t( 'Sick', 506 ); ?></th>
	    <th><?php echo $this->t( 'Permission', 507 ); ?></th>
	    <th><?php echo $this->t( 'Absence', 508 ); ?></th>
	    <th><?php echo $this->t( 'Present', 509 ); ?></th>
	    <th><?php echo $this->t( 'Present', 510 ); ?></th>
	    <th><?php echo $this->t( 'Sick', 506 ); ?></th>
	    <th><?php echo $this->t( 'Permission', 507 ); ?></th>
	    <th><?php echo $this->t( 'Absence', 508 ); ?></th>
	    <th><?php echo $this->t( 'Present', 509 ); ?></th>
	    <th><?php echo $this->t( 'Present', 510 ); ?></th>
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
			    
			    <?php if ( is_null($dado['sick']) ) : ?>
				<td colspan="5">N/A</td>
			    <?php else : ?>
				<td><?php echo (float)$dado['sick']; ?></td>
				<td><?php echo (float)$dado['permission']; ?></td>
				<td><?php echo (float)$dado['absence']; ?></td>
				<td><?php echo (float)$dado['present']; ?></td>
				<td><?php echo (float)$dado['present_percent']; ?>%</td>
			    <?php endif; ?>
			    
			    <?php if ( is_null($dado['sick_field']) ) : ?>
				<td colspan="5">N/A</td>
			    <?php else : ?>
				<td><?php echo (float)$dado['sick_field']; ?></td>
				<td><?php echo (float)$dado['permission_field']; ?></td>
				<td><?php echo (float)$dado['absence_field']; ?></td>
				<td><?php echo (float)$dado['present_field']; ?></td>
				<td><?php echo (float)$dado['present_percent_field']; ?>%</td>
			    <?php endif; ?>
			
			
			<?php endforeach; ?>
		    
		    <?php 
			$keyE++;
			endforeach;
		    ?>
		</tr>
	<?php endforeach; ?>

    </tbody>
</table>