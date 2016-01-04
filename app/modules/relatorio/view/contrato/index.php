<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/relatorio/contrato.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/relatorio/contrato.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2><?php echo $this->t( 'Contract Reports', 999 ); ?> </h2>	    
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
	    <form action="<?php echo BASE; ?>/relatorio/contrato/list/" method="post"
		  class="search_form general_form" id="form-report" onsubmit="return reportContrato( this );">
		
		    <input type="hidden" name="type" id="type" value="list" />
		    <input type="hidden" name="detailed" id="detailed" />
		    <input type="hidden" name="contracts" id="contracts" />
		
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
					
<!--					<div class="row">
					    <label>
						<?php echo $this->t( 'Data final', 550 ); ?>:
						<span>*</span>
					    </label>
					    <div class="inputs">
						<span class="input_wrapper">
						    <input class="text date-mask tip-error" disabled name="date_finish" id="date_finish" msgerror="<?php echo $this->t( 'Preencha a data final', 178 ); ?>" type="text">
						</span>
					    </div>
					</div>-->
					
				    </div>

				</div>

			    </div>
			</div>
			
			 <!--[if !IE]>start row<![endif]-->
			<div class="row row-button">

			    <span class="button green_button" style="float: none; margin: 3px auto; width: 59px">
				<span><span>FILTRA</span></span>
				<input name="operacao" type="button" onclick="filtraContratos();" />
			    </span>

			</div>
			<!--[if !IE]>end row<![endif]-->
			
			 <!--[if !IE]>start row<![endif]-->
			<div class="row">

			   <div id="gridContratos" class="gridTela"></div>
			    <div id="divPagContratos" class="pagingBlock"></div>

			</div>
			<!--[if !IE]>end row<![endif]-->
			
			<div class="row">
			    <div class="modules">

				<div class="module">

				    <div class="module_top">
					<h5><?php echo $this->t( 'Listas', 660 ); ?></h5>
				    </div>

				    <div class="module_bottom">
					<div class="itens-floating listas">
					    <div>
						<a href="javascript:;" id="lista_sexo">
						    <?php echo $this->t( 'Sexo', 69 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_idade">
						    <?php echo $this->t( 'Grupo de idade', 404 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_educacao">
						    <?php echo $this->t( 'Nível de Educação', 402 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_distrito">
						   <?php echo $this->t( 'Local de nascimento', 63 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_profissao">
						    <?php echo $this->t( 'Profissão', 72 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_endereco">
						    <?php echo $this->t( 'Distrito', 96 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_pagamento">
						   <?php echo $this->t( 'Pagamento', 54 ); ?>
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

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    iniGridContratosLista();
	}
    );
</script>