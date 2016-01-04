<div id="busca-beneficiario">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
	<span class="title_wrapper_top"></span>
	<div class="title_wrapper_inner">
	    <span class="title_wrapper_middle"></span>
	    <div class="title_wrapper_content">
		<h2>
		    <?php echo $this->t( 'Busca beneficiário', 112 ); ?> 
		</h2>

	    </div>
	</div>
	<span class="title_wrapper_bottom"></span>
    </div>
    <!--[if !IE]>end title wrapper<![endif]-->

    <!--[if !IE]>start section content<![endif]-->
    <div class="section_content">
	<span class="section_content_top"></span>

	<div class="section_content_inner">

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms_wrapper">
		<form action="<?php echo BASE; ?>/beneficiario/beneficiario/listabeneficiario/" method="post"  id="form-module"
		    class="search_form general_form" onsubmit="return buscaBeneficiarios( this );">

			<!--[if !IE]>start forms<![endif]-->
			<div class="forms">

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Primeiro nome', 56 ); ?>:
				</label>
				<div class="inputs">
				    <ul>
					<li>
					    <span class="input_wrapper">
						<input class="text" name="first_name" id="first_name" maxlength="100" type="text" />
					    </span>
					</li>
					<li>
					    <label>
						<?php echo $this->t( 'Sobrenome', 57 ); ?>:
					    </label>
					</li>
					<li>
					    <span class="input_wrapper">
						<input class="text" name="last_name" maxlength="200" id="last_name" type="text" />
					    </span>
					</li>
				    </ul>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

			    <!--[if !IE]>start row<![endif]-->
			    <div class="row">
				<label>
				    <?php echo $this->t( 'Número beneficiário', 55 ); ?>:
				</label>
				<div class="inputs">
				    <ul>
					<li>
					    <span class="input_wrapper">
						<input class="text" name="cod_beneficiario" id="cod_beneficiario" type="text" />
					    </span>
					</li>
					<li></li>
					<li id="button">
					    <span class="button green_button">
						<span><span><?php echo $this->t( 'Buscar', 141 ); ?></span></span>
						<input name="operacao" type="submit" />
					    </span>
					    <span class="button gray_button">
						<span><span><?php echo $this->t( 'Limpar', 16 ); ?></span></span>
						<input name="operacao" type="reset" />
					    </span>
					</li>
				    </ul>
				</div>
			    </div>
			    <!--[if !IE]>end row<![endif]-->

			    <!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <div class="module">
				<div id="gridBeneficiario" class="gridTela"></div>
				<div id="divPagBeneficiario" class="pagingBlock"></div>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->

			</div>
			<!--[if !IE]>end forms<![endif]-->
		</form>
	    </div>
	    <!--[if !IE]>end forms<![endif]-->

	    <!--[if !IE]>start section sidebar<![endif]-->


	</div>

	<span class="section_content_bottom"></span>
    </div>
    <!--[if !IE]>end section content<![endif]-->
</div>

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    initGridBeneficiario();
	    gridBeneficiario.setColWidth( 2, '200' );
	    gridBeneficiario.attachEvent( 'onRowDblClicked', 
		function( id )
		{
		    var worker = eval( '(' + id + ')' );
		    
		    $( '#form-beneficiario-geral' ).populate( worker, { resetForm: false } );
		    $( '#fk_id_add_subdistrict' ).attr( 'disabled', true );
		    $( '#date_registration' ).attr( 'readonly', true );
	    
		    $.fancybox.close();
		}
	    );
	}
    );
</script>