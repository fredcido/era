<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/treinamento/saveteste/" method="post" id="form-treinamento-teste"
	  class="search_form general_form" onsubmit="return saveTeste( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>
	    
	    <input name="type" id="type" type="hidden" />
	    <input name="fk_id_course" id="fk_id_course" type="hidden" />
	    <input name="fk_id_client" id="fk_id_client" type="hidden" />
	    <input name="id_student_class" id="id_student_class" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Participantes turma', 212 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div id="gridParticipantesTeste" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagParticipantesTeste" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button" id="buttons-test">
			<span class="button gray_button">
    			    <span><span><?php echo $this->t( 'Pos', 259 ); ?></span></span>
    			    <input name="operacao" type="button" onClick="searchTest( 'POS', this );" />
    			</span>
    			<span class="button gray_button">
    			    <span><span><?php echo $this->t( 'Pre', 260 ); ?></span></span>
    			    <input name="operacao" type="button" onClick="searchTest( 'PRE', this );" />
    			</span>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Teste', 262 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Curso', 219 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper large_input">
					<input class="text" name="course" type="text" readOnly id="course" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Curso', 219 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Score', 263 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text" name="score" type="text" readOnly id="score" value="0" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Score', 263 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div class="module">
				<!--[if !IE]>start module top<![endif]-->
				<div class="module_top">
				    <h5><?php echo $this->t( 'Competências', 221 ); ?></h5>
				</div>
				<!--[if !IE]>end module top<![endif]-->
				<!--[if !IE]>start module bottom<![endif]-->
				<div class="module_bottom">
				    <div class="table_wrapper">
					<div class="table_wrapper_inner">
					    <table width="100%" cellspacing="0" cellpadding="0">
						<thead>
						    <tr>
							<th>#</th>
							<th><?php echo $this->t( 'Unidades de compentência', 222 ); ?></th>
							<th style="width: 25%"><?php echo $this->t( 'Score', 263 ); ?></th>
						    </tr>
						</thead>
						<tbody id="lista-competencias">
						</tbody>
					    </table>
					</div>
				    </div>
				</div>
				<!--[if !IE]>end module bottom<![endif]-->
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			
			<span class="button blue_button">
    			    <span><span><?php echo $this->t( 'Avançar', 213 ); ?></span></span>
    			    <input name="operacao" type="button" id="avancar-teste" />
    			</span>
			
			<?php if ( empty( $this->finalizada ) && ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
			    <span class="button green_button">
				<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
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
	    $( '#form-treinamento-teste' ).populate( <?php echo $this->data; ?> );
	    
	    initGridParticipantesTeste();
	    gridParticipantesTeste.parse( <?php echo $this->participantes; ?>, 'json' );
	}
    )
</script>