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
	    <th></th>
	    <th colspan="4"><?php echo $this->t( 'Diretor / Gênero', 412 ); ?></th>
	</tr>
	<tr>
	    <th><?php echo $this->t( 'Distrito', 96 ); ?></th>
	    <th colspan="2"><?php echo $this->t( 'Homem', 373 ); ?></th>
	    <th colspan="2"><?php echo $this->t( 'Mulher', 374 ); ?></th>
	</tr>
	<tr>
	    <th></th>
	    <th><?php echo $this->t( 'Quantidade', 413 ); ?></th>
	    <th>%</th>
	    <th><?php echo $this->t( 'Quantidade', 413 ); ?></th>
	    <th>%</th>
	</tr>
    </thead>

    <tfoot>
	<tr>
	    <th><?php echo $this->t( 'Total Geral', 375 ); ?></th>
	    <th><?php echo $this->data['total_homens']; ?></th>
	    <th><?php echo $this->data['total_homens_porcent']; ?> %</th>
	    <th><?php echo $this->data['total_mulheres']; ?></th>
	    <th><?php echo $this->data['total_mulheres_porcent']; ?> %</th>
	</tr>
    </tfoot>

    <tbody>
	<?php foreach ( $this->data['rows'] as $row ) : ?>
	    <tr>
		<td><?php echo $row['distrito']; ?></td>
		<td><?php echo $row['total_homens']; ?></td>
		<td><?php echo $row['total_homens_porcent']; ?> %</td>
		<td><?php echo $row['total_mulheres']; ?></td>
		<td><?php echo $row['total_mulheres_porcent']; ?> %</td>
	    </tr>
	<?php endforeach; ?>
    </tbody>
</table>

<div id="grafico-pizza" class="grafico-report"></div>
<div id="grafico-barra" class="grafico-report"></div>

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
			text: '<?php echo $this->t( 'Participantes por curso', 384 ); ?> (%)'
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
			    data: <?php echo json_encode( $this->data['graph_pie'] ); ?>
			}]
		});


		chartBar = new Highcharts.Chart({
		    chart: {
			renderTo: 'grafico-barra',
			type: 'bar'
		    },
		    title: {
			text: '<?php echo $this->t( 'Beneficiário Homem x Mulher para cada curso', 385 ); ?> (%)'
		    },
		    xAxis: {
			categories: <?php echo json_encode( $this->data['graph_bar']['cursos'] ); ?>,
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
	    }
	);
	
</script>