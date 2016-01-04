<table>
    <tr>
	<td style="width:1%">
	    <img alt="" src="<?php echo BASE; ?>/public/images/segmentation.png" />
	</td>
	<td>
	    <h1><?php echo $this->t( 'Andamento por mês', 363 ); ?> </h1>
	</td>
	<td style="width:1%">
	    <span><?php echo date( 'd/m/Y H:i:s' ); ?></span>
	</td>
    </tr>
</table>

<table id="relatorio">
    <thead>
	<tr>
	    <th><?php echo $this->t( 'Mês', 372 ); ?></th>
	    <th><?php echo $this->t( 'Homem', 373 ); ?></th>
	    <th><?php echo $this->t( 'Mulher', 374 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?></th>
	    <th><?php echo $this->t( 'Total', 19 ); ?>(%)</th>
	</tr>
    </thead>
    
    <tfoot>
	<tr>
	    <th><?php echo $this->t( 'Total geral', 375 ); ?></th>
	    <th><?php echo$this->data['total_homens']; ?></th>
	    <th><?php echo$this->data['total_mulheres']; ?></th>
	    <th><?php echo$this->data['total']; ?></th>
	    <th>100%</th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->data['rows'] as $row ) : ?>
	
	    <tr>
		<td><?php echo $row['mes']; ?></td>
		<td><?php echo $row['total_homens']; ?></td>
		<td><?php echo $row['total_mulheres']; ?></td>
		<td><b><?php echo $row['total']; ?></b></td>
		<td><b><?php echo $row['total_porcent']; ?>%</b></td>
	    </tr>
	    
	<?php endforeach; ?>
	    
    </tbody>
</table>

<div id="grafico-pizza" class="grafico-report"></div>
<div id="grafico-barra" class="grafico-report"></div>
<div id="grafico-linha" class="grafico-report"></div>

<script type="text/javascript">
    
	$( document ).ready(
	    function() 
	    {
		chartPie = new Highcharts.Chart({
		    chart: {
			renderTo: 'grafico-pizza',
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
			text: '<?php echo $this->t( 'Beneficiários para cada mês/ano', 376 ); ?> (%)'
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
			    data: <?php echo json_encode( $this->data['graph_pie'] ); ?>
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
		    credits: {
			 enabled: false
		    },
		    title: {
			text: '<?php echo $this->t( 'Participantes Homem x Mulher por mês/ano', 377 ); ?> (%)'
		    },
		    xAxis: {
			categories: <?php echo json_encode( $this->data['graph_bar']['mes'] ); ?>,
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
				enabled: true
			    }
			}
		    },
		    credits: {
			enabled: false
		    },
		    series: [{
			name: '<?php echo $this->t( 'Homens', 373 ); ?>',
			data: <?php echo json_encode( $this->data['graph_bar']['mane'] ); ?>
		    }, {
			name: '<?php echo $this->t( 'Mulheres', 374 ); ?>',
			data: <?php echo json_encode( $this->data['graph_bar']['feto'] ); ?>
		    }]
		});
		
		chartLina = new Highcharts.Chart({
			    chart: {
				renderTo: 'grafico-linha',
				type: 'line'
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
				text: '<?php echo $this->t( 'Porcentagem participantes mês/ano', 378 ); ?>'
			    },
			    xAxis: {
				categories: <?php echo json_encode( $this->data['graph_bar']['mes'] ); ?>
			    },
			    tooltip: {
				formatter: function() {
					return '<b>'+ this.x +'%</b>';
				}
			    },
			    legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'top',
				x: -10,
				y: 100,
				borderWidth: 0
			    },
			    series: [{
				name: '<?php echo $this->t( 'Meses', 379 ); ?>',
				data: <?php echo json_encode( $this->data['graph_line'] ); ?>
			    }]
		    });
	    }
	);
	
</script>