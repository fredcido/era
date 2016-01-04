<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/empresa/registro/savevolume/" method="post"  id="form-empresas-volume"
          class="search_form general_form" onsubmit="return saveVolume( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_enterprise" id="id_enterprise" type="hidden" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Traballador Feto', 317 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error text-numeric4" id="staff_woman" name="staff_woman" type="text"
                                               msgError="<?php echo $this->t( 'Traballador Feto', 317 ); ?>" >
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Traballador Feto', 317 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Traballador Mane', 318 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error text-numeric4" id="staff_man" name="staff_man" type="text"
                                               msgError="<?php echo $this->t( 'Traballador Mane', 318 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Traballador Mane', 318 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Total Traballador', 319 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="staff_total" name="staff_total" type="text" readonly="true"
                                               msgError="<?php echo $this->t( 'Total Traballador', 319 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Total Traballador', 319 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Volume Negosiu', 320 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" id="size_business" name="size_business"
                                                msgError="<?php echo $this->t( 'Volume Negosiu', 320 ); ?>" >
                                            <option value="">Hili ida</option>
                                            <option value="MIKRO(Traballador 1)">MIKRO(Traballador 1)</option>
                                            <option value="KIIK(Traballador 2 - 10)">KIIK(Traballador 2 - 10)</option>
                                            <option value="MEDIO(Traballador 11-50)">MEDIO(Traballador 11-50)</option>
                                            <option value="BO'OT (+51)">BO'OT (+51)</option>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Volume Negosiu', 320 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->
                    
                    <div class="row">
                        <label><?php echo $this->t( 'Volume Vendas', 343 ); ?>: </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper tipo_volume">
                                        <select class="text" id="tipo_volume" name="tipo_volume" onchange="tipoVolume(this.value)">
                                           <option value="">Hili ida</option>
                                            <option value="F">Fulan</option>
                                            <option value="T">Tinan</option>
                                        </select>
                                    </span>
                                    <span class="input_wrapper  sales">
                                        <input class="text money" id="sales_monthly" name="sales_monthly" type="text" readonly="true" >
                                    </span>
                                    <span class="input_wrapper  sales">                                        
                                        <input class="text money" id="sales_annual" name="sales_annual" type="text" readonly="true"  >
                                    </span>
                                    <span class="tip-form"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Volume Vendas', 343 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div id="gridVolumeVendas" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagVolumeVendas" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

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
                        <input name="operacao" type="button" onclick="goToEmpresa( 'clientes' );" />
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
    
      $( '#form-empresas-volume' ).populate( <?php echo $this->data; ?> );
      
      $( '#staff_woman, #staff_man' ).change( calculaTotalTrabalhador );
      
      initGridVolumeVendas();
      loadVolumeVendas();
        
</script>