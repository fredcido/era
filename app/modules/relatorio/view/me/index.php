<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/relatorio/snapshot.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/relatorio/snapshot.css" />

<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2><?php echo $this->t( 'Relatorio M&E', 656 ); ?> </h2>	    
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
	    <form action="<?php echo BASE; ?>/relatorio/me/list/" method="post"
		  class="search_form general_form" id="form-report" onsubmit="return reportTreinamento( this );">
		
		    <input type="hidden" name="type" id="type" value="summary" />
		    <input type="hidden" name="detailed" id="detailed" />
		    <input type="hidden" name="id_snapshot" id="id_snapshot" />
		
		    <!--[if !IE]>start forms<![endif]-->
		    <div class="forms">
			
			<div class="row">
			    <div class="modules">

				<div class="module">

				    <div class="module_top">
					<h5><?php echo $this->t( 'Lista Snapshot', 657 ); ?></h5>
				    </div>

				    <div class="module_bottom">
					<div id="gridSnapshot" class="gridTela"></div>
					<div id="divPagSnapshot" class="pagingBlock"></div>
				    </div>
				</div>
			    </div>
			</div>
			
			<div class="row">
			    <div class="modules">

				<div class="module">

				    <div class="module_top">
					<h5><?php echo $this->t( 'Relatórios', 407 ); ?></h5>
				    </div>

				    <div class="module_bottom">
					<div class="itens-floating listas">
					    <div>
						<a href="javascript:;" id="lista_snapshot">
						    <?php echo $this->t( 'Snapshot', 999 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_overall">
						    <?php echo $this->t( 'Overall Rankings', 641 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_market">
						    <?php echo $this->t( 'Market', 647 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_education">
						    <?php echo $this->t( 'Education', 646 ); ?>
						</a>
					    </div>
					    <div>
						<a href="javascript:;" id="lista_health">
						    <?php echo $this->t( 'Health Services', 645 ); ?>
						</a>
					    </div>
					</div>
                                        <div class="itens-floating">
                                        <div>
                                            <a href="javascript:;" id="lista_documents">
                                                <?php echo $this->t( 'Documents', 0 ); ?>
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
                                    <div class="row" id="list-document-container">

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
			
			<!--[if !IE]>start modules<![endif]-->
			<div class="modules" id="document-container">
			    <!--[if !IE]>start module<![endif]-->
				<div class="module">
				    <!--[if !IE]>start module top<![endif]-->
				    <div class="module_top">
					<h5><?php echo $this->t( 'Document Reader', 0 ); ?></h5>
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
    $( window ).load(
	function()
	{
	    initGridSnapshot();
	    gridSnapshot.parse( <?php echo $this->dataSnapshot; ?>, 'json' );            
	}
        
    );
    $('#lista_documents').click(
        function(e){
            e.stopPropagation();
            ReportloadSnapshotDocuments();
        }
    );
</script>