<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form class="search_form general_form" id="form-empresa-clientes">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>
	    
	    <input name="id_enterprise" id="id_enterprise" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Clientes', 323 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Ilha Kliente(?)', 338 ); ?>:
                            <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
                                        <select class="text required tip-error" id="iade_client" name="iade_client"
                                                msgError="<?php echo $this->t( 'Selecione', 330 ); ?>">
                                            <option value="">Hili ida</option>
                                            <option value="S">Sim</option>
                                            <option value="L">Lai</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Ilha Kliente(?)', 338 ); ?>"></span>
				</li>
			    </ul>
			</div>
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
                                    <span class="button blue_button none" id="busca-clientes">
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
			<div id="gridClientes" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagClientes" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<?php if ( ILO_Auth_Permissao::has( '/empresa/registro/', 'salvar' ) ) : ?>
    			<span class="button blue_button" id="add-clientes">
    			    <span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
                            <input name="operacao" type="button" />
    			</span>
			<?php endif; ?>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Clientes Empresa', 324 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div id="gridClientesEmpresa" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagClientesEmpresa" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<span class="button blue_button">
    			    <span><span><?php echo $this->t( 'Avançar', 213 ); ?></span></span>
    			    <input name="operacao" type="button" id="avancar-clientes" />
    			</span>
			
			<?php if ( !empty( $this->data ) && ILO_Auth_Permissao::has( '/empresa/registro/', 'salvar' ) ) : ?>
			    <span class="button green_button">
				<span><span><?php echo $this->t( 'Remover', 214 ); ?></span></span>
				<input name="operacao" type="button" id="remover-clientes" />
			    </span>
			<?php endif; ?>                        
                
                        <?php //if ( !empty( $this->data ) ) : ?>
                            <span class="button blue_button">
                                <span><span><?php echo $this->t( 'Voltar', 351 ); ?></span></span>
                                <input name="operacao" type="button" onclick="goToEmpresa( 'contato' );" />
                            </span>
                        <?php //endif; ?>
			
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
	    $( '#form-empresa-clientes' ).populate( <?php echo $this->data; ?> );
            
            if( $("#iade_client").val() == "S" )
                $("#busca-clientes").removeClass("none");
            else
                $("#busca-clientes").addClass("none");
	    
	    initGridClientes();
	    initGridClientesEmpresa();
	    
	    loadClientesEmpresa();
	}
    )
</script>