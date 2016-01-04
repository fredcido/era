<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/beneficiario/contrato/saveamendment/" method="post" id="form-contrato-amendment"
          class="search_form general_form" onsubmit="return saveAmendment( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>
            <input name="id_contract" id="id_contract" type="hidden"/>
            <input name="contract_value" id="contract_value" type="hidden"/>
            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">
                <div class="abas-form">
                    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3>
			    <?php echo $this->t( 'Total kontrakto', 472 ); ?>
			    U$ <?php echo number_format( (float)$this->totalContrato, 2, '.', ',' ); ?>
			</h3>                        
		    </div>
                    <!--[if !IE]>end row<![endif]-->
                    
                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <b><?php echo $this->t( 'Ita hakarak halo amendment ba saida(?):',0 ); ?> <span>*</span></b>
                        <input name="type_amendment" id="type_amendment" type="radio" checked value="amendment_value"/> <?php echo $this->t( 'Total kontratu', 472 ); ?>
                        <input name="type_amendment" id="type_amendment1" type="radio" value="amendment_date"/> <?php echo $this->t( 'Data remata', 128 ); ?>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
                    
                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <span class="valeuContract">
                                <?php echo $this->t( 'Valor foun', 538 ); ?>
                            </span>
                            <span class="dateContract" style="display: none;">
                                <?php echo $this->t( 'Data Remata', 544); ?>
                            </span>
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <div class="valeuContract">
                                    <li>
                                        <span class="input_wrapper">
                                            <input class="text required tip-error money" id="amendment_value" name="amendment_value" type="text"
                                                   msgError="<?php echo $this->t( 'Ita tenki preense Valor Kontraktu', 537 ); ?>" >
                                        </span>                                 
                                        <span class="tip-form" title="<?php echo $this->t( 'Valor foun', 538 ); ?>"></span>
                                    </li>
                                </div>
                                <div class="dateContract" style="display: none;">
                                    <li>
                                        <span class="input_wrapper">
                                            <input class="text tip-error date-mask" id="amendment_date" name="amendment_date" type="text"
                                                   msgError="<?php echo $this->t( 'Tenki preense Data Remata Foun', 539 ); ?>" >
                                        </span>
                                        <span class="tip-form" title="<?php echo $this->t( 'Data Remata foun', 544 ); ?>"></span>
                                    </li>
                                </div>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Data amendment', 540 ); ?>
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                         <input class="text required tip-error date-mask" id="date_registration" name="date_registration" type="text"
                                                value="<?php echo date("d/m/Y");?>"
                                               msgError="<?php echo $this->t( 'Tenki preense data amendment', 541 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data amendment', 540 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Detallamentu', 542 ); ?>
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <textarea class="textarea required tip-error" id="justification" name="justification" cols="30" rows="5"
                                               msgError="<?php echo $this->t( 'Tenki preense detallamentu', 543 ); ?>" ></textarea>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Detallamentu', 542 ); ?>"></span>
                                </li>                                    
                            </ul>
                        </div>
                    </div>
                    
                </div>
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
                    <div class="module">
                        <!--[if !IE]>start module bottom<![endif]-->
                        <!--<div class="module_bottom">-->
                            <div class="table_wrapper">
                                <div class="table_wrapper_inner">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->t( 'Valor original', 998 ); ?> ($)</th>
                                                <th><?php echo $this->t( 'Valor foun', 998 ); ?> ($)</th>
                                                <th><?php echo $this->t( 'Data foun', 998 ); ?></th>
                                                <th><?php echo $this->t( 'Data amendment', 998 ); ?></th>
                                                <th><?php echo $this->t( 'Detallamentu', 998 ); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="incomes-itens">
                                            <?php 
                                                foreach( $this->amendments as $result ) :
                                            ?>
                                                <tr>
                                                    <td style=" width: 10%;">
                                                        <div class="inputs">
                                                            <label><?php echo number_format( (float)$result->getOriginalValue(), 2, '.', ',' ); ?></label>
                                                        </div>
                                                    </td>
                                                    <td style=" width: 10%;">
                                                        <div class="inputs">
                                                            <label><?php echo number_format( (float)$result->getAmendmentValue(), 2, '.', ',' ); ?></label>
                                                        </div>
                                                    </td>
                                                    <td style=" width: 10%;">
                                                        <div class="inputs">
                                                            <label><?php echo ILO_Util_Geral::dateToBr( $result->getAmendmentDate() ); ?></label>
                                                        </div>
                                                    </td>
                                                    <td style=" width: 10%;">
                                                        <div class="inputs">
                                                            <label><?php echo ILO_Util_Geral::dateToBr( $result->getDateRegistration() ); ?></label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 60px;">
                                                        <div class="inputs" style="word-wrap:break-word; width: 20px;">
                                                            <label><?php echo $result->getJustification(); ?></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php 
                                                endforeach; 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <!--</div>-->
                    </div>
                </div>
                <!--[if !IE]>end module bottom<![endif]-->
            </div>
        </fieldset>
        <!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->
<script type="text/javascript">
    
        <?php if( !empty( $this->data ) ) : ?>
            
            var dataForm = <?php echo $this->data; ?>;
            $( '#form-contrato-amendment' ).populate( dataForm );
	    
        <?php endif; ?>	
        
</script>