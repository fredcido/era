<table>
    <tr>
	<td style="width:1%">
	    <img alt="" src="<?php echo BASE; ?>/public/images/segmentation.png" />
	</td>
	<td>
	    <h1><?php echo $this->t( 'Evolução treinadores', 365 ); ?> </h1>
	</td>
	<td style="width:1%">
	    <span><?php echo date( 'd/m/Y H:i:s' ); ?></span>
	</td>
    </tr>
</table>

<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Ladiak', 391 ); ?></th>
	    <th><?php echo $this->t( 'Sufisiente', 392 ); ?></th>
	    <th><?php echo $this->t( 'Diak', 393 ); ?></th>
	    <th><?php echo $this->t( 'Diak Liu', 394 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	</tr>
    </thead>

    <tfoot>
	<tr>
	    <th><?php echo $this->t( 'Skor', 395 ); ?>: 0 - 1</th>
	    <th><?php echo $this->t( 'Skor', 395 ); ?>: 1.1 - 2</th>
	    <th><?php echo $this->t( 'Skor', 395 ); ?>: 2.1 - 2.9</th>
	    <th><?php echo $this->t( 'Skor', 395 ); ?> = 3</th>
	    <th>-</th>
	</tr>
    </tfoot>

    <tbody>
	<?php if ( !empty( $this->data['perc'] ) ) : ?>
	
	    <tr>
		<td><?php echo $this->data['rows']['LADIA']; ?></td>
		<td><?php echo $this->data['rows']['SUFIS']; ?></td>
		<td><?php echo $this->data['rows']['DIAK']; ?></td>
		<td><?php echo $this->data['rows']['DIAL']; ?></td>
		<td><?php echo $this->data['rows']['TOTAL']; ?></td>
	    </tr>
	    <tr>
		<td><?php echo $this->data['perc']['LADIA']; ?>%</td>
		<td><?php echo $this->data['perc']['SUFIS']; ?>%</td>
		<td><?php echo $this->data['perc']['DIAK']; ?>%</td>
		<td><?php echo $this->data['perc']['DIAL']; ?>%</td>
		<td>100%</td>
	    </tr>
	    
	<?php endif; ?>

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
		    text: '<?php echo $this->t( 'Evaluasaun ba Treinamentu sira', 396 ); ?> (%)'
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
			data: [
			    ['<?php echo $this->t( 'Ladiak', 391 ); ?>',   <?php echo $this->data['rows']['LADIA']; ?> ],
			    ['<?php echo $this->t( 'Sufisiente', 392 ); ?>',    <?php echo $this->data['rows']['SUFIS']; ?> ],
			    ['<?php echo $this->t( 'Diak', 393 ); ?>',    <?php echo $this->data['rows']['DIAK']; ?>],
			    ['<?php echo $this->t( 'Diak Liu', 394 ); ?>',    <?php echo $this->data['rows']['DIAL']; ?>]
			]
		    }]
	    });
	});

    });
</script>