<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/relatorio/snapshot.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/relatorio/snapshot.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2><?php echo $this->t( 'Baseline / Endline', 999 ); ?></h2>	    
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
		<input name="operacao" type="button" onclick="exportBaseEndline();" />
	    </span>

	</div>
	<!--[if !IE]>end row<![endif]-->
	
	<div id="gridEndBaseLine" class="gridTela"></div>
	<div id="divPagEndBaseLine" class="pagingBlock"></div>
	
    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    initGridBaseEndline();
	    gridEndBaseLine.parse( <?php echo $this->dataSnapshot; ?>, 'json' );
	}
    )
</script>