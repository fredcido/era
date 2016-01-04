<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form class="search_form general_form" id="form-treinamento-participantes">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>
	    
	    <input name="total_student" id="total_student" type="hidden" />
	    <input name="id_student_class" id="id_student_class" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Participantes', 211 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Cliente', 255 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper large_input" style="width: 292px !important;">
					<input class="text" name="cli_name" type="text" id="cli_name" />
				    </span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Número Cliente', 256 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper medium_input" style="width: 120px !important;">
					<input class="text" name="cli_num" type="text" id="cli_num" />
				    </span>
				</li>
				<li>
				    <span class="button blue_button" id="busca-participantes">
					<span><span><?php echo $this->t( 'Buscar', 257 ); ?></span></span>
					<input name="operacao" type="button" />
				    </span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div id="gridParticipantes" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagParticipantes" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<?php if ( empty( $this->finalizada ) && ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
    			<span class="button blue_button" id="add-participantes">
    			    <span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
    			    <input name="operacao" type="button" />
    			</span>
			<?php endif; ?>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Participantes turma', 212 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div id="gridTurmaParticipantes" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagTurmaParticipantes" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			
			<span class="button blue_button">
    			    <span><span><?php echo $this->t( 'Avançar', 213 ); ?></span></span>
    			    <input name="operacao" type="button" id="avancar-participantes" />
    			</span>
			
			<?php if ( empty( $this->finalizada ) && ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
			    <span class="button green_button">
				<span><span><?php echo $this->t( 'Remover', 214 ); ?></span></span>
				<input name="operacao" type="button" id="remover-participantes" />
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
	    $( '#form-treinamento-participantes' ).populate( <?php echo $this->data; ?> );
	    
	    initGridParticipantes();
	    initGridTurmaParticipantes();
	    
	    //gridParticipantes.parse( <?php echo $this->participantes; ?>, 'json' );
	    loadParticipantesTurma();
	}
    )
</script>