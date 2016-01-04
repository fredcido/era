<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/empresa/registro/savepreviouscontract/" method="post"  id="form-empresas-previous-contract"
          class="search_form general_form" onsubmit="return savePreviousContract( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_enterprise" id="id_enterprise" type="hidden" />
            <input name="id_previous_contract" id="id_previous_contract" type="hidden" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">

                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Tipo de contrato', 603 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="contract_type" name="contract_type" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o tipo de contrato', 604 ); ?>" >
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Tipo de contrato', 603 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Total contrato', 605 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error money" id="total_contract" name="total_contract" type="text"
                                               msgError="<?php echo $this->t( 'Total contrato', 606 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Total contrato', 605 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
		    
		    <div class="row">
                        <label>
                            <?php echo $this->t( 'Cliente', 255 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="contract_client" name="contract_client" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o nome do cliente', 607 ); ?>" >
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Cliente', 255 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Período', 608 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper short_input" style="width: 83px !important">
					<input class="text required tip-error date-mask" name="start_date" type="text" id="start_date"
					       msgError="<?php echo $this->t( 'Preencha a data inicial', 175 ); ?>" />
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data inicial', 174 ); ?>"></span>
				</li>
				<li>
				    <?php echo $this->t( 'até', 568 ); ?>
				</li>
				<li>
                                    <span class="input_wrapper medium_input" style="width: 83px !important">
					<input class="text required tip-error date-mask" name="finish_date" type="text" id="finish_date"
					        msgError="<?php echo $this->t( 'Preencha a data final', 178 ); ?>"/>
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data final', 550 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
             
		    <div class="row row-button">
			<span class="button blue_button">
			    <span><span><?php echo $this->t( 'Avançar', 213 ); ?></span></span>
			    <input name="operacao" type="button" onclick="goToEmpresa( 'contratos' );" />
			</span>
			<?php if ( ILO_Auth_Permissao::has( '/empresa/registro/', 'salvar' ) ) : ?>
			    <span class="button blue_button">
				<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
				<input name="operacao" type="submit" />
			    </span>
			<?php endif; ?>
			<span class="button blue_button">
			    <span><span><?php echo $this->t( 'Voltar', 351 ); ?></span></span>
			    <input name="operacao" type="button" onclick="goToEmpresa( 'asset' );" />
			</span>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
                    
		    <div class="row">
			<h3><?php echo $this->t( 'Lista de Equipamentos', 599 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div id="gridPreviousContract" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagPreviousContract" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

            </div>
            <!--[if !IE]>end forms<![endif]-->

        </fieldset>
        <!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    
      $( '#form-empresas-previous-contract' ).populate( <?php echo $this->data; ?> );
      
      initGridPreviousContract();
      loadGridPreviousContract();
        
</script>