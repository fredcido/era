<?php require_once 'body/control-bar.php'; ?>
 
<h1>
    <?php echo $this->report['questionnaire']->getFkIdQuestionnaireConfig()->getTitle(); ?>
</h1>

<h3>
    <?php echo $this->report['questionnaire']->getIdentifier(); ?>
</h3>

<div class="container-report">
     <table class="summary" id="relatorio">
	 <tr>
	     <th>
		 <label><?php echo $this->t( 'Distritu', 96 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['questionnaire']->getFkIdAddDistrict()->getDistrict(); ?>
	     </td>
	     <th>
		 <label><?php echo $this->t( 'Sub-distrito', 98 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['questionnaire']->getFkIdAddSubdistrict()->getSubdistrict(); ?>
	     </td>
	 </tr>
	 <tr>
	     <th>
		 <label><?php echo $this->t( 'Suku', 100 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['questionnaire']->getFkIdSuku()->getSuku(); ?>
	     </td>
	     <th>
		 <label><?php echo $this->t( 'Data de registro', 76 ); ?></label>
	     </th>
	     <td>
		 <?php echo ILO_Util_Geral::dateToBr( $this->report['questionnaire']->getDateRegistration() ); ?>
	     </td>
	 </tr>
	 <tr>
	     <th>
		 <label><?php echo $this->t( 'Road location', 626 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['questionnaire']->getRoadLocation(); ?>
	     </td>
	     <th>
		 <label><?php echo $this->t( 'Code', 628 ); ?></label>
	     </th>
	     <td>
		 <?php echo $this->report['questionnaire']->getCode(); ?>
	     </td>
	 </tr>
     </table>
    <hr />
    <table class="summary" id="relatorio">
	<?php foreach ( $this->report['questions'] as $order => $question ) : ?>
	 <tr>
	     <th>
		 <label><?php echo $order . ' - ' . $question['data']['title']; ?></label>
	     </th>
	 </tr>
	 <tr>
	     <td>
		 <?php if ( $question['type'] == 'T' ) : ?>
		    <?php echo @$this->report['answers']['text'][$question['data']['id_text_question']]; ?>
		 <?php else : ?>
		 
		    <table>
			<tr>
			    <?php 
				$cont = 0;
				foreach ( $question['options'] as $id => $option ) : 
				    $cont++;
			    ?>
				    <td>
					[<?php echo @in_array( $id, $this->report['answers']['option'][$question['data']['id_option_question']] ) ? '&times;' : '&nbsp;&nbsp;'; ?>]
					<?php echo $option; ?>
				    </td>
				    
				    <?php if ( $cont % 2 == 0 ) : ?>
					</tr>
					<tr>
				    <?php endif; ?>
			    
			    <?php endforeach; ?>
			</tr>
		    </table>
		 
		 <?php endif; ?>
	     </td>
	 </tr>
	 <?php endforeach; ?>
     </table>
 </div>

<?php require_once 'footer_report.php'; ?>