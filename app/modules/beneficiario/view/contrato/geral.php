<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/beneficiario/contrato/savegeral/" method="post"  id="form-contrato-geral"
          class="search_form general_form" onsubmit="return saveGeral( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_contract" id="id_contract" type="hidden" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">
                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Batch ID', 999 ); ?>:                            
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text" name="batch" id="batch" >
                                            <option value="">Hili ida</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Contract bacth', 999); ?>"></span>
                                </li>                             
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Data Hari', 126 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required date-mask tip-error" id="date_start_planned" name="date_start_planned" type="text"
                                               msgError="<?php echo $this->t( 'Preencha Data Hari', 127 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data Hari', 126 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Data Remata', 128 ); ?>:
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text date-mask tip-error" id="date_finish_planned" name="date_finish_planned" type="text"
                                               msgError="<?php echo $this->t( 'Preencha Data Remata', 129 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data Remata', 128 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
                    
                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Nome do Contratado', 49 ); ?>
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="contractor_name" name="contractor_name" maxlength="200" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o nome', 11 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Nome do Contratado', 49 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Atividade', 112 ); ?>
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" name="activity" id="activity" onchange="setNumActivity(this.value)"
                                                msgError="<?php echo $this->t( 'Atividade', 112 ); ?>" >
                                            <option value="">Hili ida</option>
                                            <option value="RR">Road Reabilitation</option>
                                            <option value="RM">Road Maintenance</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Atividade', 112 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Dalan Naran', 113 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="road_name" name="road_name" maxlength="200" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o Dalan Naram', 114 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Dalan Naran', 113 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Dalan length', 115 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="road_length" name="road_length" maxlength="100" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o Dalan length', 116 ); ?>">
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Dalan length', 115 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Dalan Seksaun', 117 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="road_section" name="road_section" maxlength="200" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o Dalan Seksaun', 118 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Dalan Seksaun', 117 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Seksaun length', 119 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="section_length" name="section_length" maxlength="100" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o Seksaun length', 120 ); ?>">
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Seksaun length', 119 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Valor Original', 546 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error money" id="total_contract" name="total_contract" maxlength="200" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o valor do contrato', 452 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Valor Original', 546 ); ?>"></span>
                                </li>
				<li>
                                    <label><?php echo $this->t('Bank Guarantee Valid Until', 999); ?>:</label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text date-mask" id="bank_valid" name="bank_valid" maxlength="100" type="text">
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t('Bank Guarantee Valid Until', 999 ); ?>"></span>
                                </li>     
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'NITL Valid Until', 999 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text date-mask" id="nitl_valid" name="nitl_valid" maxlength="200" type="text">
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'NITL Valid Until', 999 ); ?>"></span>
                                </li>
				<li>
                                    <label><?php echo $this->t('Signature Date', 999); ?>:</label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text date-mask" id="signature_date" name="signature_date" maxlength="100" type="text">
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t('Signature Date', 999 ); ?>"></span>
                                </li>     
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Distrito', 96 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <select name="fk_id_add_district" class="text required tip-error" id="fk_id_add_district" onchange="carregarSubDistrict(this.value)"
                                               msgError="<?php echo $this->t( 'Escolha o Distrito', 97 ); ?>">
                                                <option value="">Hili ida</option>
                                            <?php foreach( $this->districts as $district ): ?>
                                                <option value="<?php echo $district->getIdAddDistrict(); ?>" ><?php echo $district->getDistrict(); ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Escolha o Distrito', 97 ); ?>"></span>
                                </li>
                                <li>
                                    <label><?php echo $this->t('Ilo Kontratu', 50); ?>:</label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text" id="ilo_contract" name="ilo_contract" maxlength="100" type="text">
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t('Ilo Kontratu', 50); ?>"></span>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Fatin Subdistritu', 121 ); ?>:
                            <span>*</span>
                    </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                            <select name="subdistrict[]" class="text required tip-error" id="subdistrict" multiple="multiple" onchange="carregarFatinSuku()"
                                                       msgError="<?php echo $this->t( 'Escolha o Fatin Subdistritu', 122 ); ?>">
                                            </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Fatin Subdistritu', 121 ); ?>"></span>
                                </li>
                                <li>
                                    <label><?php echo $this->t( 'Fatin Suku', 123 ); ?>:</label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select name="fatin_suku[]" class="text required tip-error" id="fatin_suku" multiple="multiple"
                                               msgError="<?php echo $this->t( 'Escolha o Fatin Suku', 124 ); ?>"></select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Fatin Suku', 123 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>Aumenta <br/> Informasaun:</label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper" style="width: 703px">
                                        <textarea class="textarea" style="width: 700px" id="description" name="description"></textarea>                                        
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t('Aumenta Informasaun', 125); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
                    
                     <!--[if !IE]>start row<![endif]-->
                    <div class="row" id="cod_project">
                        <label>
                            <?php echo $this->t('Project Cod', 38); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <span class="input_wrapper medium_input">
                                <select class="text required" name="num_project" id="num_project" >
                                    <option value="ERA">ERA</option>                                        
                                </select>
                            </span>
                            <span class="input_wrapper medium_input">
                                <select class="text required" name="num_district" id="num_district" >
                                    <option value=""></option>
                                    <?php foreach( $this->districts as $district ): ?>
                                        <option value="<?php echo $district->getIdAddDistrict(); ?>" ><?php echo $district->getAcronym(); ?></option>
                                    <?php endforeach;?>
                                </select>
                            </span>
                            <span class="input_wrapper medium_input">
                                <select class="text required" name="num_activity" id="num_activity" >
                                    <option value=""></option>                                        
                                    <option value="RR">RR</option>                                        
                                    <option value="RM">RM</option>                                        
                                </select>
                            </span>
                            <span class="input_wrapper medium_input">
                                <select class="text required" name="num_year" id="num_year" >
                                    <?php for( $i = 2010; $i <= date('Y'); $i++ ) : ?>
                                    <option value="<?php echo $i;?>" <?php if( $i == date('Y') )  echo 'selected'; ?>><?php echo $i;?></option>
                                    <?php endfor; ?>
                                </select>
                            </span>
                            <span class="tip-form" title="<?php echo $this->t('Número do projeto', 39); ?>"></span>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                </div>

            </div>
            <!--[if !IE]>end forms<![endif]-->

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

        </fieldset>
        <!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    
        <?php if( !empty( $this->data ) ) : ?>
            
            var dataForm = <?php echo $this->data; ?>;
            $( '#form-contrato-geral' ).populate( dataForm );

            $( "#fk_id_add_district" ).attr( 'disabled', true );
            $( "#activity" ).attr( 'disabled', true );
            //$( "#total_contract" ).attr( 'disabled', true );
            $( "#cod_project").hide();
            
            if ( !empty( dataForm.fk_id_add_district ) ) {

                carregarSubDistrict( dataForm.fk_id_add_district, 
                    function()
                    {                        
                         $( '#form-contrato-geral' ).populate( { subdistrict: dataForm.subdistrict }, { resetForm: false } );
                    }
                );
            }

            if ( !empty( dataForm.subdistrict ) ) {
                setTimeout(function(){
                    carregarFatinSuku( dataForm.subdistrict, 
                    function()
                    {
                        $( '#form-contrato-geral' ).populate( { fatin_suku: dataForm.fatin_suku }, { resetForm: false } );
                    }
                );
                }, 300);
                
            }
        
            $( "#num_road" ).attr("disabled",true);
            $( "#num_year" ).attr("disabled",true);
            $( "#num_project" ).attr("disabled",true);
            
        <?php endif; ?>
        
</script>