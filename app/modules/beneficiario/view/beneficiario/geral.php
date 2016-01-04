<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/beneficiario/beneficiario/savegeral/" method="post"  id="form-beneficiario-geral"
	  class="search_form general_form" onsubmit="return saveGeral( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_worker" id="id_worker" type="hidden" />
	    <input name="fk_id_contract" id="fk_id_contract" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Project Code', 38 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text" name="project_code" id="project_code" disabled type="text">
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Número do projeto', 39 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Número beneficiário', 55 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text" disabled name="cod_beneficiario" id="cod_beneficiario" type="text" />
				    </span>
				    <a id="ico-busca-beneficiario" href="<?php echo BASE; ?>/beneficiario/beneficiario/buscabeneficiario/" class="fancybox">
					<span class="tip-form ico-search" title="<?php echo $this->t( 'Número beneficiário', 55 ); ?>"></span>
				    </a>
				    <span class="tip-form" title="<?php echo $this->t( 'Número beneficiário', 55 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Primeiro nome', 56 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error" name="first_name" msgError="<?php echo $this->t( 'Preencha o nome', 11 ); ?>" id="first_name" maxlength="100" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Primeiro nome do beneficiário', 58 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Sobrenome', 57 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error" name="last_name" 
					       msgError="<?php echo $this->t( 'Preencha o sobrenome', 60 ); ?>" maxlength="200" id="last_name" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Sobrenome do beneficiário', 59 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Data de nascimento', 61 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text date-mask required tip-error" name="date_birth" id="date_birth"
					       onChange="calculaIdade();"
					       msgError="<?php echo $this->t( 'Preencha a data de nascimento', 62 ); ?>"  type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Data de nascimento', 61 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Local de nascimento', 63 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_add_subdistrict"  onChange="montaNumeroBenef();"
						msgError="<?php echo $this->t( 'Preencha o local de nascimento', 64 ); ?>" id="fk_id_add_subdistrict">
                                            <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					    
                                            <?php echo $this->_helper->subdistrict(); ?>
						
                                        </select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Local de nascimento', 63 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Idade', 65 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text" readOnly name="age" id="age" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Idade do beneficiário', 66 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Estado civil', 71 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text" name="civil_status" id="civil_status">
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					    <option value="Kabennain"><?php echo $this->t( 'Kabennain', 167 ); ?></option>
					    <option value="Solteiru"><?php echo $this->t( 'Solteiru', 168 ); ?></option>
					    <option value="Divors"><?php echo $this->t( 'Divors', 169 ); ?></option>
					    <option value="Faluk"><?php echo $this->t( 'Faluk', 170 ); ?></option>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Estado civil', 71 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Sexo', 69 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="gender" id="gender"
						msgError="<?php echo $this->t( 'Selecione o sexo', 70 ); ?>">
					    <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
                                            <option value="M"><?php echo $this->t( 'Masculino', 83 ); ?></option>                                        
                                            <option value="F"><?php echo $this->t( 'Feminino', 84 ); ?></option>                                        
                                        </select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Sexo', 69 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Documento', 67 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error" name="document_id" 
					       msgError="<?php echo $this->t( 'Preencha o documento', 68 ); ?>"
					       maxlength="100" id="document_id" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Documento', 67 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Profissão', 72 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="occupation" id="occupation" 
						msgError="<?php echo $this->t( 'Selecione a profissão', 73 ); ?>">
					    
                                            <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>                                        
                                            <option value="La iha servisu"><?php echo $this->t( 'La iha servisu', 164 ); ?></option>
                                            <option value="Iha servisu"><?php echo $this->t( 'Iha servisu', 165 ); ?></option>
                                            <option value="Estudante"><?php echo $this->t( 'Estudante', 166 ); ?></option>
					    
                                        </select>
					
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Profissão', 72 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Setor', 74 ); ?>:
				    </label></li>
				<li>
				    <span class="input_wrapper">
					<select class="text" name="fk_id_industry_sector" id="fk_id_industry_sector" >
                                            <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>                                        
                                            <?php foreach ( $this->industrysector as $industrysector ) : ?>
						<option value="<?php echo $industrysector->getIdIndustrySector(); ?>">
						    <?php echo $industrysector->getIndustrySector(); ?>
						</option>      
					    <?php endforeach; ?>
                                        </select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Setor', 74 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Supervisor de campo', 75 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text" name="field_supervisor" maxlength="45" id="field_supervisor" type="text">
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Supervisor de campo', 75 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Data de registro', 76 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error date-mask" name="date_registration" id="date_registration" 
					      onChange="montaNumeroBenef();" msgError="<?php echo $this->t( 'Preencha a data de registro', 77 ); ?>" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Data de registro', 76 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <?php if ( !empty( $this->altera ) ) : ?>
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				    <?php echo $this->t( 'Status', 22 ); ?>:
				<span>*</span>
			    </label>
			    <div class="inputs">
				<ul>
				    <li>
					<span class="input_wrapper">
					    <select class="text required tip-error" name="status_worker" id="status_worker" 
						    msgError="<?php echo $this->t( 'Selecione o status', 45 ); ?>">
						<option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
						<option value="A"><?php echo $this->t( 'Ativo', 88 ); ?></option>
						<option value="I"><?php echo $this->t( 'Inativo', 89 ); ?></option>
					    </select>
					</span>
					<span class="tip-form" title="<?php echo $this->t( 'Status', 22 ); ?>"></span>
				    </li>
				</ul>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
		    <?php endif; ?>
		    
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
	$( '#form-beneficiario-geral' ).populate( <?php echo $this->data; ?> );
	
	if ( !empty( $( '#id_worker').val() ) ) {
	    
	    $( '#fk_id_add_subdistrict' ).attr( 'disabled', true );
	    
	    $( '#date_registration' ).attr( 'readonly', true );
	    $( '#ico-busca-beneficiario' ).hide();
	}
</script>