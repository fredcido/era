<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/participantes/saveexperiencia/" method="post"  id="form-participantes-experiencia"
	  class="search_form general_form" onsubmit="return saveExperiencia( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_client" id="id_client" type="hidden" />
	    <input name="id_professional_experience" id="id_professional_experience" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">

                    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Data Hahu', 279 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required date-mask" name="start_date" id="start_date" maxlength="10" type="text"
                                               msgError="<?php echo $this->t( 'Data Hahu', 279 ); ?>"/>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Data Hahu', 279 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Data Remata', 128 ); ?>:
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text date-mask" name="finish_date" id="finish_date" maxlength="10" type="text"/>
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
			    <?php echo $this->t( 'Posisaun', 280 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required" name="position" id="position" maxlength="200" type="text"
                                               msgError="<?php echo $this->t( 'Posisaun', 280 ); ?>"/>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Posisaun', 280 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Empreza', 281 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text required" name="enterprise_name" id="enterprise_name" maxlength="200" type="text"
                                               msgError="<?php echo $this->t( 'Empreza', 281 ); ?>"/>
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Empreza', 281 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Deskrisaun konaba', 282 ); ?>:
			</label>
			<div class="inputs">
			    <span class="input_wrapper" style="width: 90%">
				<input class="text" name="job_description" maxlength="200" id="job_description" type="text" />
			    </span>
			    <span class="tip-form" title="<?php echo $this->t( 'Deskrisaun konaba servisu ita halao', 282 ); ?>"></span>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->		    
		</div>
	    </div>
	    <!--[if !IE]>end forms<![endif]-->
            
            <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div class="module">
				<!--[if !IE]>start module top<![endif]-->
				<div class="module_top">
				    <h5><?php echo $this->t( 'Endereço', 53 ); ?></h5>
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
							<th><?php echo $this->t( 'Empresa', 273 ); ?></th>
							<th><?php echo $this->t( 'Data Hahu', 279 ); ?></th>
							<th><?php echo $this->t( 'Data Remata', 128 ); ?></th>
							<th><?php echo $this->t( 'Posisaun', 280 ); ?></th>
							<th><?php echo $this->t( 'Deskrisaun konaba', 282 ); ?></th>
							<th style="width: 30px;">Actions</th>
						    </tr>
						</thead>
						<tbody id="lista-pagamentos">
						    <?php require_once dirname( __FILE__ ) . '/listaexperiencia.php';  ?>
						</tbody>
					    </table>
					</div>
				    </div>
				</div>
				<!--[if !IE]>end module bottom<![endif]-->
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
	    
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
	    $( '#form-participantes-experiencia' ).populate( dataForm  );
	}
    );
</script>