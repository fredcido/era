<div id="control-bar" class="noPrint">
    <a href="javascript:;" onClick="self.print();" class="button-imprimir">
	<?php echo $this->t( 'Imprimir', 575 ); ?>
    </a>
    <a href="javascript:;" onClick="exporting( 'relatorio/treinamento/topdf/', this );" class="button-pdf">
	<?php echo $this->t( 'Gerar PDF', 576 ); ?>
    </a>
    <a href="javascript:;" onClick="exporting( 'relatorio/treinamento/todoc/', this );" class="button-doc">
	<?php echo $this->t( 'Gerar DOC', 577 ); ?>
    </a>
    <a href="javascript:;" onClick="exporting( 'relatorio/treinamento/toexcel/', this );" class="button-excel">
	<?php echo $this->t( 'Gerar EXCEL', 578 ); ?>
    </a>
    <a href="javascript:;" onClick="self.close();" class="button-close">
	<?php echo $this->t( 'Gerar EXCEL', 579 ); ?>
    </a>
</div>

<script type="text/javascript">
    $( document ).ready(
	function()
	{
	    $( 'body > h1' ).css( 'marginTop', '60px' );
	}
    );
</script>