<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/empresa/registro/savetipo/" method="post"  id="form-empresas-tipo"
          class="search_form general_form" onsubmit="return saveTipo( this );">
        <!--[if !IE]>start fieldset<![endif]-->
        <fieldset>

            <input name="id_enterprise" id="id_enterprise" type="hidden" />

            <!--[if !IE]>start forms<![endif]-->
            <div class="forms">

                <div class="abas-form">

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Estrutura Negosiu', 331 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" id="business_structure" name="business_structure"
                                                msgError="<?php echo $this->t( 'Estrutura Negosiu', 331 ); ?>" >
                                            <option value="">Hili ida</option>
                                            <?php foreach( $this->structure as $struture ) : ?>
                                                <option value="<?php echo $struture->getStructure(); ?>"><?php echo $struture->getStructure(); ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Estrutura Negosiu', 331 ); ?>"></span>
                                </li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Sektor', 74 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" id="fk_id_sector" name="fk_id_sector"
                                                msgError="<?php echo $this->t( 'Sektor', 74 ); ?>">
                                            <option value="">Hili ida</option>
                                            <?php foreach( $this->sector as $sector ) :?>
                                            <option value="<?php echo $sector->getIdSector(); ?>"><?php echo $sector->getNameSector(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Sektor', 74 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Sub-Sector', 332 ); ?>:
                            <span>*</span>
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <ul id="sub-sector" class="ul-container"></ul>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Sub-Sector', 332 ); ?>"></span>
                                </li>
                                
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Distritu Operasi', 333 ); ?>:
                                        <span>*</span>
                                    </label>
                                </li>
                                <li>
                                    <span class="input_wrapper">
					<ul class="ul-container" id="distritu-operasi">
                                            <li>
                                                <label for="district_operation_0">
                                                    <input type="checkbox" name="district_operation[]" id="district_operation_0" value="Hotu-Hotu"
                                                           <?php echo in_array( "Hotu-Hotu", (array)$this->operasi ) ? 'checked' : ''; ?> />
                                                    Hotu-Hotu
                                                </label>
                                            </li>
                                            <?php foreach( $this->districts as $district ) : ?>
                                                <li>
                                                    <label for="district_operation_<?php echo $district->getIdAddDistrict()?>">
                                                        <input type="checkbox" name="district_operation[]" id="district_operation_<?php echo $district->getIdAddDistrict()?>" value="<?php echo $district->getDistrict(); ?>"
                                                               <?php echo in_array( $district->getDistrict(), (array)$this->operasi ) ? 'checked' : ''; ?> />
                                                        <?php echo $district->getDistrict(); ?>
                                                    </label>
                                                </li>
                                            <?php endforeach; ?>
					</ul>
				    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Distritu Operasi', 333 ); ?>"></span>
                                </li>            
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->                    

                    <!--[if !IE]>start row<![endif]-->
                    <div class="row">
                        <label>
                            <?php echo $this->t( 'Fatin (CDE) Rejistu', 334 ); ?>:
                            <span>*</span>                            
                        </label>
                        <div class="inputs">
                            <ul>
                                <li>
                                    <span class="input_wrapper">
                                        <select class="text required tip-error" id="fk_id_add_district" name="fk_id_add_district" 
                                                msgError="<?php echo $this->t( 'Fatin (CDE) Rejistu', 334 ); ?>">
                                            <option value="">Hili ida</option>
                                            <?php foreach( $this->districts as $district ) : ?>
                                            <option value="<?php echo $district->getIdAddDistrict()?>"><?php echo $district->getDistrict(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </span>
                                    <span class="tip-form" title="<?php echo $this->t( 'Fatin (CDE) Rejistu', 334 ); ?>"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--[if !IE]>end row<![endif]-->

            </div>
            <!--[if !IE]>end forms<![endif]-->

            <!--[if !IE]>start row<![endif]-->
            <div class="row row-button">
		<?php if ( ILO_Auth_Permissao::has( '/empresa/registro/', 'salvar' ) ) : ?>
		    <span class="button blue_button">
			<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
			<input name="operacao" type="submit" />
		    </span>
		<?php endif; ?>
                <?php //if ( !empty( $this->data ) ) : ?>
                    <span class="button blue_button">
                        <span><span><?php echo $this->t( 'Voltar', 351 ); ?></span></span>
                        <input name="operacao" type="button" onclick="goToEmpresa( 'volume' );" />
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
    
    <?php if( !empty( $this->data ) ) : ?>
    
        var dataForm = <?php echo $this->data; ?>;
        var subsector = <?php echo $this->subsector; ?>;
        var flag = <?php echo $this->flag; ?>;

        $( '#form-empresas-tipo' ).populate( dataForm );

        if ( subsector.length )
            buscaSubSector( subsector );
            
        if( flag )
            checkedAll( $("#district_operation_0") );
	
	if ( !empty( dataForm ) )
	    $( '#fk_id_add_district' ).attr( 'disabled', true );
    
    <?php endif; ?>
      

</script>