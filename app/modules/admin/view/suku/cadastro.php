<script type="text/javascript" src="<?php echo BASE; ?>/public/scripts/admin/suku.js"></script>
<!--[if !IE]>start title wrapper<![endif]-->
<div class="title_wrapper">
    <span class="title_wrapper_top"></span>
    <div class="title_wrapper_inner">
        <span class="title_wrapper_middle"></span>
        <div class="title_wrapper_content">
            <h2>
                <?php echo $this->t( 'Suku', 0 ); ?> 
            </h2>
	    
	    <?php 
		echo $this->_helper->aba() 
			  ->addButton(
			      array(
				  'class'	=> 'section_back',
				  'url'		=> BASE . '/admin/suku/',
				  'label'	=> 'Listar dados',
				  'trans_id'	=> 9,
				  'role'	=> '/admin/suku/',
				  'operation'	=> 'Consultar'
			      )
			  ); 
	    ?>
        </div>
    </div>
    <span class="title_wrapper_bottom"></span>
</div>
<!--[if !IE]>end title wrapper<![endif]-->

<!--[if !IE]>start section content<![endif]-->

<div class="section_content">
    <span class="section_content_top"></span>

    <div class="section_content_inner">



        <!--[if !IE]>start forms<![endif]-->
        <div class="forms_wrapper">
            <form action="<?php echo BASE; ?>/admin/suku/save/" method="post"  id="form-suku"
                  class="search_form general_form" onsubmit="return save( this );">
                <fieldset>
                    <input name="id_suku" id="id_suku" value="" type="hidden" />
                <div class="forms"> 
                    <div class="abas-form">
                        <!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <label>
                                <?php echo $this->t( 'Distrito', 96 ); ?>:
                                <span>*</span>
                            </label>
                            <div class="inputs">
                                
                                <span class="input_wrapper">
                                    <select class="text required tip-error" name="fk_id_add_district" id="fk_id_add_district"
                                            onChange="carregaCombo( '/me/snapshot/subdistritos/id/' + this.value, 'fk_id_add_subdistrict' );"
                                            msgError="<?php echo $this->t( 'Seleceione o distrito', 97 ); ?>" >
                                        <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

                                        <?php foreach ( $this->distritos as $distrito ) : ?>
                                            <option value="<?php echo $distrito->getIdAddDistrict(); ?>">
                                                <?php echo $distrito->getDistrict(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Distrito', 96 ); ?>"></span>
                            </div>
                        </div>
                        <div class="row">
                            <label>
                                <?php echo $this->t( 'Sub-distrito', 98 ); ?>:
                                <span>*</span>
                            </label>
                            <div class="inputs">
                                <span class="input_wrapper">
                                    <select class="text required tip-error" name="fk_id_add_subdistrict" id="fk_id_add_subdistrict"
                                            msgError="<?php echo $this->t( 'Selecione o sub-distrito', 99 ); ?>" disabled >
                                        <option value=""><?php echo $this->t( 'Selecione', 85 ); ?></option>

                                    </select>
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Sub-distrito', 98 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->
                        <!--[if !IE]>start row<![endif]-->
                        <div class="row">
                            <label>
                                <?php echo $this->t( 'Naran Suku', 0 ); ?>:
                                <span>*</span>
                            </label>
                            <div class="inputs">
                                <span class="input_wrapper">
                                    <input class="text required tip-error" name="suku" id="suku" msgError="<?php echo $this->t( 'Tenki informa Naran Suku', 0 ); ?>" type="text" />
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Naran Suku', 0 ); ?>"></span>
                            </div>
                        </div>
                        <div class="row">
                            <label>
                                <?php echo $this->t( 'Suku Code', 0 ); ?>:
                                <span>*</span>
                            </label>
                            <div class="inputs">
                                <span class="input_wrapper">
                                    <input class="text tip-error" name="acronym" id="acronym" type="text" />
                                </span>
                                <span class="tip-form" title="<?php echo $this->t( 'Suku Code', 0 ); ?>"></span>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->
                        <div class="row row-button">
                            <div class="inputs">
				<?php if ( ILO_Auth_Permissao::has( '/admin/suku/', 'salvar' ) ) : ?>
				    <span class="button blue_button">
					<span><span><?php echo $this->t( 'Salvar', 15 ); ?></span></span>
					<input name="operacao" type="submit" />
				    </span>
				<?php endif; ?>
                            </div>
                        </div>
                        <!--[if !IE]>end row<![endif]-->
                    </div>
                </div>
                </fieldset>
            </form>
        </div>
        <!--[if !IE]>end forms<![endif]-->

        <!--[if !IE]>start section sidebar<![endif]-->


    </div>

    <span class="section_content_bottom"></span>
</div>

<script type="text/javascript">
 
<?php if (!empty($this->dadosForm)) : ?>
            //$( '#form-suku' ).populate( <?php echo json_encode($this->dadosForm); ?> );
<?php endif; ?>    
    
var dataForm = <?php echo json_encode($this->dadosForm); ?>;
  
$( document ).ready(
    function()
    {
        $( '#form-suku' ).populate( dataForm  );
        
        if ( dataForm.fk_id_add_district ) {

		// Busca subdistritos e popula combo
		carregaCombo( 
		    '/me/snapshot/subdistritos/id/' + dataForm.fk_id_add_district, 
		    'fk_id_add_subdistrict',
		    function()
		    {
			$( '#fk_id_add_subdistrict' ).val( dataForm.fk_id_add_subdistrict );
		    }
		);
		    
		// Busca sukus e popula combo
//		carregaCombo( 
//		    '/me/snapshot/sukus/id/' + dataForm.fk_id_add_subdistrict, 
//		    'fk_id_suku',
//		    function()
//		    {
//			$( '#fk_id_suku' ).val( dataForm.fk_id_suku );
//		    }
//		);
	    }
    }
);
 

</script>