<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/empresa/registro/savecontato/" method="post"  id="form-empresas-contato"
          class="search_form general_form" onsubmit="return saveContato( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_enterprise" id="id_enterprise" type="hidden" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Telefone Eskritoriu', 308 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error phone" id="main_phone" name="main_phone" type="text"
                                               msgError="<?php echo $this->t( 'Telefone Eskritoriu', 308 ); ?>" >
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Telefone Eskritoriu', 308 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Telefone Fax', 309 ); ?>:
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text phone" id="fax_phone" name="fax_phone" type="text"
                                               msgError="<?php echo $this->t( 'Telefone Fax', 309 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Telefone Fax', 309 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Telemovel(1)', 310 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error phone" id="cell_phone1" name="cell_phone1" type="text"
                                               msgError="<?php echo $this->t( 'Telemovel(1)', 310 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Telemovel(1)', 310 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Telemovel(2)', 311 ); ?>:
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text phone" id="cell_phone2" name="cell_phone2" type="text" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Telemovel(2)', 311 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Email', 244 ); ?>:
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text" id="email" name="email" type="text" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Email', 244 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Website', 312 ); ?>:
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text" id="website" name="website" type="text" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Website', 312 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( "Naran Diretor/Na'in", 313 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="owner_name" name="owner_name" type="text"
                                               msgError="<?php echo $this->t( "Naran Diretor/Na'in", 313 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( "Naran Diretor/Na'in", 313 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( "Sekxu Diretor/Na'in" , 314); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" id="owner_gender" name="owner_gender"
                                                msgError="<?php echo $this->t( 'Selecione', 330 ); ?>">
                                            <option value="">Hili ida</option>
                                            <option value="M">Mane</option>
                                            <option value="F">Feto</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t("Sekxu Diretor/Na'in", 314); ?>"></span>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
                    
                    <div class="row">
                        <label> Naran Ema Seluk <br/> Bele Kontaktu: </label>
                        <div class="inputs">
                            <span class="input_wrapper textarea_wrapper">
                                <textarea id="other_contact" class="text" name="other_contact" cols="40" rows="3"></textarea>
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
                
                <?php //if ( !empty( $this->data ) ) : ?>
		    <span class="button blue_button">
			<span><span><?php echo $this->t( 'Voltar', 351 ); ?></span></span>
                        <input name="operacao" type="button" onclick="goToEmpresa( 'geral' );" />
		    </span>
		<?php //endif; ?>
                
	    </div>
            <!--[if !IE]>end row<![endif]-->

        </fieldset>
        <!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    
      $( '#form-empresas-contato' ).populate( <?php echo $this->data; ?> );
        
</script>