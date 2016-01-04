<table>
    <tr>
	<td style="width:1%">
	    <img alt="" src="<?php echo BASE; ?>/public/images/segmentation.png" />
	</td>
	<td>
	    <h1><?php echo $this->t( 'Empresa por volume de negócio', 411 ); ?> </h1>
	</td>
	<td style="width:1%">
	    <span><?php echo date( 'd/m/Y H:i:s' ); ?></span>
	</td>
    </tr>
</table>

<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Distrito', 96 ); ?></th>
	    <th>MIKRO(Traballador 1)</th>
	    <th>KIIK(Traballador 2 - 10)</th>
	    <th>MEDIO(Traballador 11-50)</th>
	    <th>BO'OT (+51)</th>
	</tr>
    </thead>

    <tfoot>
	<tr>
	    <th><?php echo $this->t( 'Total Geral', 375 ); ?></th>
	    <th><?php echo $this->data['total']['mikro']; ?></th>
	    <th><?php echo $this->data['total']['kiik']; ?></th>
	    <th><?php echo $this->data['total']['medio']; ?></th>
	    <th><?php echo $this->data['total']['boot']; ?></th>
	</tr>
	<tr>
	    <th><?php echo $this->t( 'Percentagem', 383 ); ?></th>
	    <th><?php echo $this->data['perce']['mikro']; ?>%</th>
	    <th><?php echo $this->data['perce']['kiik']; ?>%</th>
	    <th><?php echo $this->data['perce']['medio']; ?>%</th>
	    <th><?php echo $this->data['perce']['boot']; ?>%</th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->data['rows'] as $row ) : ?>
	    <tr>
		<td><?php echo $row['distrito']; ?></td>
		<td><?php echo $row['mikro']; ?></td>
		<td><?php echo $row['kiik']; ?></td>
		<td><?php echo $row['medio']; ?></td>
		<td><?php echo $row['boot']; ?></td>
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
		    text: '<?php echo $this->t( 'Volume negocio', 422 ); ?> (%)'
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
				return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
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