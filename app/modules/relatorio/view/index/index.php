<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
	<span class="title_wrapper_middle"></span>
	<div class="title_wrapper_content">
	    <h2>
		<?php echo $this->t( 'ERA-SYS Reports Interface', 999 ); ?>
	    </h2>
	</div>
    </div>
    <span class="title_wrapper_bottom"></span>
</div>
<!--[if !IE]>end title wrapper<![endif]-->

<?php
    $dashboard = array();

?>

<!--[if !IE]>start section content<![endif]-->
<div class="section_content">
    <span class="section_content_top"></span>

    <div class="section_content_inner">
	<!--[if !IE]>start dashboard menu<![endif]-->
	<div class="dashboard_menu_wrapper">
	    <ul class="dashboard_menu">
		<?php foreach ( $dashboard as $dash ) : ?>
		
		    <li>
			<a href="<?php echo BASE . $dash['url']; ?>" class="<?php echo $dash['class']; ?>">
			    <span>
				<?php echo $this->t( $dash['label'], $dash['id'] ); ?>
			    </span>
			</a>
		    </li>
		<?php endforeach; ?>
	    </ul>
	</div>
	<!--[if !IE]>end dashboard menu<![endif]-->	
    </div>

    <span class="section_content_bottom"></span>
</div>
<!--[if !IE]>end section content<![endif]-->