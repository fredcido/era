<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/participantes/savegeral/" method="post"  id="form-participantes-geral"
          class="search_form general_form" onsubmit="return saveGeral( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_client" id="id_client" type="hidden" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Data Rejistu', 76 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
					<input class="text required date-mask tip-error" name="date_registration" id="date_registration"
                                                   msgError="<?php echo $this->t( 'Preencha a data de registro', 77 ); ?>" type="text" />
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data Rejistu', 76 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Fatin Rekrutamentu', 237 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" name="fk_id_add_district" id="fk_id_add_district"
                                                onchange="setNumClient(this.value)" msgError="<?php echo $this->t( 'Selecione o distrito', 97 ); ?>" >
                                            <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
                                            <?php foreach( $this->districts as $district ): ?>
                                                <option value="<?php echo $district->getIdAddDistrict(); ?>" ><?php echo $district->getDistrict(); ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Fatin Rekrutamentu', 237 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Data Moris', 61 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error date-mask" id="date_birth" name="date_birth" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o Data Moris', 62 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Data Moris', 61 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Naran Primeiru', 56 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="first_name" name="first_name" maxlength="100" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o primeiro nome', 238 ); ?>">
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Naran Primeiru', 56 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Naran Apelidu', 57 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="last_name" name="last_name" maxlength="200" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o sbrenome', 60 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Naran Apelidu', 57 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Fatin Moris', 63 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" name="fk_birth_place" id="fk_birth_place" >
                                            <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
                                            <?php echo $this->_helper->subdistrict(); ?>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Fatin Moris', 63 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Seksu', 69 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" name="gender" id="gender" >
                                            <option value="Mane">Mane</option>
                                            <option value="Feto">Feto</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Escolha o Seksu', 70 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t('Estadu Sivil', 71); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" name="civil_status" id="civil_status" msgError="<?php echo $this->t( 'Estadu Sivil', 71 ); ?>"  >
                                            <option value="">Hili ida</option>
                                            <option value="Divorsio">Divorsio</option>
                                            <option value="Faluk">Faluk</option>
                                            <option value="Kabenain">Kabenain</option>
                                            <option value="Solteiru">Solteiru</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t('Estadu Sivil', 71); ?>"></span>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Okupasaun', 239 ); ?>:
                    </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text" name="occupation" id="occupation" >
                                            <option value="">Hili ida</option>
                                            <option value="La iha servisu">La iha servisu</option>
                                            <option value="Estudante">Estudante</option>
                                            <option value=" Iha servisu">Iha servisu</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Okupasaun', 239 ); ?>"></span>
                                </li>
                                <li>
                                    <label><?php echo $this->t( 'Se Iha Servisu', 240 ); ?>:</label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text" name="have_job" id="have_job" >
                                            <option value="S">Sim</option>
                                            <option value="L">Nao</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Se Iha Servisu', 240 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Telemovel', 241 ); ?>:
                            <span>*</span>
                    </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required phone" id="cell_phone" name="cell_phone" maxlength="15" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o Telemovel', 242 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Telemovel', 241 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Telefone seluk', 243 ); ?>:
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text phone" id="phone" name="phone" maxlength="15" type="text" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Telefone seluk', 243 ); ?>"></span>
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
                                        <input class="text" id="email" name="email" maxlength="200" type="text">
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Email', 244 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Salariu', 245 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required money" id="montly_value" name="montly_value" maxlength="15" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o Salariu', 246 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Salariu', 245 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Salariu ba Tinan ida', 247 ); ?>:
                            <span>*</span>
                    </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required money" id="annual_value" name="annual_value" maxlength="15" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o Salariu ba Tinan ida', 248 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Salariu ba Tinan ida', 247 ); ?>"></span>
                                </li>
                                <li>
                                    <label><?php echo $this->t( 'Numeru Kliente', 249 ); ?>:</label>
                                </li>
                                <li>
                                    <span class="input_wrapper medium_input">
                                        <select class="text" name="num_district" id="num_district" disabled >
                                            <?php foreach( $this->districts as $district ) : ?>
                                            <option value="<?php echo $district->getIdAddDistrict(); ?>" ><?php echo $district->getAcronym(); ?></option>
                                            <?php endforeach;?>  
                                        </select>
                                    </span>
                                    <span class="input_wrapper medium_input">
                                        <input class="text required" name="num_year" disabled id="num_year" />
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Numeru Kliente', 249 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
                    
                    <?php if( $this->incomes ) : ?>
                    
                     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div class="module">
                            <!--[if !IE]>start module bottom<![endif]-->
                            <div class="module_bottom">
                                <div class="table_wrapper">
                                    <div class="table_wrapper_inner">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <thead>
                                                <tr>
                                                    <th><?php echo $this->t( 'Salariu', 998 ); ?></th>
                                                    <th><?php echo $this->t( 'Salariu ba Tinan ida', 998 ); ?></th>
                                                    <th><?php echo $this->t( 'Data', 998 ); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody id="incomes-itens">
                                                <?php 
                                                    foreach( $this->incomes as $salario ) :
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <div class="inputs">
                                                                <label>$ <?php echo number_format( $salario->getMontlyValue(), 2, '.', ',' ); ?></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="inputs">
                                                                <label>$ <?php echo number_format( $salario->getAnnualValue(), 2, '.', ',' ); ?></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="inputs">
                                                                <label><?php echo ILO_Util_Geral::dateTimeToBr( $salario->getIncomeDate() ); ?></label>
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
                            </div>
                            <!--[if !IE]>end module bottom<![endif]-->
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
                    
                    <?php endif;?>

                </div>

            </div>
            <!--[if !IE]>end forms<![endif]-->

            <!--[if !IE]>start row<![endif]-->
            <div class="row row-button">
		<?php if ( ILO_Auth_Permissao::has( '/treinamento/participantes/', 'salvar' ) ) : ?>
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
            $( '#form-participantes-geral' ).populate( dataForm );
            $( "#fk_id_add_district" ).attr("disabled",true);
            $( "#num_year" ).attr("disabled",true);
            $( '#date_registration' ).attr("disabled",true);
        
        <?php endif; ?>
        
        $( '#montly_value' ).blur( calculaSalarioMontly );
        $( '#annual_value' ).blur( calculaSalarioAnnual );
        
</script>