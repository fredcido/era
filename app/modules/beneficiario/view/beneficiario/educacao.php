<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/beneficiario/beneficiario/saveeducacao/" method="post"  id="form-beneficiario-educacao"
	  class="search_form general_form" onsubmit="return saveEducacao( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_worker" id="id_worker" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Nível de educação', 80 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<select class="text required tip-error" name="fk_max_school_level" id="fk_max_school_level"
						msgError="<?php echo $this->t( 'Selecione o nível de educação', 81 ); ?>" >
                                            <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>
					    
                                            <?php foreach ( $this->max_school_level as $max_scool_level ) : ?>
						<option value="<?php echo $max_scool_level->getIdSchoolLevel(); ?>">
						    <?php echo $max_scool_level->getSchoolLevel(); ?>
						</option>      
					    <?php endforeach; ?>
						
                                        </select>

				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Nível de educação', 80 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Formação profissional', 82 ); ?>?:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<select class="text" name="vocational_training" id="vocational_training" onChange="mudaFormacaoProfissional();">
                                            <option value="L"><?php echo $this->t( 'Não', 87 ); ?></option>
                                            <option value="S"><?php echo $this->t( 'Sim', 86 ); ?></option>
					</select>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Formação profissional', 82 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row" id="formacao-profissional">
			<div class="module">
				<!--[if !IE]>start module top<![endif]-->
				<div class="module_top">
				    <h5><?php echo $this->t( 'Formação', 90 ); ?></h5>
				    <a class="add_module" href="javascript:;" onClick="addFormacaoProfissional();">
					<?php echo $this->t( 'Adicionar', 91 ); ?>
				    </a>
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
							<th><?php echo $this->t( 'Formação', 90 ); ?></th>
							<th><?php echo $this->t( 'Ano de finalização', 92 ); ?></th>
							<th style="width: 30px;">Actions</th>
						    </tr>
						</thead>
						<tbody>
						    
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
    
    $( '#form-beneficiario-educacao' ).populate( <?php echo $this->data; ?> );
    var vocationalTraining = <?php echo json_encode( $this->vocational_training ); ?>;
    
   <?php if ( !empty( $this->formacoes_cadastradas ) ) : ?>
	$( document ).ready(
	    function()
	    {
		$( '#formacao-profissional' ).show();
		
		<?php foreach ( $this->formacoes_cadastradas as $formacao ) : ?>
		    addFormacaoProfissional( <?php echo json_encode( $formacao->toArray() ); ?> );
		<?php endforeach; ?>
	    }
	);
    <?php endif ;?>
	
</script>