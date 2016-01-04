<!--[if !IE]>start forms<![endif]-->
<div class="forms_wrapper">
    <form action="<?php echo BASE; ?>/me/snapshot/savedocument/" method="post" target="return-upload" id="form-snapshot-document"
	  class="search_form general_form" enctype="multipart/form-data" onsubmit="return uploadDocument( this );">
	<!--[if !IE]>start fieldset<![endif]-->
	<fieldset>

	    <input name="id_snapshot" id="id_snapshot" type="hidden" />

	    <div class="forms">

		<div class="abas-form">
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<label>
			    <?php echo $this->t( 'Document', 614 ); ?>:
			    <span>*</span>
			</label>
			<div class="inputs">
			    <ul>
				<li>
				    <span class="input_wrapper">
					<input class="text required tip-error" name="document" id="document" 
					       msgError="<?php echo $this->t( 'Selecione o document', 615 ); ?>" type="file" />
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
		    
		    <div class="row" id="list-document-container">
			
		    </div>
		    
		    <!--[if !IE]>start row<![endif]-->
		    <div class="row">
			<!--[if !IE]>start modules<![endif]-->
			<div class="modules" id="hidden-container">
			    <!--[if !IE]>start module<![endif]-->
				<div class="module">
				    <!--[if !IE]>start module top<![endif]-->
				    <div class="module_top">
					<h5> &nbsp;&nbsp;Document  <span> | 0</span></h5>
				    </div>
				    <!--[if !IE]>end module top<![endif]-->
				    <!--[if !IE]>start module bottom<![endif]-->
				    <div class="module_bottom">
					
				    </div>
				    <!--[if !IE]>end module bottom<![endif]-->
				</div>
				<!--[if !IE]>end module<![endif]-->
			</div>
			
			<!--[if !IE]>start modules<![endif]-->
			<div class="modules" id="document-container">
			    <!--[if !IE]>start module<![endif]-->
				<div class="module">
				    <!--[if !IE]>start module top<![endif]-->
				    <div class="module_top document-control">
					<h5> &nbsp;&nbsp;<span id="doc-name">Document</span>  <span> | <span id="doc-size">0</span></span></h5>
					<?php if ( ILO_Auth_Permissao::has( '/me/snapshot/', 'salvar' ) ) : ?>
					    <!--<a href="javascript:;" onClick="removeDocument()" class="edit_module remove-document">
						<?php echo $this->t( 'Remove Document', 616 ); ?>
					    </a>-->
					<?php endif; ?>
					<!--<a href="<?php echo BASE . '/me/snapshot/viewdocument/'; ?>" class="edit_module view-document">
					    <?php echo $this->t( 'View Document', 617 ); ?>
					</a>
					-->
				    </div>
				    <!--[if !IE]>end module top<![endif]-->
				    <!--[if !IE]>start module bottom<![endif]-->
				    <div class="module_bottom">
					
				    </div>
				    <!--[if !IE]>end module bottom<![endif]-->
				</div>
				<!--[if !IE]>end module<![endif]-->
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

<iframe id="return-upload" name="return-upload" onload="parseUploadDocument( this );" style="margin-top: -9999px; position: absolute"></iframe>

<script type="text/javascript">
    
    var dataForm = <?php echo $this->data; ?>;
    $( document ).ready(
    function()
    {
	$( '#form-snapshot-document' ).populate( dataForm  );
	loadSnapshotDocuments();
    }
);
</script>