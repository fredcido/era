<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form class="search_form general_form" id="form-contrato-empresa">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>
	    
	    <input name="id_contract" id="id_contract" type="hidden" />
	    <input name="enterprise" id="enterprise" type="hidden" value="<?php echo $this->empresaContrato; ?>"/>

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Busca empresa / Companhia para o contrato', 440 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Nome empresa', 416 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper large_input" style="width: 292px !important;">
					<input class="text" name="enterprise_name" type="text" id="enterprise_name" />
				    </span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'ID Empresa', 441 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper medium_input" style="width: 120px !important;">
					<input class="text" name="enterprise_id" type="text" id="enterprise_id" />
				    </span>
				</li>
				<li>
				    <span class="button blue_button" id="busca-empresas">
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
			<div id="gridEmpresas" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagEmpresas" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<?php if ( ILO_Auth_Permissao::has( '/beneficiario/contrato/', 'salvar' ) ) : ?>
    			<span class="button blue_button" id="add-empresa">
    			    <span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
    			    <input name="operacao" type="button" />
    			</span>
			<?php endif; ?>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Empresa selecionada', 442 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h4 id="empresa-selecionada">
			    <?php echo $this->empresaContrato; ?>
			</h4>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<?php if ( !empty( $this->empresaContrato ) && ILO_Auth_Permissao::has( '/beneficiario/contrato/', 'salvar' ) ) : ?>
			    <span class="button blue_button" id="remove-empresa">
				<span><span><?php echo $this->t( 'Hamos', 487 ); ?></span></span>
				<input name="operacao" type="button" />
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
	    $( '#form-contrato-empresa' ).populate( <?php echo $this->data; ?> );
	    
	    initGridEmpresas();
	}
    )
</script>