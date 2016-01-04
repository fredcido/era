<table>
    <tr>
	<td style="width:1%">
	    <img alt="" src="<?php echo BASE; ?>/public/images/segmentation.png" />
	</td>
	<td>
	    <h1><?php echo $this->t( 'Lista treinamento', 366 ); ?> </h1>
	</td>
	<td style="width:1%">
	    <span><?php echo date( 'd/m/Y H:i:s' ); ?></span>
	</td>
    </tr>
</table>

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
	<?php foreach ( $this->data as $dataInicial => $data ) : ?>
	   	
		<?php foreach ( $data['rows'] as $row ) : ?>
	
		     <tr>
			<td rowspan="<?php echo $data['total']; ?>">
			    <?php echo $dataInicial; ?>
			</td>
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
				
			    <?php if ( $key == 0  ) : ?>
				</tr>
			    <?php endif; ?>
			<?php endforeach; ?>
			
		<?php endforeach; ?>
			
	    </tr>
	<?php endforeach; ?>

    </tbody>
</table>