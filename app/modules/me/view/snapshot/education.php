<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/me/snapshot/saveindicator/" method="post" id="form-snapshot-education"
	  class="search_form general_form" enctype="multipart/form-data" onsubmit="return saveIndicator( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_snapshot" id="id_snapshot" type="hidden" />
	    <input name="type" id="type" type="hidden" value="2" />

	    <div class="forms">

		<div class="abas-form">
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">

			<span class="button green_button">
			    <span><span><?php echo $this->t( 'Imprimir', 361 ); ?></span></span>
			    <input name="operacao" type="button" onclick="printIframeReport();" />
			</span>

		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    <iframe class="iframe-report" src="<?php echo BASE; ?>/me/snapshot/educationservice/id/<?php echo $this->snapshot; ?>"></iframe>
		</div>
	    </div>

	</fieldset>
	<!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    
    var dataForm = <?php echo $this->data; ?>;
    $( document ).ready(
    function()
    {
	$( '#form-snapshot-education' ).populate( dataForm  );
    }
);
</script>