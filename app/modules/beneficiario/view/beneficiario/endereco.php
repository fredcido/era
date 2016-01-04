<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/beneficiario/beneficiario/saveendereco/" method="post"  id="form-beneficiario-endereco"
	  class="search_form general_form" onsubmit="return saveEndereco( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_worker" id="id_worker" type="hidden" />
	    <input name="fk_id_add_country" id="fk_id_add_country" type="hidden" value="1" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

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
					<select class="text required tip-error" name="fk_id_add_district" id="fk_id_add_district"
						onChange="carregaCombo( '/beneficiario/beneficiario/subdistritos/id/' + this.value, 'fk_id_add_subdistrict' );"
						msgError="<?php echo $this->t( 'Selecione o distrito', 97 ); ?>" >
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					    
					    <?php foreach ( $this->distritos as $distrito ) : ?>
						<option value="<?php echo $distrito->getIdAddDistrict(); ?>">
						    <?php echo $distrito->getDistrict(); ?>
						</option>
					    <?php endforeach; ?>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Distrito', 96 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Sub-distrito', 98 ); ?>:
					<span>*</span>
				    </label>
				</li>
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
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Aldeia', 102 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text" name="vilage" id="vilage" maxlength="100" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Aldeia', 102 ); ?>"></span>
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
			    <?php echo $this->t( 'Rua', 103 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text" name="street" maxlength="100" id="street" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Rua', 103 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Número', 104 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text" name="number" id="number" maxlength="10" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Número', 104 ); ?>"></span>
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
		</div>
	    </div>
	    <!--[if !IE]>end forms<![endif]-->
	    
	    <!--[if !IE]>start row<![endif]-->
	    <div class="row row-button">
		<?php if ( ILO_Auth_Permissao::has( '/beneficiario/beneficiario/', 'salvar' ) ) : ?>
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
    
    var dataForm = <?php echo $this->data; ?>;
    $( document ).ready(
	function()
	{
	    $( '#form-beneficiario-endereco' ).populate( dataForm  );

	    if ( dataForm.fk_id_add_district ) {

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
	    }
	}
    );
</script>