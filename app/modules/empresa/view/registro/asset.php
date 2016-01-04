<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/empresa/registro/saveasset/" method="post"  id="form-empresas-asset"
          class="search_form general_form" onsubmit="return saveAsset( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_enterprise" id="id_enterprise" type="hidden" />
            <input name="id_asset" id="id_asset" type="hidden" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Equipamento', 596 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error" id="asset_name" name="asset_name" type="text"
                                               msgError="<?php echo $this->t( 'Preencha o nome do equipamento', 597 ); ?>" >
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Nome do equipamento', 598 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Quantidade', 413 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <input class="text required tip-error text-numeric4" id="asset_total" name="asset_total" type="text"
                                               msgError="<?php echo $this->t( 'Preencha a quantidade do equipamento', 413 ); ?>" >
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Quantidade', 413 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                     <div class="row">
                        <label><?php echo $this->t( 'Descrição', 13 ); ?></label>
                        <div class="inputs">
                            <span class="input_wrapper textarea_wrapper">
                                <textarea id="asset_description" class="text" maxlength="500" name="asset_description" cols="40" rows="3"></textarea>
                            </span>
                            <span class="tip-form" title="<?php echo $this->t( 'Descrição', 13 ); ?>"></span>
                        </div>
                    </div>
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<span class="button blue_button">
			    <span><span><?php echo $this->t( 'Voltar', 213 ); ?></span></span>
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
			    <input name="operacao" type="button" onclick="goToEmpresa( 'endereco' );" />
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
			<div id="gridAsset" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagAsset" class="pagingBlock"></div>
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
    
      $( '#form-empresas-asset' ).populate( <?php echo $this->data; ?> );
      
      initGridAsset();
      loadGridAsset();
        
</script>