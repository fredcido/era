<div class="table_tabs_menu">
    <!--[if !IE]>start  tabs<![endif]-->
    <ul class="table_tabs">
	<?php foreach ( $this->abas as $aba ) : ?>
	    <li>
		<a href="<?php echo empty( $aba['liberado'] ) ? 'javascript:;' : BASE . $aba['url'] ; ?>" 
		   class="<?php echo !empty( $aba['selected'] ) ? 'selected' : ''; ?> <?php echo empty( $aba['liberado'] ) ? 'disabled' : '' ; ?>">
		    <span>
			<span><?php echo $this->t( $aba['label'], $aba['id'] ); ?> </span>
		    </span>
		</a>
	    </li>
	
	<?php endforeach; ?>
    </ul>
    <!--[if !IE]>end  tabs<![endif]-->
</div>