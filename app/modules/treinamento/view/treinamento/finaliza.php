<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/treinamento/savefinaliza/" method="post" id="form-treinamento-finaliza"
	  class="search_form general_form" onsubmit="return saveFinaliza( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>
	    
	    <input name="id_student_class" id="id_student_class" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner">
				<table width="100%" cellspacing="0" cellpadding="0">
				    <thead>
					<tr>
					    <th>#</th>
					    <th><?php echo strtoupper( $this->t( 'Critério', 449 ) ); ?></th>
					    <th><?php echo strtoupper( $this->t( 'Status', 22 ) ); ?></th>
					</tr>
				    </thead>
				    <tbody>
					<?php foreach ( $this->criterios['criterios'] as $key => $criterio ) : ?>
					    <tr>
						<td><?php echo ++$key; ?> - </td>
						<td><?php echo $criterio['msg']; ?></td>
						<th>
						    <div class="remata remata-<?php echo $criterio['valid'] ? 'valid' : 'invalid'; ?>"></div>
						</th>
					    </tr>
					<?php endforeach; ?>
				    </tbody>
				</table>
			    </div>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			
			<?php if ( empty( $this->finalizada ) && $this->criterios['valid'] && ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
			    <span class="button green_button">
				<span><span><?php echo $this->t( 'Fechar turma', 450 ); ?></span></span>
				<input name="operacao" type="submit" />
			    </span>
			<?php endif; ?>
			
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		</div>
	    </div>
	    <!--[if !IE]>end forms<![endif]-->

	</fieldset>
	<!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    $( '#form-treinamento-finaliza' ).populate( <?php echo $this->data; ?> );
	}
    )
</script>