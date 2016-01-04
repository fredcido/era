<?php require_once 'body/control-bar.php'; ?>
 
<h1>
    <?php echo $this->report['questionnaire']->getTitle(); ?>
</h1>

<div class="container-report">
    
    <table class="summary">
	<tbody>
	    <tr>
		<?php 
		    $countFilters = 0;
		    foreach ( $this->report['filters'] as $filter => $value ) :
			$countFilters++;
		?>
		    <th>
			<label><?php echo $filter; ?></label>
		    </th>
		    <td>
			<?php echo $value; ?>
		    </td>
		    
		    <?php if ( $countFilters % 2 == 0 ) : ?>
			</tr>
			<tr>
		    <?php endif; ?>
		    
		 <?php endforeach; ?>
	     </tr>
	</tbody>
    </table>
    
    <table class="summary">
	<tbody>
	<tr>
	     <th>
		 <label>Total</label>
	     </th>
	     <td>
		 <span class="qtde-summary"><?php echo count( $this->report['answers'] ); ?></span>
	     </td>
	 </tr>
	</tbody>
    </table>
    
    <table class="summary" id="relatorio">
	<thead>
	    <tr>
		<th>NO</th>
		<th>Questions</th>
		<th>TOTALS</th>
		<th>AVG</th>
	    </tr>
	</thead>
	<tbody>
	    <?php foreach ( $this->report['questions'] as $key => $question ) : ?>
		<tr>
		    <th><?php echo ++$key; ?></th>
		    <th><?php echo $question['data']['title']; ?></th>
		    <td class="align-right"><?php echo isset($question['sum']) ? $question['sum'] : '-'; ?></td>
		    <td class="align-right"><?php echo isset($question['avg']) ? $question['avg'] : '-'; ?></td>
		</tr>
		
		<?php if ( !empty( $question['options'] ) ) : ?>
		    <?php foreach ( $question['options'] as $option ) : ?>
			<tr>
			    <td></td>
			    <td><?php echo $option['title']; ?></td>
			    <td class="align-right"><?php echo isset($option['sum']) ? $option['sum'] : '0'; ?></td>
			    <td class="align-right"><?php echo isset($option['avg']) ? $option['avg'] . '%' : '0'; ?></td>
			</tr>
		    <?php endforeach; ?>
		<?php endif;?>
			
	    <?php endforeach; ?>
	</tbody>
    </table>
 </div>

<?php require_once 'footer_report.php'; ?>