<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/relatorio/treinamento.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/relatorio/treinamento.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2><?php echo $this->t( 'Participantes por por nível de educação', 368 ); ?> </h2>	    
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
	    <form action="<?php echo BASE; ?>/relatorio/treinamento/relatorioparticipanteseducacao/" method="post"
		  class="search_form general_form" onsubmit="return relatorioIframe( this );">
		<!--[if !IE]>start fieldset<![endif]-->
		<fieldset>

		    <!--[if !IE]>start forms<![endif]-->
		    <div class="forms">
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Data inicial', 174 ); ?>:
				<span>*</span>
			    </label>
			    <div class="inputs">
				<ul>
				    <li>
					<span class="input_wrapper">
					    <input class="text required date-mask tip-error" name="dt_ini" id="dt_ini" msgError="<?php echo $this->t( 'Preencha a data inicial', 175 ); ?>" type="text" />
					</span>
					<span class="tip-form" title="<?php echo $this->t( 'Preencha a data inicial', 175 ); ?>"></span>
				    </li>
				    <li>
					<label>
					    <?php echo $this->t( 'Data Final', 177 ); ?>:
					    <span>*</span>
					</label>
				    </li>
				    <li>
					<span class="input_wrapper">
					    <input class="text required date-mask tip-error" name="dt_fim" id="dt_fim" msgError="<?php echo $this->t( 'Preencha a data final', 178 ); ?>" type="text" />
					</span>
					<span class="tip-form" title="<?php echo $this->t( 'Preencha a data final', 178 ); ?>"></span>
				    </li>
				</ul>
			    </div>
			</div>
			
			<!--[if !IE]>start row<![endif]-->
			<div class="row">
			    <label>
				<?php echo $this->t( 'Distrito', 96 ); ?>:
				<span>*</span>
			    </label>
			    <div class="inputs">
				<span class="input_wrapper">
				    <select class="text" name="fk_id_add_district" id="fk_id_add_district">
					<option value=""><?php echo $this->t( 'Todos', 360 ); ?></option>

					<?php foreach ( $this->districts as $district ) : ?>
					    <option value="<?php echo $district->getIdAddDistrict(); ?>">
						<?php echo $district->getDistrict(); ?>
					    </option>      
					<?php endforeach; ?>

				    </select>
				</span>
			    </div>
			</div>
			<!--[if !IE]>end row<![endif]-->
		
			 <!--[if !IE]>start row<![endif]-->
			<div class="row row-button">

			    <span class="button green_button">
				<span><span><?php echo $this->t( 'Imprimir', 361 ); ?></span></span>
				<input name="operacao" type="button" onclick="printIframeReport();" />
			    </span>
			    
			    <span class="button blue_button">
				<span><span><?php echo $this->t( 'Gerar Relatório', 362 ); ?></span></span>
				<input name="operacao" type="submit" />
			    </span>

			</div>
			<!--[if !IE]>end row<![endif]-->

		    </div>
		    <!--[if !IE]>end forms<![endif]-->

		</fieldset>
		<!--[if !IE]>end fieldset<![endif]-->
	    </form>
	</div>
	<!--[if !IE]>end forms<![endif]-->

	<!--[if !IE]>start section sidebar<![endif]-->


    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->