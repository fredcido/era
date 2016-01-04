<div id="menu-relatorio">
    <ul>
	<li><a href="<?php echo BASE; ?>/relatorio"><?php echo $this->t( 'Home', 423 ); ?></a></li>
	<li><a href="<?php echo BASE; ?>/"><?php echo $this->t( 'Sistema', 610 ); ?></a></li>
	<li>
	    <a href="javascript:;"><?php echo $this->t( 'Contrato', 37 ); ?></a>
	    <ul>
                <li><a href="<?php echo BASE; ?>/relatorio/contrato/index"><?php echo $this->t( 'Summary', 999 ); ?></a></li>
                <li><a href="<?php echo BASE; ?>/relatorio/contrato/record"><?php echo $this->t( 'Contract Record', 651 ); ?></a></li>
                <li><a href="<?php echo BASE; ?>/relatorio/contrato/batch"><?php echo $this->t( 'Batch', 652 ); ?></a></li>
                <li><a href="<?php echo BASE; ?>/relatorio/contrato/group"><?php echo $this->t( 'Contract Groups', 687 ); ?></a></li>                
	    </ul>
	</li>
	<li>
	    <a href="<?php echo BASE; ?>/relatorio/treinamento/"><?php echo $this->t( 'Treinamento', 210 ); ?></a>
<!--	    
	    <ul>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/andamentomes"><?php echo $this->t( 'Andamento por Mês', 424 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/atividades"><?php echo $this->t( 'Atividades treinadores', 425 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/curso"><?php echo $this->t( 'Cursos', 219 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/desempenho"><?php echo $this->t( 'Desempenho no treinamento', 364 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/evolucao"><?php echo $this->t( 'Evolução treinadores', 365 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/listatreinamento"><?php echo $this->t( 'Lista treinamento', 366 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/participantesdistritosexo"><?php echo $this->t( 'Participantes por distrito/sexo', 367 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/participanteseducacao"><?php echo $this->t( 'Participantes por por nível de educação', 368 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/participantesgrupoidade"><?php echo $this->t( 'Participantes por grupo de idade', 369 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/participantessexo"><?php echo $this->t( 'Participantes por sexo', 370 ); ?></a></li>
		<li><a href="<?php echo BASE; ?>/relatorio/treinamento/pordistrito"><?php echo $this->t( 'Treinamento por distrito', 371 ); ?></a></li>
	    </ul>
	    -->
	</li>
	<li>
	    <a href="javascript:;"><?php echo $this->t( 'Empresa', 415 ); ?></a>
	    <ul>
                <li><a href="<?php echo BASE; ?>/relatorio/empresa/generodiretor"><?php echo $this->t( 'Empresa por gênero de diretor', 408 ); ?></a></li>
                <li><a href="<?php echo BASE; ?>/relatorio/empresa/listaempresa"><?php echo $this->t( 'Lista empresa', 409 ); ?></a></li>
                <li><a href="<?php echo BASE; ?>/relatorio/empresa/pordistrito"><?php echo $this->t( 'Empresas por distrito', 410 ); ?></a></li>
                <li><a href="<?php echo BASE; ?>/relatorio/empresa/setor"><?php echo $this->t( 'Setores da empresa', 421 ); ?></a></li>
                <li><a href="<?php echo BASE; ?>/relatorio/empresa/volumenegocio"><?php echo $this->t( 'Empresa por volume de negócio', 411 ); ?></a></li>
	    </ul>
	</li>
	<li>
	    <a href="javascript:;"><?php echo $this->t( 'M&E', 999 ); ?></a>
	    <ul>
                <li><a href="<?php echo BASE; ?>/relatorio/me/"><?php echo $this->t( 'Summary', 999 ); ?></a></li>
                <li><a href="<?php echo BASE; ?>/relatorio/me/baseendline"><?php echo $this->t( 'Baseline / Endline', 999 ); ?></a></li>
                <li><a href="<?php echo BASE; ?>/relatorio/me/questionnaire"><?php echo $this->t( 'Questionnaire', 999 ); ?></a></li>
	    </ul>
	</li>
    </ul>
</div>