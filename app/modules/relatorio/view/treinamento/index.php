<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/relatorio/treinamento.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/relatorio/treinamento.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2><?php echo $this->t( 'Training Reports', 999 ); ?> </h2>	    
	</div>
    </div>
    <span class="title_wrapper_bottom"></span>
</div>
<!--[if !IE]>end title wrapper<![endif]-->

<!--[if !IE]>start section content<![endif]-->
<div class="section_content report-container">
    <span class="section_content_top"></span>

    <div class="section_content_inner">

	<!--[if !IE]>start forms<![endif]-->
	<div class="forms_wrapper">
	    <form action="<?php echo BASE; ?>/relatorio/treinamento/summary/" method="post"
		  class="search_form general_form" id="form-report" onsubmit="return reportTreinamento( this );">
		
		    <input type="hidden" name="type" id="type" value="summary" />
		    <input type="hidden" name="detailed" id="detailed" />
		
		    <!--[if !IE]>start forms<![endif]-->
		    <div class="forms">

			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <div class="modules">

				<div class="module float-module">

				    <div class="module_top">
					<h5><?php echo $this->t( 'Periodo Específico', 549 ); ?></h5>
				    </div>

				    <div class="module_bottom">

					<div class="row">
					    <label>
						<?php echo $this->t( 'Periodo Específico', 549 ); ?>:
						<span>*</span>
					    </label>
					    <div class="inputs" id="periodo_filtro">
						<ul>
						    <li>
							<label>
							    <input class="radio" name="periodo_especifico" type="radio" value="S"> 
							    <?php echo $this->t( 'Sim', 86 ); ?>
							</label>
						    </li>
						    <li>
							<label>
							    <input class="radio" name="periodo_especifico" checked type="radio" value="L"> 
							    <?php echo $this->t( 'Não', 87 ); ?>
							</label>
						    </li>
						</ul>
					    </div>
					</div>
					
					<div class="row">
					    <label>
						<?php echo $this->t( 'Data início', 174 ); ?>:
						<span>*</span>
					    </label>
					    <div class="inputs">
						<span class="input_wrapper">
						    <input class="text date-mask  tip-error" disabled name="date_start" id="date_start" msgerror="<?php echo $this->t( 'Preencha a data de inicio', 175 ); ?>" type="text">
						</span>
					    </div>
					</div>
					
					<div class="row">
					    <label>
						<?php echo $this->t( 'Data final', 550 ); ?>:
						<span>*</span>
					    </label>
					    <div class="inputs">
						<span class="input_wrapper">
						    <input class="text date-mask tip-error" disabled name="date_finish" id="date_finish" msgerror="<?php echo $this->t( 'Preencha a data final', 178 ); ?>" type="text">
						</span>
					    </div>
					</div>
					
				    </div>

				</div>

				<div class="module float-module">

				    <div class="module_top">
					<h5><?php echo $this->t( 'Turma Específica', 551 ); ?></h5>
				    </div>

				    <div class="module_bottom">

					<div class="row" id="filtro_turma">
					    <label>
						<?php echo $this->t( 'Turma Específica', 551 ); ?>:
						<span>*</span>
					    </label>
					    <div class="inputs">
						<ul>
						    <li>
							<label>
							    <input class="radio" name="turma_especifica" type="radio" value="S"> 
							    <?php echo $this->t( 'Sim', 86 ); ?>
							</label>
						    </li>
						    <li>
							<label>
							    <input class="radio" name="turma_especifica" checked type="radio" value="L"> 
							    <?php echo $this->t( 'Não', 87 ); ?>
							</label>
						    </li>
						</ul>
					    </div>
					</div>
					
					<div class="row">
					    <label>
						<?php echo $this->t( 'ID', 0 ); ?>:
						<span>*</span>
					    </label>
					    <div class="inputs">
						<span class="input_wrapper">
						    <input class="text tip-error turma-id" name="turma_id[]" disabled id="turma_id" msgerror="<?php echo $this->t( 'Preencha o ID da turma', 552 ); ?>" type="text">
						</span>
						<a id="ico-add-turma" href="javascript:;">
						    <span class="tip-form ico-add" title="<?php echo $this->t( 'Adiciona turma', 595 ); ?>"></span>
						</a>
					    </div>
					</div>
					
				    </div>

				</div>

			    </div>
			</div>
			
			<div class="row summary-itens">
			    <div class="modules">

				<div class="module">

				    <div class="module_top">
					<h5>
					    <?php echo $this->t( 'Relatorio nivel 1 -  Summary', 553 ); ?>
					    <input type="checkbox" onclick="checkAllItens( this ); " />
					</h5>
				    </div>

				    <div class="module_bottom">
					
					<div class="itens-floating">
					    <div>
						<label for="summary_no_participantes">
						    <?php echo $this->t( 'Numero participantes', 225 ); ?>
						    <input type="checkbox" name="summary[no_participantes]" value="1" id="summary_no_participantes" />
						</label>
					    </div>
					    <div>
						<label for="summary_no_participantes_distrito">
						    <?php echo $this->t( 'No participantes por distrito', 401 ); ?>
						    <input type="checkbox" name="summary[participantes_distrito]" value="1" id="summary_no_participantes_distrito" />
						</label>
					    </div>
					    <div>
						<label for="summary_treinadores">
						    <?php echo $this->t( 'Treinadores', 554 ); ?>
						    <input type="checkbox" name="summary[treinadores]" value="1" id="summary_treinadores" />
						</label>
					    </div>
					    <div>
						<label for="summary_pass_rate">
						    <?php echo $this->t( 'Pass rate', 555 ); ?>(%)
						    <input type="checkbox" name="summary[pass_rate]" value="1" id="summary_pass_rate" />
						</label>
					    </div>
					    <div>
						<label for="summary_empresa_treinamento">
						    <?php echo $this->t( 'Empresa em treinamentos', 556 ); ?>
						    <input type="checkbox" name="summary[empresa_treinamento]" value="1" id="summary_empresa_treinamento" />
						</label>
					    </div>
					    <div>
						<label for="summary_sexo">
						    <?php echo $this->t( 'Sexo', 69 ); ?>(%)
						    <input type="checkbox" name="summary[sexo]" value="1" id="summary_sexo" />
						</label>
					    </div>
					    <div>
						<label for="summary_grupo_idade">
						    <?php echo $this->t( 'Grupo idade', 404 ); ?>
						    <input type="checkbox" name="summary[grupo_idade]" value="1" id="summary_grupo_idade" />
						</label>
					    </div>
					</div>
					
					<div class="row row-button">

					    <span class="button blue_button">
						<span><span><?php echo $this->t( 'Gerar Relatório', 362 ); ?></span></span>
						<input name="operacao" onClick="setTypeReport( 'summary' )" type="submit" />
					    </span>

					</div>
					
				    </div>
				</div>
			    </div>
			</div>

			<div class="row">
			    <div class="modules">

				<div class="module">

				    <div class="module_top">
					<h5><?php echo $this->t( 'Relatorio nivel 2 -  Detalhado', 557 ); ?></h5>
				    </div>

				    <div class="module_bottom">
					
					<div class="itens-floating detalhado">
					    <div>
						<a href="javascript:;" id="detalhado_turmas">
						    <?php echo $this->t( 'Turmas', 558 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="detalhado_pass_rate">
						    <?php echo $this->t( 'Pass rate', 555 ); ?>(%)
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="detalhado_no_participantes">
						   <?php echo $this->t( 'Numero participantes', 225 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="detalhado_no_participantes_distrito">
						    <?php echo $this->t( 'No participantes por distrito',0 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="detalhado_grupo_idade">
						    <?php echo $this->t( 'Grupo de idade', 404 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="detalhado_sexo">
						   <?php echo $this->t( 'Sexo', 69 ); ?>(%)
						</a>
					    </div>
					    <!--<div>
						<a href="javascript:;" id="detalhado_empresa_treinamento">
						   <?php echo $this->t( 'Empresa em treinamentos', 556 ); ?>
						</a>
					    </div>-->
					    <div>
						<a href="javascript:;" id="detalhado_treinadores">
						    <?php echo $this->t( 'Treinadores', 554 ); ?>
						</a>
					    </div>
					</div>
					
				    </div>
				</div>
			    </div>
			</div>
			
			<div class="row">
			    <div class="modules">

				<div class="module">

				    <div class="module_top">
					<h5><?php echo $this->t( 'Relatorio nivel 3 -  Listas', 559 ); ?></h5>
				    </div>

				    <div class="module_bottom">
					<div class="itens-floating listas">
					    <div>
						<a href="javascript:;" id="lista_turmas">
						    <?php echo $this->t( 'Lista Treinamento', 560 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_score">
						    <?php echo $this->t( 'Lista Score Classroom', 561 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_attendance">
						    <?php echo $this->t( 'Lista Attendance', 562 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_participantes">
						   <?php echo $this->t( 'Lista participantes', 563 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_score_pratica">
						    <?php echo $this->t( 'Lista Score Prática', 564 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_empresa">
						    <?php echo $this->t( 'Lista empresa em treinamento', 565 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_assessment">
						   <?php echo $this->t( 'Lista Final Assessment', 566 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_full_course">
						   <?php echo $this->t( 'Lista Full Course', 611 ); ?>
						</a>
					    </div>
					</div>
				    </div>
				</div>
			    </div>
			</div>

		    </div>
		    <!--[if !IE]>end forms<![endif]-->
	    </form>
	</div>
	<!--[if !IE]>end forms<![endif]-->

	<!--[if !IE]>start section sidebar<![endif]-->


    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->