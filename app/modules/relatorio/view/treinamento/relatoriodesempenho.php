<table>
    <tr>
	<td style="width:1%">
	    <img alt="" src="<?php echo BASE; ?>/public/images/segmentation.png" />
	</td>
	<td>
	    <h1><?php echo $this->t( 'Desempenho no treinamento', 364 ); ?> </h1>
	</td>
	<td style="width:1%">
	    <span><?php echo date( 'd/m/Y H:i:s' ); ?></span>
	</td>
    </tr>
</table>

<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Melhorou', 386 ); ?></th>
	    <th><?php echo $this->t( 'Igual', 387 ); ?></th>
	    <th><?php echo $this->t( 'Piorou', 388 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	</tr>
    </thead>

    <tbody>
	
	    <tr>
		<td><?php echo $this->data['melhorou']; ?>%</td>
		<td><?php echo $this->data['manteve']; ?>%</td>
		<td><?php echo $this->data['piorou']; ?>%</td>
		<td>100%</td>
	    </tr>

    </tbody>
</table>

<div id="grafico-barra" class="grafico-report"></div>
<div id="grafico" class="grafico-report"></div>

<script type="text/javascript">
    
	$(document).ready(function() {
	    chartPie = new Highcharts.Chart({
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
		    text: '<?php echo $this->t( 'Porcentagem de desempenho do beneficiário', 389 ); ?> (%)'
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
			    enabled: false
			},
			showInLegend: true
		    }
		},
		series: [{
			type: 'pie',
			data: [
			    ['<?php echo $this->t( 'Melhorou', 386 ); ?>', <?php echo $this->data['melhorou']; ?> ],
			    ['<?php echo $this->t( 'Igual', 387 ); ?>', <?php echo $this->data['manteve']; ?> ],
			    ['<?php echo $this->t( 'Piorou', 388 ); ?>', <?php echo $this->data['piorou']; ?>]
			]
		    }]
	    });
	    
	    chartBar = new Highcharts.Chart({
		    chart: {
			renderTo: 'grafico-barra',
			type: 'bar'
		    },
		    exporting: {
			buttons: {
			    printButton: {
				enabled: false
			    }
			}
		    },
		    title: {
			text: '<?php echo $this->t( 'Porcentagem de desempenho do beneficiário', 389 ); ?> (%)'
		    },
		    xAxis: {
			categories: [ '<?php echo $this->t( 'Desempenho', 390 ); ?>' ],
			title: {
			    text: null
			}
		    },
		    yAxis: {
			min: 0,
			labels: {
			    overflow: 'justify'
			}
		    },
		    tooltip: {
			formatter: function() {
			    return ''+
				this.series.name +': '+ this.y;
			}
		    },
		    plotOptions: {
			bar: {
			    dataLabels: {
				enabled: true,
				color: '#000000',
				connectorColor: '#000000',
				formatter: function() {
				    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
				}
			    }
			}
		    },
		    credits: {
			enabled: false
		    },
		    series: [{
			name: '<?php echo $this->t( 'Melhorou', 386 ); ?>',
			data: [<?php echo $this->data['melhorou']; ?>]
		    }, {
			name: '<?php echo $this->t( 'Igual', 387 ); ?>',
			data: [<?php echo $this->data['manteve']; ?>]
		    },
		    {
			name: '<?php echo $this->t( 'Piorou', 388 ); ?>',
			data: [<?php echo $this->data['piorou']; ?>]
		    }]
	    });
	});
</script>