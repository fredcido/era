<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/beneficiario/contrato/saveplanejamento/" method="post"  id="form-contrato-planejamento"
          class="search_form general_form" onsubmit="return savePlanejamento( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_contract" id="id_contract" type="hidden" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">

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
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required date-mask tip-error" id="date_finish_planned" name="date_finish_planned" type="text"
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
                            <?php echo $this->t( 'Custo do Trabalhador', 130 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required money tip-error" id="labour_cost_planned" name="labour_cost_planned" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o Custo do Trabalhador', 131 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Custo do Trabalhador', 130 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Traballador hira', 132 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required text-numeric tip-error" id="workers_planned" name="workers_planned" maxlength="5" type="text"
                                               msgError="<?php echo $this->t( 'Preencha Traballador hira', 133 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Traballador hira', 132 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Loron servisu', 134 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required text-numeric tip-error" id="working_day_planned" name="working_day_planned" maxlength="5" type="text"
                                               msgError="<?php echo $this->t( 'Preencha Loron servisu', 135 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Loron servisu', 134 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Kustu Total', 136 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required money tip-error" id="total_cost_planned" name="total_cost_planned" type="text"
                                               msgError="<?php echo $this->t( 'Preencha Kustu Total', 137 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Kustu Total', 136 ); ?>"></span>
                                </li>
                            </ul>
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
    
    $( '#form-contrato-planejamento' ).populate( <?php echo $this->data; ?> );
	
</script>