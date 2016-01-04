<table>
    <tr>
	<td style="width:1%">
	    <img alt="" src="<?php echo BASE; ?>/public/images/segmentation.png" />
	</td>
	<td>
	    <h1><?php echo $this->t( 'Empresas por distrito', 410 ); ?> </h1>
	</td>
	<td style="width:1%">
	    <span><?php echo date( 'd/m/Y H:i:s' ); ?></span>
	</td>
    </tr>
</table>

<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Total de registros', 420 ); ?></th>
	    <th colspan="2"><?php echo$this->data['total']; ?></th>
	</tr>
	<tr>
	    <th><?php echo $this->t( 'Distrito', 96 ); ?></th>
	    <th><?php echo $this->t( 'Quantidade', 413 ); ?></th>
	    <th><?php echo $this->t( 'Percentagem', 383 ); ?></th>
	</tr>
    </thead>
    
    <tbody>
	<?php foreach ( $this->data['rows'] as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['district']; ?></td>
		<td><?php echo $row['total']; ?></td>
		<td><?php echo $row['perc']; ?> %</td>
	    </tr>
	    
	<?php endforeach; ?>

    </tbody>
</table>

<div id="grafico" class="grafico-report"></div>

<script type="text/javascript">
    
    $(function () {
	$(document).ready(function() {
	    chart = new Highcharts.Chart({
		chart: {
		    renderTo: 'grafico',
		    plotBackgroundColor: null,
		    plotBorderWidth: null,
		    plotShadow: false
		},
		exporting: {
		    buttons: {
			printButton: {
			    enabled: false
			}
		    }
		},
		credits: {
		     enabled: false
		},
		title: {
		    text: '<?php echo $this->t( 'Distrito', 96 ); ?>'
		},
		tooltip: {
		    pointFormat: '<b>{point.percentage}%</b>',
		    percentageDecimals: 1
		},
		plotOptions: {
		     pie: {
			allowPointSelect: true,
			cursor: 'pointer',
			dataLabels: {
			    enabled: true,
			    color: '#000000',
			    connectorColor: '#000000',
			    formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat( this.percentage, 2) +' %';
			    }
			},
			showInLegend: true
		    }
		},
		series: [{
			type: 'pie',
			data: <?php echo json_encode( $this->data['graph'] ); ?>
		    }]
	    });
	});

    });
</script>