<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/empresa/registro/saveendereco/" method="post"  id="form-empresas-endereco"
	  class="search_form general_form" onsubmit="return saveEndereco( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="fk_id_enterprise" id="fk_id_enterprise" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

                    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Nasaun', 277 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
                                        <select class="text required tip-error" name="fk_id_add_country" id="fk_id_add_country" disabled=""
						msgError="<?php echo $this->t( 'Selecione', 85 ); ?>" >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					    
					    <?php foreach ( $this->countrys as $country ) : ?>
						<option value="<?php echo $country->getIdAddCountry(); ?>">
						    <?php echo $country->getCountry(); ?>
						</option>
					    <?php endforeach; ?>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Nasaun', 277 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Distrito', 96 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_add_district" id="fk_id_add_district"
						onChange="carregaCombo( '/beneficiario/beneficiario/subdistritos/id/' + this.value, 'fk_id_add_subdistrict' );"
						msgError="<?php echo $this->t( 'Selecione o distrito', 97 ); ?>" >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					    <?php if( !empty($this->distritos) ) : ?>
                                                <?php foreach ( $this->distritos as $distrito ) : ?>
                                                    <option value="<?php echo $distrito->getIdAddDistrict(); ?>">
                                                        <?php echo $distrito->getDistrict(); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Distrito', 96 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->                    
                    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Sub-distrito', 98 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_add_subdistrict" id="fk_id_add_subdistrict"
						onChange="carregaCombo( '/beneficiario/beneficiario/sukus/id/' + this.value, 'fk_id_add_suku' );"
						msgError="<?php echo $this->t( 'Selecione o sub-distrito', 99 ); ?>" disabled >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Sub-distrito', 98 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Suku', 100 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_add_suku" id="fk_id_add_suku"
						msgError="<?php echo $this->t( 'Selecione o sub-distrito', 101 ); ?>" disabled >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Suku', 100 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Vila', 349 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text" name="vilage" id="vilage" maxlength="100" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Vila', 349 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Rua', 103 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text" name="street" maxlength="100" id="street" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Rua', 103 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Número', 104 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text" name="number" id="number" maxlength="10" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Número', 104 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Kodigu Postal', 278 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text" name="postal_code" id="postal_code" maxlength="10" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Kodigu Postal', 278 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Descrição', 105 ); ?>:
			</label>
			<div class="inputs">
			    <span class="input_wrapper" style="width: 90%">
				<input class="text" name="description" maxlength="200" id="description" type="text" />
			    </span>
			    <span class="tip-form" title="<?php echo $this->t( 'Descrição', 105 ); ?>"></span>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->		
                    
                    
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Tipu Enderesu', 350 ); ?>:
                            <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" id="type" name="type"
                                                msgError="<?php echo $this->t( 'Tipu Enderesu', 350 ); ?>" >
                                            <option value="">Hili ida</option>
                                            <option value="PRINCIPAL">Principal</option>
                                            <option value="SEKUNDARIU">Sekundariu</option>
                                        </select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Tipu Enderesu', 350 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
                    
                    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div class="module">
                            <!--[if !IE]>start module top<![endif]-->
                            <div class="module_top">
                                <h5><?php echo $this->t( 'Experiencia', 283 ); ?></h5>
                            </div>
                            <!--[if !IE]>end module top<![endif]-->
                            <!--[if !IE]>start module bottom<![endif]-->
                            <div class="module_bottom">
                                <div class="table_wrapper">
                                    <div class="table_wrapper_inner">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><?php echo $this->t( 'Distrito', 96 ); ?></th>
                                                    <th><?php echo $this->t( 'Sub-distrito', 98 ); ?></th>
                                                    <th><?php echo $this->t( 'Suku', 100 ); ?></th>
                                                    <th><?php echo $this->t( 'Vila', 349 ); ?></th>
                                                    <th><?php echo $this->t( 'Tipu Enderesu', 350 ); ?></th>
                                                    <th style="width: 30px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="lista-enderecos">
                                                <?php require_once dirname( __FILE__ ) . '/listaendereco.php';  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--[if !IE]>end module bottom<![endif]-->
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
                    
		</div>
	    </div>
	    <!--[if !IE]>end forms<![endif]-->
	    
	    <!--[if !IE]>start row<![endif]-->
	    <div class="row row-button">
		<?php if ( ILO_Auth_Permissao::has( '/empresa/registro/', 'salvar' ) ) : ?>
		    <span class="button blue_button">
			<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
			<input name="operacao" type="submit" />
		    </span>
		    <span class="button blue_button">
                        <span><span><?php echo $this->t( 'Voltar', 351 ); ?></span></span>
                        <input name="operacao" type="button" onclick="goToEmpresa( 'tipo' );" />
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
    
var dataForm = <?php echo $this->data; ?>;
    $( document ).ready(
	function()
	{         
            
	    $( '#form-empresas-endereco' ).populate( dataForm  );

	    if ( dataForm.fk_id_add_district ) {

		// Busca district e popula combo
		carregaCombo(
		    '/treinamento/participantes/distritos/idCity/1', 
		    'fk_id_add_district',
		    function()
		    {                        
			$( '#fk_id_add_district' ).val( dataForm.fk_id_add_district );
		    }
		);

		// Busca subdistritos e popula combo
		carregaCombo( 
		    '/beneficiario/beneficiario/subdistritos/id/' + dataForm.fk_id_add_district, 
		    'fk_id_add_subdistrict',
		    function()
		    {
			$( '#fk_id_add_subdistrict' ).val( dataForm.fk_id_add_subdistrict );
		    }
		);
		    
		// Busca sukus e popula combo
		carregaCombo( 
		    '/beneficiario/beneficiario/sukus/id/' + dataForm.fk_id_add_subdistrict, 
		    'fk_id_add_suku',
		    function()
		    {
			$( '#fk_id_add_suku' ).val( dataForm.fk_id_add_suku );
		    }
		);
                    
	    }else            
                carregaCombo( '/treinamento/participantes/distritos/idCity/1', 'fk_id_add_district' );            
            
            $('#fk_id_add_country').val( 1 );
	}
    );

</script>