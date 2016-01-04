<!--[if !IE]>start module<![endif]-->
<div class="module">
    <!--[if !IE]>start module top<![endif]-->
    <div class="module_top">
	<h5> &nbsp;&nbsp;<?php echo count( $this->images['itens'] ); ?> photos  <span> | <?php echo $this->images['total']; ?></span></h5>
    </div>
    <!--[if !IE]>end module top<![endif]-->
    <!--[if !IE]>start module bottom<![endif]-->
    <div class="module_bottom">
	<!--[if !IE]>start gallery<![endif]-->
	<div class="gallery">
	    <!--[if !IE]>start gallery inner<![endif]-->
	    <div class="gallery_inner">
		
		<?php foreach ( $this->images['itens'] as $item ) : ?>
		
		    <!--[if !IE]>start product<![endif]-->
		    <dl class="product">
			<dt>
			    <a href="<?php echo $item['name']; ?>" rel="gallery" class="fancybox">
				<img width="97" height="82" src="<?php echo $item['name']; ?>" alt="" />
			    </a>
			</dt>
			<dd>
			    <em><?php echo $item['size']; ?></em>
			    <ul>
				<li>
				    <a href="javascript:;" class="delete_product" onclick="deleteImage( '<?php echo $item['name']; ?>' )">
					Delete
				    </a>
				</li>
			    </ul>
			</dd>
		    </dl>
		    <!--[if !IE]>end product<![endif]-->
		    
		<?php endforeach; ?>
	    </div>
	    <!--[if !IE]>end gallery inner<![endif]-->
	</div>
	<!--[if !IE]>end gallery<![endif]-->
    </div>
    <!--[if !IE]>end module bottom<![endif]-->
</div>
<!--[if !IE]>end module<![endif]-->