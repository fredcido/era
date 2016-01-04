<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/me/snapshot/saveimage/" method="post" target="return-upload" id="form-snapshot-image"
	  class="search_form general_form" enctype="multipart/form-data" onsubmit="return uplodaImages( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_snapshot" id="id_snapshot" type="hidden" />

	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Image', 613 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error file-image" name="image[]" 
					       msgError="<?php echo $this->t( 'Selecione a imagem', 619 ); ?>" type="file" />
				    </span>
				</li>
				<li>
				    <span class="button blue_button">
					<span><span><?php echo $this->t( 'Adicionar', 620 ); ?></span></span>
					<input name="operacao" type="button" onClick="addImage();" />
				    </span>
				</li>
			    </ul>
			</div>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		     <!--[if !IE]>start row<![endif]-->
		    <div class="row row-button">
			<?php if ( ILO_Auth_Permissao::has( '/me/snapshot/', 'salvar' ) ) : ?>
			<span class="button blue_button">
			    <span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
			    <input name="operacao" type="submit" />
			</span>
			<?php endif; ?>
		    </div>
		    <!--[if !IE]>end row<![endif]-->
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<!--[if !IE]>start modules<![endif]-->
			<div class="modules" id="image-container">

			</div>
		    </div>
		    <!--[if !IE]>end modules<![endif]-->

		</div>
		<!--[if !IE]>end product gallery<![endif]-->
	    </div>

	    </div>

	</fieldset>
	<!--[if !IE]>end fieldset<![endif]-->
    </form>
</div>
<!--[if !IE]>end forms<![endif]-->

<iframe id="return-upload" name="return-upload" onload="parseUploadImage( this );" style="margin-top: -9999px; position: absolute"></iframe>

<script type="text/javascript">
    
    var dataForm = <?php echo $this->data; ?>;
    $( document ).ready(
    function()
    {
	$( '#form-snapshot-image' ).populate( dataForm  );
	loadImagesSnapshot();
    }
);
</script>