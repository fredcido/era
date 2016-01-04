<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form method="post"  id="form-empresas-geral" action="<?php echo BASE; ?>/empresa/registro/savegeral/"
          class="search_form general_form" onsubmit="return saveGeral( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_enterprise" id="id_enterprise" type="hidden" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Ilha Rejistu(?)', 296 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" name="official_registration" id="official_registration"
                                                msgError="<?php echo $this->t( 'Selecione', 330 ); ?>" onchange="setRequired(this.value)" >
                                            <option value="">Hili ida</option>
                                            <option value="S"><?php echo $this->t( 'Sim', 297 ); ?></option>
                                            <option value="L"><?php echo $this->t( 'Lai', 298 ); ?></option>
                                        </select>
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data Rejistu', 76 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Tinan Hari', 299 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" name="start_year" id="start_year"
                                                msgError="<?php echo $this->t( 'Tinan Hari', 299 ); ?>">
                                            <?php for( $i = 2005; $i <= date('Y'); $i++ ) : ?>
                                                <option value="<?php echo $i; ?>" <?php if( $i == date('Y') ) echo 'selected'; ?>><?php echo $i; ?></option>
                                            <?php endfor;?>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Tinan Hari', 299 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Numeru Rejistu(MTCI)', 300 ); ?>:
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text tip-error" id="number_mtci" name="number_mtci" type="text" maxlength="40"
                                               msgError="<?php echo $this->t( 'Numeru Rejistu(MTCI)', 300 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Numeru Rejistu(MTCI)', 300 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Numeru Rejistu(MJ)', 301 ); ?>:
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text tip-error" id="number_mj" name="number_mj" type="text" maxlength="40"
                                               msgError="<?php echo $this->t( 'Numeru Rejistu(MJ)', 301 ); ?>">
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Numeru Rejistu(MJ)', 301 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Data Rejistu(MTCI)', 302 ); ?>:
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text tip-error date-mask" id="date_mcti" name="date_mcti" type="text"
                                               msgError="<?php echo $this->t( 'Data Rejistu(MTCI)', 302 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data Rejistu(MTCI)', 302 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Data Rejistu(MJ)', 303 ); ?>:
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text tip-error date-mask" id="date_mj" name="date_mj" type="text"
                                               msgError="<?php echo $this->t( 'Data Rejistu(MJ)', 303 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data Rejistu(MJ)', 303 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Naran Empreza', 304 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="enterprise_name" name="enterprise_name" type="text" maxlength="200"
                                               msgError="<?php echo $this->t( 'Naran Empreza', 304 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Naran Empreza', 304 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t('Membru CCI-TL(?)', 305); ?>:
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text" name="member_ccitl" id="member_ccitl" >
                                            <option value="">Hili ida</option>
                                            <option value="S"><?php echo $this->t( 'Sim', 297 ); ?></option>
                                            <option value="L"><?php echo $this->t( 'Lai', 298 ); ?></option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t('Membru CCI-TL(?)', 305); ?>"></span>
                                </li>                                
                            </ul>                            
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Asosiasaum saida(?)', 306 ); ?>:
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text" name="association" id="association" >
                                            <option value="">Hili ida</option>
                                            <option value="ACAIT">Associação Comercial Agricola e Industria de Timor Leste</option>
                                            <option value="ACCCTO">Associação Comercial da Comunidade Chinesa Timor Oan</option>
                                            <option value="ABNS">Associação de Barcos Não Solas</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Asosiasaum saida(?)', 306 ); ?>"></span>
                                </li>
                                 <li>
                                    <label>
                                        <?php echo $this->t('Score ba Empreza',0); ?>:
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text tip-error" id="enterprise_score" name="enterprise_score" type="text" maxlength="5"
                                               msgError="<?php echo $this->t( 'Score ba Empreza',0); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Score ba Empreza',0 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
                    
                    <div class="row">
                        <label> Deskrisaum Konaba<br/> Negosiu: </label>
                        <div class="inputs">
                            <span class="input_wrapper textarea_wrapper">
                                <textarea id="description" class="text" maxlength="500" name="description" cols="40" rows="3"></textarea>
                            </span>
                            <span class="tip-form"></span>
                        </div>
                    </div>

            </div>
            <!--[if !IE]>end forms<![endif]-->

            <!--[if !IE]>start row<![endif]-->
            <div class="row row-button">
		<?php if ( ILO_Auth_Permissao::has( '/empresa/registro/', 'salvar' ) ) : ?>
		    <span class="button blue_button">
			<span><span><?php echo $this->t( 'Avançar', 213 ); ?></span></span>
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
            $( '#form-empresas-geral' ).populate( dataForm );
        
        <?php endif; ?>
        
</script>