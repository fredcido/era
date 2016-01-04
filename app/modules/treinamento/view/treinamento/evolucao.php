<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/treinamento/saveevolucao/" method="post" id="form-treinamento-evolucao"
	  class="search_form general_form" onsubmit="return saveEvolucao( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>
	    
	    <input name="id_student_class" id="id_student_class" type="hidden" />
	    <input name="has_evolucao" id="has_evolucao" type="hidden" value="<?php echo empty( $this->tests ) ? '0' : '1'; ?>" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Total de participantes', 187 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text" name="total_student" readOnly id="total_student" type="text" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Total de participantes', 187 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Curso', 219 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper large_input">
					<input class="text" name="course" type="text" readOnly id="course" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Curso', 219 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div class="module">
				<!--[if !IE]>start module bottom<![endif]-->
				<div class="module_bottom">
				    <div class="table_wrapper">
					<div class="table_wrapper_inner">
					    <table width="100%" cellspacing="0" cellpadding="0">
						<thead>
						    <tr>
							<th><?php echo $this->t( 'Husu', 443 ); ?></th>
							<th><?php echo $this->t( 'Diak Liu', 444 ); ?></th>
							<th><?php echo $this->t( 'Diak', 445 ); ?></th>
							<th><?php echo $this->t( 'Sufisiente', 446 ); ?></th>
							<th><?php echo $this->t( 'Ladiak', 447 ); ?></th>
						    </tr>
						</thead>
						<tbody id="evolucao-itens">
						    <?php 
							$totalLevels = array();
							for ( $i = 1; $i <= 8; $i++ ) : 
						    ?>
							<tr>
							    <td><?php echo $i; ?></td>
							    <?php
								foreach ( $this->levels as $level ) : 
								    
								    if ( empty( $totalLevels[$level] ) )
									$totalLevels[$level] = 0;
								    
								    $value = empty( $this->tests[$i][$level] ) ? 0 : $this->tests[$i][$level];
								    $totalLevels[$level] += $value;
							    ?>
								    <td>
									<div class="inputs">
									    <span class="input_wrapper medium_input">
										<input type="text" value="<?php echo $value;?>" class="text required text-numeric" 
										    name="score[<?php echo $i;?>][<?php echo $level; ?>]" maxlength="8" />
									    </span>
									</div>
								    </td>
							    <?php 
								endforeach; 
							    ?>
						    <?php endfor; ?>
						</tbody>
						<tfoot>
						    <tr>
							<th><?php echo strtoupper( $this->t( 'Sub Total', 448 ) ); ?></th>
							<?php foreach ( $this->levels as $level ) : ?>
							    <th>
								<div class="inputs">
								    <span class="input_wrapper medium_input">
									<input type="text" value="<?php echo $totalLevels[$level]; ?>" class="text" readOnly />
								    </span>
								</div>
							    </th>
							<?php endforeach; ?>
						    </tr>
						</tfoot>
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
			
			<span class="button blue_button">
    			    <span><span><?php echo $this->t( 'Avançar', 213 ); ?></span></span>
    			    <input name="operacao" type="button" id="avancar-evolucao" />
    			</span>
			
			<?php if ( empty( $this->finalizada ) && ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
			    <span class="button green_button">
				<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
				<input name="operacao" type="submit" />
			    </span>
			<?php endif; ?>
			
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
    $( document ).ready(
	function()
	{
	    $( '#form-treinamento-evolucao' ).populate( <?php echo $this->data; ?> );
	}
    )
</script>