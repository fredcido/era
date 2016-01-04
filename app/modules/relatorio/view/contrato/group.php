<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/relatorio/contrato.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/relatorio/contrato.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2><?php echo $this->t( 'Contract Groups', 687 ); ?> </h2>	    
	</div>
    </div>
    <span class="title_wrapper_bottom"></span>
</div>
<!--[if !IE]>end title wrapper<![endif]-->

<!--[if !IE]>start section content<![endif]-->
<div class="section_content report-container">
    <span class="section_content_top"></span>

    <div class="section_content_inner report-container">
	
	 <!--[if !IE]>start row<![endif]-->
	<div class="row row-button">

	    <span class="button green_button" style="float: none; margin: 10px auto; width: 117px">
		<span><span>EXPORTA EXCEL</span></span>
		<input name="operacao" type="button" onclick="exportGroup();" />
	    </span>

	</div>
	<!--[if !IE]>end row<![endif]-->
	
	<div id="gridGroup" class="gridTela"></div>
	<div id="divPagContratos" class="pagingBlock"></div>
	
    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    initGridContratosGroup();
	    gridGroup.parse( <?php echo $this->dataContratos; ?>, 'json' );
	}
    )
</script>