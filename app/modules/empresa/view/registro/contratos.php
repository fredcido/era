<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="" method="post"  id="form-empresas-contratos"
	  class="search_form general_form" onsubmit="return false">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <!--[if !IE]>start forms<![endif]-->
	    <div class="forms">

		<div class="abas-form">
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<h3><?php echo $this->t( 'Contratos vinculados a empresa', 439 ); ?></h3>
			<hr />
		    </div>
		    <!--[if !IE]>end row<![endif]-->

		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<div id="gridContratos" class="gridTela"></div>
			<div id="divPagContratos" class="pagingBlock"></div>
		    </div>

		</div>
	    </div>

	</fieldset>
	<!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    $( document ).ready(
    function()
    {
	initGridContratos();
	gridContratos.parse( <?php echo $this->dataContratos; ?>, 'json' );
    }
)
</script>