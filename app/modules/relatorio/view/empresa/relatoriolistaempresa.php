<table>
    <tr>
	<td style="width:1%">
	    <img alt="" src="<?php echo BASE; ?>/public/images/segmentation.png" />
	</td>
	<td>
	    <h1><?php echo $this->t( 'Lista empresa', 409 ); ?> </h1>
	</td>
	<td style="width:1%">
	    <span><?php echo date( 'd/m/Y H:i:s' ); ?></span>
	</td>
    </tr>
</table>

<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Data Registro', 414 ); ?></th>
	    <th><?php echo $this->t( 'Empresa', 415 ); ?></th>
	    <th><?php echo $this->t( 'Nome Empresa', 416 ); ?></th>
	    <th><?php echo $this->t( 'Nome Diretor', 417 ); ?></th>
	    <th><?php echo $this->t( 'Telefone', 418 ); ?></th>
	    <th><?php echo $this->t( 'Empresário Cliente IADE', 419 ); ?></th>
	    <th><?php echo $this->t( 'Setor', 74 ); ?></th>
	</tr>
    </thead>

    <tbody>
	<?php foreach ( $this->data as $dataRegistro => $data ) : ?>
	
		<tr>
		   <td rowspan="<?php echo $data['total']; ?>">
		       <?php echo $dataRegistro; ?>
		   </td>

		   <?php
		       $keyE = 0;
		       foreach ( $data['rows'] as $dado ) :
		   ?>
		       <?php if ( $keyE != 0  ) : ?><tr><?php endif; ?>

		       <td rowspan="<?php echo count( $dado['setores'] ); ?>">
			   <?php echo $dado['numero_empresa']; ?>
		       </td>
		       <td rowspan="<?php echo count( $dado['setores'] ); ?>">
			   <?php echo $dado['enterprise_name']; ?>
		       </td>
		       <td rowspan="<?php echo count( $dado['setores'] ); ?>">
			   <?php echo $dado['owner_name']; ?>
		       </td>
		       <td rowspan="<?php echo count( $dado['setores'] ); ?>">
			   <?php echo $dado['main_phone']; ?>
		       </td>
		       <td rowspan="<?php echo count( $dado['setores'] ); ?>">
			   <?php echo $dado['iade_client'] == 'S' ?  $this->t( 'Sim', 86 ) : $this->t( 'Não', 87 ) ; ?>
		       </td>

		       <?php foreach ( $dado['setores'] as $key => $setor ) : ?>

			   <?php if ( $key != 0  ) : ?>
			       <tr>
			   <?php endif; ?>

			       <td>
				   <?php echo $setor; ?>
			       </td>

			   <?php if ( $key == 0  ) : ?>
			       </tr>
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