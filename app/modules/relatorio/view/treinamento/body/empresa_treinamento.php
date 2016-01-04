<table class="summary">
    <tr>
    	<th>
    	    <label>
		<?php echo $this->t( 'Total Empresas', 999 ); ?>
    	    </label>
    	</th>
    	<td>
    	    <span class="qtde-summary">
		<?php echo $this->report['empresa_treinamento']['total']; ?>
    	    </span>
    	</td>
    	<th>
    	    <label>
    		<?php echo $this->t( 'Total Treinamento Supervisor', 999 ); ?>
    	    </label>
    	</th>
    	<td>
    	    <span class="qtde-summary">
		<?php echo $this->report['empresa_treinamento']['supervisor']; ?>
    	    </span>
    	</td>
	<th>
    	    <label>
    		<?php echo $this->t( 'Total Treinamento Engenheiro', 999 ); ?>
    	    </label>
    	</th>
    	<td>
    	    <span class="qtde-summary">
		<?php echo $this->report['empresa_treinamento']['engineer']; ?>
    	    </span>
    	</td>
    </tr>
</table>