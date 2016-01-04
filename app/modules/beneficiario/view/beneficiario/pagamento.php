<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/beneficiario/beneficiario/savepagamento/" method="post"  id="form-beneficiario-pagamento"
	  class="search_form general_form" onsubmit="return savePagamento( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_worker" id="id_worker" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Total de dias', 106 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required text-numeric tip-error" name="total_days" id="total_days" msgError="<?php echo $this->t( 'Preencha o total de dias', 149 ); ?>" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Total de dias', 106 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Salário do dia', 143 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text required money tip-error" name="salary_day" id="salary_day" msgError="<?php echo $this->t( 'Preencha o salário do dia', 144 ); ?>" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Salário do dia', 143 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Salário total', 145 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required money tip-error" name="total_salary" id="total_salary" msgError="<?php echo $this->t( 'Preencha o salário total', 146 ); ?>" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Salário total', 145 ); ?>"></span>
				</li>
				<li>
				    <label>
					<?php echo $this->t( 'Data de pagamento', 147 ); ?>:
					<span>*</span>
				    </label>
				</li>
				<li>
				    <span class="input_wrapper">
					<input class="text required date-mask tip-error" name="date_payment" id="date_payment" msgError="<?php echo $this->t( 'Preencha a data de pagamento', 148 ); ?>" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Data de pagamento', 147 ); ?>"></span>
				</li>
			    </ul>
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
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div class="module">
				<!--[if !IE]>start module top<![endif]-->
				<div class="module_top">
				    <h5><?php echo $this->t( 'Pagamento', 54 ); ?></h5>
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
							<th><?php echo $this->t( 'Total de dias', 106 ); ?></th>
							<th><?php echo $this->t( 'Salário do dia', 143 ); ?></th>
							<th><?php echo $this->t( 'Salário total', 145 ); ?></th>
							<th><?php echo $this->t( 'Data de pagamento', 147 ); ?></th>
							<th style="width: 30px;">Actions</th>
						    </tr>
						</thead>
						<tbody id="lista-pagamentos">
						    <?php require_once dirname( __FILE__ ) . '/listapagamentos.php';  ?>
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
    $( '#form-beneficiario-pagamento' ).populate( <?php echo $this->data; ?> );
    
    $( '#salary_day, #total_days' ).blur( calculaTotalSalario );
</script>