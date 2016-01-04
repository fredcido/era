<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form class="search_form general_form">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    
		    <div id="gridProjetos" class="gridTela" style="width: 96%; margin: 0 auto"></div>
		    <div id="divPagProjetos" class="pagingBlock"></div>
		    
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
	    initGridProjetos();
	    gridProjetos.parse( <?php echo $this->dataProjetos; ?>, 'json' );
	    gridProjetos.detachEvent( eventGridProjetos );
	    gridProjetos.detachHeader(1);
	}
    )
</script>