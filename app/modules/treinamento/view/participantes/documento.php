<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/participantes/savedocumento/" method="post"  id="form-participantes-documento"
	  class="search_form general_form" onsubmit="return saveDocumento( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

            <input name="id_client" id="id_client" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Tipo documento', 251 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_id_type_document" id="fk_id_type_document" msgError="<?php echo $this->t( 'Tipo documento', 251 ); ?>" >
                                            <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
                                            <?php foreach( $this->typeDocuments as $typeDocument ) : ?>
                                            <option value="<?php echo $typeDocument->getIdTypeDocument(); ?>"><?php echo $typeDocument->getTypeDocument(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Tipo documento', 251 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Númedo do Documento', 252 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
                                        <input class="text required tip-error" name="number_doc" id="number_doc" maxlength="100" msgError="<?php echo $this->t( 'Númedo do Documento', 252 ); ?>" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Númedo do Documento', 252 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Fatin Dokumentus', 253 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
                                        <select class="text required tip-error" name="fk_id_add_district" id="fk_id_add_district" msgError="<?php echo $this->t( 'Selecione o distrito', 97 ); ?>" >
                                            <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
                                            <?php foreach( $this->districts as $district ): ?>
                                                <option value="<?php echo $district->getIdAddDistrict(); ?>" ><?php echo $district->getDistrict(); ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Fatin Dokumentus', 253 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Data Dokumentus', 254 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text required date-mask tip-error" name="issue_date" id="issue_date" msgError="<?php echo $this->t( 'Data Dokumentus', 254 ); ?>" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Data Dokumentus', 147 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
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
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div class="module">
				<!--[if !IE]>start module top<![endif]-->
				<div class="module_top">
				    <h5><?php echo $this->t( 'Documentos', 67 ); ?></h5>
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
							<th><?php echo $this->t( 'Tipo documento', 251 ); ?></th>
							<th><?php echo $this->t( 'Númedo do Documento', 252 ); ?></th>
							<th><?php echo $this->t( 'Fatin Dokumentus', 253 ); ?></th>
							<th><?php echo $this->t( 'Data Dokumentus', 254 ); ?></th>
                                                        <th style="width: 30px;">Actions</th>
						    </tr>
						</thead>
						<tbody id="lista-documentos">
						    <?php require_once dirname( __FILE__ ) . '/listadocumentos.php';  ?>
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

	</fieldset>
	<!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    $( '#form-participantes-documento' ).populate( <?php echo $this->data; ?> );
</script>