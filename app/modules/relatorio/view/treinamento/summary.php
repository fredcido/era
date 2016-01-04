<?php require_once 'body/control-bar.php'; ?>

<h1><?php echo $this->t( 'Summary treinamento', 567 ); ?> </h1>
 
 <p>
    <?php 

	if ( !empty( $this->data['date_start'] ) ) :
	    echo $this->t( 'Periodo', 549 ) . ': ' . $this->data['date_start'] . ' ' . $this->t( 'até', 548 ) . ' ' . $this->data['date_finish'];
	endif;

    ?>
 </p>
 
 <p>
     <?php echo $this->t( 'Data saida de dados', 569 ) . ': ' . date( 'd/m/Y' ); ?>
 </p>
 
 <p>
     <?php
	if ( count( $this->report['turmas'] ) == 1 ) :
	    echo $this->t( 'Turma', 209 ) . ': ' . $this->report['turmas'][0]->getNumeroTurma();
	endif;
     ?>
 </p>
 
 <div class="container-report">
     
     <table class="summary">
	 <tr>
	     <th>
		 <label>
		    <?php echo $this->t( 'Turmas', 558 ); ?>
		</label>
	     </th>
	     <td>
		 <span class="qtde-summary">
		    <?php echo count( $this->report['turmas'] ); ?>
		</span>
	     </td>
	 </tr>
	 <?php if ( array_key_exists( 'no_participantes', $this->report ) ) : ?>
	    <tr>
		<th>
		   <label>
		       <?php echo $this->t( 'Quantidade participantes', 186 ); ?>
		   </label>
		</th>
		<td>
		   <span class="qtde-summary">
		       <?php echo $this->report['no_participantes']; ?>
		   </span>
		</td>
	    </tr>
	 <?php endif; ?>
	    
	<?php if ( array_key_exists( 'sexo', $this->report ) ) : ?>
	    
	    <tr>
		<th>
		    <label>
			<?php echo $this->t( 'Mulheres', 183 ); ?>
		    </label>
		</th>
		<td>
		    <span class="qtde-summary">
			<?php echo $this->report['sexo']['qtd_mulheres']; ?>
		    </span>
		</td>
		<th>
		    <label>
			% <?php echo $this->t( 'Mulheres', 183 ); ?>
		    </label>
		</th>
		<td>
		    <span class="qtde-summary">
			<?php echo $this->report['sexo']['qtd_mulheres_percent']; ?>%
		    </span>
		</td>
	    </tr>
	    
	     <tr>
		<th>
		    <label>
			<?php echo $this->t( 'Homens', 180 ); ?>
		    </label>
		</th>
		<td>
		    <span class="qtde-summary">
			<?php echo $this->report['sexo']['qtd_homens']; ?>
		    </span>
		</td>
		<th>
		    <label>
			% <?php echo $this->t( 'Homens', 180 ); ?>
		    </label>
		</th>
		<td>
		    <span class="qtde-summary">
			<?php echo $this->report['sexo']['qtd_homens_percent']; ?>%
		    </span>
		</td>
	    </tr>

	<?php endif; ?>
	    
	<?php if ( array_key_exists( 'pass_rate', $this->report ) ) : ?>
	    
	    <tr>
		<th>
		    <label>
			<?php echo $this->t( 'Quantidade aprovados', 571 ); ?>
		    </label>
		</th>
		<td>
		    <span class="qtde-summary">
			<?php echo $this->report['pass_rate']['passed']; ?>
		    </span>
		</td>
		<th>
		    <label>
			% <?php echo $this->t( 'Aprovados', 572 ); ?>
		    </label>
		</th>
		<td>
		    <span class="qtde-summary">
			<?php echo $this->report['pass_rate']['passed_percent']; ?>%
		    </span>
		</td>
	    </tr>
	    
	     <tr>
		<th>
		    <label>
			<?php echo $this->t( 'Quantidade reprovados', 573 ); ?>
		    </label>
		</th>
		<td>
		    <span class="qtde-summary">
			<?php echo $this->report['pass_rate']['failed']; ?>
		    </span>
		</td>
		<th>
		    <label>
			% <?php echo $this->t( 'Reprovados', 574 ); ?>
		    </label>
		</th>
		<td>
		    <span class="qtde-summary">
			<?php echo $this->report['pass_rate']['failed_percent']; ?>%
		    </span>
		</td>
	    </tr>
	    
	<?php endif; ?>
     </table>

     
     <?php if ( array_key_exists( 'grupo_idade', $this->report ) ) : ?>
     
	<h3><?php echo $this->t( 'Grupo idade', 404 ); ?></h3>
	
	<?php require_once 'body/grupo_idade.php' ?>
	
     <?php endif; ?>
	
	
    <?php if ( array_key_exists( 'participantes_distrito', $this->report ) ) : ?>
     
	<h3><?php echo $this->t( 'No participantes por distrito', 401 ); ?></h3>
	
	<?php require_once 'body/participantes_distrito.php' ?>
	
     <?php endif; ?>
	
	
    <?php if ( array_key_exists( 'empresa_treinamento', $this->report ) ) : ?>
     
	<h3><?php echo $this->t( 'Empresa em treinamentos', 556 ); ?></h3>
	
	<?php require_once 'body/empresa_treinamento.php' ?>
	
     <?php endif; ?>
	
    <?php if ( array_key_exists( 'treinadores', $this->report ) ) : ?>
     
	<h3> <?php echo $this->t( 'Treinadores', 554 ); ?></h3>
	
	<?php require_once 'body/treinadores.php' ?>
	
     <?php endif; ?>
     
 </div>
 
 <?php require_once 'footer_report.php'; ?>