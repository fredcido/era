 <h1><?php echo $this->t( 'Resultado Relatorio Course List', 612 ); ?> </h1>
 
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
	    <th><?php echo $this->t( 'Empresas', 285 ); ?></th>
	    <th colspan="3"><?php echo $this->t( 'Turmas', 558 ); ?></th>
	</tr>
    </thead>

    <tbody>
	<?php 
	    $titles = array( 'S', 'E', 'D' );
	    foreach ( $this->report as $row ) :
	?>
	
		<tr>
		    <td rowspan="<?php echo $row['rows']; ?>"><?php echo $row['empresa']; ?></td>
		    
		    
		    
		    <?php
			$key = 0;
			foreach ( $row['turmas'] as $idturma => $turma ) : 
		    ?>
		    
			<?php $idturma = explode( '_', $idturma ); ?>

			<?php if ( $key != 0 ) : ?>
			    <tr>
			<?php endif; ?>

			<?php foreach ( $titles as $title ) : ?>
			    <th style="text-align: center">
				<?php
				    $numTurma = array( $idturma[0], $idturma[1], $title, $idturma[2] );
				    echo implode( '-', $numTurma );
				?>
			    </th>
			<?php endforeach; ?>

			</tr>

			<?php foreach ( $turma['S'] as $pos => $client ) : ?>
			    <tr>
				<td><?php echo $client; ?></td>
				<td><?php echo $turma['E'][$pos]; ?></td>
				<td><?php echo $turma['D'][$pos]; ?></td>
			    </tr>
			<?php endforeach ;?>

		    <?php 
			$key++;
			endforeach; 
		    ?>

	<?php endforeach; ?>

    </tbody>
</table>