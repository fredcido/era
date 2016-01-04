<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/treinamento/treinamento/saveattendence/" method="post" id="form-treinamento-attendence"
	  class="search_form general_form" onsubmit="return saveAttendence( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>
	    
	    <input name="fk_id_client" id="fk_id_client" type="hidden" />
	    <input name="id_student_class" id="id_student_class" type="hidden" />
	    <input name="type" id="type" type="hidden" />

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Participantes turma', 212 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div id="gridParticipantesAttendence" class="gridTela" style="width: 870px; margin: 0 auto; height: 200px"></div>
			<div id="divPagParticipantesAttendence" class="pagingBlock"></div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Partisipante ita hili tiha ona', 217 ); ?>:
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span id="name-participant"></span>
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
			<label>
			    <?php echo $this->t( 'Loron Klasse', 0 ); ?>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper medium_input">
					<input class="text" name="class_days" type="text" readOnly id="class_days" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Loron iha Klasse', 192 ); ?>"></span>
				</li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Loron Field', 0 ); ?>
                                    </label>
                                </li>
                                <li>
				    <span class="input_wrapper medium_input">
					<input class="text" name="field_days" type="text" readOnly id="field_days" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Loron iha  Field', 0 ); ?>"></span>
				</li>
                                <li>
                                    <label>
                                        <?php echo $this->t( 'Loron Total', 0 ); ?>
                                    </label>                                    
                                </li>
                                <li>
				    <span class="input_wrapper medium_input">
					<input class="text" name="duration_time" type="text" readOnly id="duration_time" />
				    </span>
				    <span class="tip-form" title="<?php echo $this->t( 'Tempo de duração', 192 ); ?>"></span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <div id="class-attendance">
			<div class="row">
			    <h3><?php echo $this->t( 'Class Attendance', 999 ); ?></h3>
			    <hr />
			</div>

			<!--[if !IE]>start row<![endif]-->
			<div class="row attendence-container">
			    <div>
				<label>
				    <?php echo $this->t( 'Sick', 506 ); ?>
				</label>
			    </div>
			    <div>
				<label>
				    <?php echo $this->t( 'Permission', 507 ); ?>
				</label>
			    </div>
			    <div>
				<label>
				    <?php echo $this->t( 'Absence', 508 ); ?>
				</label>
			    </div>
			    <div>
				<label>
				    <?php echo $this->t( 'Present', 509 ); ?>
				</label>
			    </div>
			    <div>
				<label>
				    <?php echo $this->t( 'Present in %', 510 ); ?>
				</label>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->

			<!--[if !IE]>start row<![endif]-->
			<div class="row attendence-container attendance-values" id="class-attendance">
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error float" value="0" name="sick" msgError="<?php echo $this->t( 'Preencha o Sick', 511 ); ?>" maxlength="3" id="sick" type="text" />
				</span>
			    </div>
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error float" value="0" name="permission" msgError="<?php echo $this->t( 'Preencha o Permission', 512 ); ?>" maxlength="3" id="permission" type="text" />
				</span>
			    </div>
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error float" value="0" name="absence" msgError="<?php echo $this->t( 'Preencha o Absence', 513 ); ?>" maxlength="3" id="absence" type="text" />
				</span>
			    </div>
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error" value="0" name="present_class" readonly id="present_class" type="text" />
				</span>
			    </div>
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error" value="0" name="present_percent_class" readonly id="present_percent_class" type="text" />
				</span>
				%
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->

			<!--[if !IE]>start row<![endif]-->
			<div class="row row-button">

			    <?php if ( empty( $this->finalizada ) && ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
				<span class="button green_button">
				    <span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
				    <input name="operacao" type="button" onclick="submitAttendence( 'C' );" />
				</span>
			    <?php endif; ?>

			</div>
			<!--[if !IE]>end row<![endif]-->
		    </div>
		    
		    <div id="field-attendance">
			<div class="row">
			    <h3>
				<?php echo $this->t( 'Field Attendance', 999 ); ?>
				<input type="checkbox" name="optional[field-attendance]" id="option-field-attendance" value="1" >
			    </h3>
			    <hr />
			</div>

			<!--[if !IE]>start row<![endif]-->
			<div class="row attendence-container">
			    <div>
				<label>
				    <?php echo $this->t( 'Sick', 506 ); ?>
				</label>
			    </div>
			    <div>
				<label>
				    <?php echo $this->t( 'Permission', 507 ); ?>
				</label>
			    </div>
			    <div>
				<label>
				    <?php echo $this->t( 'Absence', 508 ); ?>
				</label>
			    </div>
			    <div>
				<label>
				    <?php echo $this->t( 'Present', 509 ); ?>
				</label>
			    </div>
			    <div>
				<label>
				    <?php echo $this->t( 'Present in %', 510 ); ?>
				</label>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->

			<!--[if !IE]>start row<![endif]-->
			<div class="row attendence-container attendance-values"  id="field-attendance">
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error float" value="0" name="sick" msgError="<?php echo $this->t( 'Preencha o Sick', 511 ); ?>" maxlength="3" id="sick" type="text" />
				</span>
			    </div>
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error float" value="0" name="permission" msgError="<?php echo $this->t( 'Preencha o Permission', 512 ); ?>" maxlength="3" id="permission" type="text" />
				</span>
			    </div>
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error float" value="0" name="absence" msgError="<?php echo $this->t( 'Preencha o Absence', 513 ); ?>" maxlength="3" id="absence" type="text" />
				</span>
			    </div>
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error" value="0" name="present" readonly id="present" type="text" />
				</span>
			    </div>
			    <div>
				<span class="input_wrapper short_input">
				    <input class="text required tip-error" value="0" name="present_percent" readonly id="present_percent" type="text" />
				</span>
				%
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->

			<!--[if !IE]>start row<![endif]-->
			<div class="row row-button">

			    <?php if ( empty( $this->finalizada ) && ILO_Auth_Permissao::has( '/treinamento/treinamento/', 'salvar' ) ) : ?>
				<span class="button green_button" id="btn-field-attendance">
				    <span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
				    <input name="operacao" type="button" onclick="submitAttendence( 'F' );" />
				</span>
			    <?php endif; ?>

			</div>
			<!--[if !IE]>end row<![endif]-->
		    </div>
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label id="check-present">
			</label>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		     
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			
			<hr />
			
			<span class="button blue_button">
    			    <span><span><?php echo $this->t( 'Avançar', 213 ); ?></span></span>
    			    <input name="operacao" type="button" id="avancar-attendence" />
    			</span>
			
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
	    $( '#form-treinamento-attendence' ).populate( <?php echo $this->data; ?> );
	    
	    initGridParticipantesAttendence();
	    gridParticipantesAttendence.parse( <?php echo $this->participantes; ?>, 'json' );
	    
	    $( '#sick, #permission, #absence' ).change( calcPresentAttendence );
	    calcPresentAttendence();
	    
	    $('#option-field-attendance').on('change',
		function()
		{
		    var field = $('#field-attendance .attendence-container :input');
    
		    if ( $( this ).is(':checked' ) ) {
			field.each(
			    function()
			    {
				$(this).attr('disabled', true).val('').addClass('optional-field');
				
				if ( $(this).hasClass( 'required') ) {
				    $(this).addClass('had-required');
				    $(this).removeClass('required');
				}
				
				$(this).trigger('change');
			    }
			);
		    } else {
			field.each(
			    function()
			    {
				$(this).removeAttr('disabled').removeClass('optional-field').eq(0).focus();

				if ( $(this).hasClass( 'had-required') ) {
				    $(this).removeClass('had-required');
				    $(this).addClass('required');
				}
				
				$(this).trigger('change');
			    }
			);
		    }
		}
	    );
	}
    )
</script>