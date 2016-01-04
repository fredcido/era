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
	    <th><?php echo $this->t( 'Turma', 209 ); ?></th>
	    <th><?php echo $this->t( 'Empresas', 295 ); ?></th>
	    <th><?php echo $this->t( 'Empresa', 415 ); ?></th>
	</tr>
    </thead>
    
    <tbody>
	<?php foreach ( $this->report['empresa_treinamento'] as $row ) : ?>
	
	    <tr>
		<td rowspan="<?php echo $row['rows']; ?>"><?php echo $row['district']; ?></td>
		
		<?php 
		    $keyT = 0;
		    foreach ( $row['turmas'] as $turma ) : ?>
		
		    <?php if ( $keyT != 0  ) : ?>
			<tr>
		    <?php endif; ?>
		    
		    <td rowspan="<?php echo count( $turma['enterprises'] ); ?>"><?php echo $turma['turma']; ?></td>
		    <td rowspan="<?php echo count( $turma['enterprises'] ); ?>"><?php echo count( $turma['enterprises'] ); ?></td>
		    
		    <?php 
			$key = 0;
			foreach ( $turma['enterprises'] as $enterprise ) : ?>
		    
			    <?php if ( $key != 0  ) : ?>
				<tr>
			    <?php endif; ?>
				
				<td>
				    <?php echo $enterprise; ?>
				</td>
				
			    </tr>
		    
		    <?php 
			$key++;
			endforeach; 
		    ?>    
		
		<?php 
		    $keyT++;
		    endforeach; 
		?>
	    </tr>
	    
	<?php endforeach; ?>
	    
    </tbody>
</table>