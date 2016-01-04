<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/beneficiario/contrato/saveregistro/" method="post" id="form-contrato-registro"
          class="search_form general_form" onsubmit="return saveRegistro( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_contract" id="id_contract" type="hidden" />
            <input name="total_contract" id="total_contract" type="hidden" value="<?php echo $this->totalContrato; ?>" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3>
			    <?php echo $this->t( 'Total contrato', 472 ); ?>
			    U$ <?php echo number_format( (float)$this->totalContrato, 2, '.', ',' ); ?>
			</h3>
                        <div style="float: left;">Rekomenda Advances hira: 
                            <input class="text_small required tip-error money" readonly id="recomendation" name="recomendation" type="text"> %                        
                        </div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Data', 455 ); ?>
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error date-mask" id="date_record" name="date_record" type="text"
                                               msgError="<?php echo $this->t( 'Preencha a data', 473 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data', 455 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Categoria', 457 ); ?>
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" name="category" id="category"
                                                msgError="<?php echo $this->t( 'Selecone a categoria', 474 ); ?>" >
                                            <option value="">Hili ida</option>
                                            <option value="FA"><?php echo $this->t( 'First Advance', 475 ); ?></option>
                                            <option value="WA"><?php echo $this->t( 'Wages', 476 ); ?></option>
                                            <option value="WO"><?php echo $this->t( 'Works', 477 ); ?></option>
                                            <option value="FP"><?php echo $this->t( 'Final Payment', 0 ); ?></option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Categoria', 457 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Origem pagamento', 458 ); ?>
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                     <span class="input_wrapper">
                                        <select class="text required tip-error" name="payment_origin" id="payment_origin"
                                                msgError="<?php echo $this->t( 'Selecione a origem do pagamento', 478 ); ?>" >
                                            <option value="">Hili ida</option>
                                            <option value="DBO">Dom Bosco</option>
                                            <option value="ILO">ILO</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Origem pagamento', 458 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Invoice Amount', 459 ); ?>
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error money" id="invoice_amount" name="invoice_amount" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o invoice amount', 479 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Invoice Amount', 459 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Advances', 462 ); ?> 
                            <span>*</span>
                        </label>
                        
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                         <input class="text_small required tip-error float" id="advances_percent" readonly name="advances_percent" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o advances', 482 ); ?>" >% - 
                                        <input class="text_small required tip-error money-contract" id="advances" name="advances" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o advances', 482 ); ?>" >
                                    </span>
                                    <span class="tip-form" title=" <?php echo $this->t( 'Advances', 462 ); ?> "></span>                                     
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Retention', 463 ); ?>
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text_small required tip-error float" id="retention_percent" readonly name="retention_percent" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o retention', 481 ); ?>" >% - 
                                        <input class="text_small required tip-error money-contract" id="retention" name="retention" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o retention', 481 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Retention', 463 ); ?> "></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Amount', 461 ); ?>
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                     <span class="input_wrapper">
                                        <input class="text required tip-error money-contract" id="amount" name="amount" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o amount', 480 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Amount', 461 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Net Payment', 460 ); ?>
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error money" readonly id="net_payment" name="net_payment" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o net payment', 483 ); ?>" />
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Net Payment', 460 ); ?> (7%)"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Kontraktu Balance', 484 ); ?>
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error money" readonly id="contract_balance" name="contract_balance" type="text"
                                               msgError="<?php echo $this->t( 'Preencha a kontratu balance', 485 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Kontraktu Balance', 484 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Works', 477 ); ?>
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error money-contract" readonly id="works" name="works" type="text"
                                               msgError="" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Preencha works', 456 ); ?>"></span>
                                </li>
                                
                            </ul>
                        </div>                        
                    </div>
                    
                    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Cert. No', 456 ); ?>
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" name="cert_num" id="cert_num"
                                                msgError="<?php echo $this->t( 'Selecione o cert. no', 486 ); ?>" >
                                            <option value="">Hili ida</option>
                                            <?php for ( $i = 0; $i <= 10; $i ++ ) : ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Cert. No', 456 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Other Value', 999 ); ?>
                                    </label>                                    
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text tip-error" name="indicator" id="indicator"
                                                msgError="<?php echo $this->t( 'Hili indikador ida + ka -', 999 ); ?>" >
                                            <option value="+">+ (Adds)</option>
                                            <option value="-">- (Subtracts)</option>
                                        </select>
                                        <input class="text_small money-contract" id="other_value" name="other_value" type="text">
                                    </span>                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <label>Other Justification:</label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper" style="width: 703px">
                                        <textarea class="textarea" style="width: 700px" id="other_justification" name="other_justification"></textarea>                                        
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t('Other Justification', 999); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<?php if ( ILO_Auth_Permissao::has( '/beneficiario/contrato/', 'salvar' ) ) : ?>
			    <span class="button blue_button">
				<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
				<input name="operacao" type="submit" />
			    </span>
			<?php endif; ?>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div class="table_wrapper">
			    <div class="table_wrapper_inner" id="list-registros"></div>
			</div>
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
    
        <?php if( !empty( $this->data ) ) : ?>
            
            var dataForm = <?php echo $this->data; ?>;
            $( '#form-contrato-registro' ).populate( dataForm );
	    
        <?php endif; ?>
	    
	$( document ).ready(
	    function()
	    {
		listContractRecord();
	    }
	);
        
</script>