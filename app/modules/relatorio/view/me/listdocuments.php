<div class="table_wrapper">
    <div class="table_wrapper_inner">
	<table width="100%" cellspacing="0" cellpadding="0">
	    <thead>
		<tr>
		    <th colspan="2">
			<?php echo $this->t( 'Documentos', 67 ); ?>
		    </th>
		</tr>
	    </thead>
	    <tbody>
		<tr>
		    <?php foreach ( $this->files as $count => $file ) : ?>
			<td>
			    
			    <a href="javascript:;" onclick="showDocument( '<?php echo $file['name']; ?>', '<?php echo $file['path']; ?>', '<?php echo $file['size']; ?>' )">
				<?php echo $file['name']; ?>
			    </a>
			</td>
			
			<?php if ( $count % 2 != 0 ) : ?>
			    </tr>
			    <tr>
			<?php endif; ?>
			
		    <?php endforeach; ?>
		</tr>
	    </tbody>
	</table>
    </div>
</div>