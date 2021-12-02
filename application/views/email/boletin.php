    <div style="background-color: #f6f6f6; margin: 5px; padding: 0; font-family:'Trebuchet MS'; font-size: 12px; margin: 0 auto; width: 650px;">
        <div style="position: relative; float: left; width: 650px; border: #e0e0e0 1px solid; background-color: #ffffff;">
            <div style="width: 630px; height: auto; margin: 10px;">
              <div class="encabezado">
               <img style="border-right:#C7CAD1 3px; float:left;" title="<?php print trans("mail_logo_alt")?>" alt="<?php print trans("mail_logo_alt")?>" src="<?php print base_url('web/img/logo.png'); ?>" />
               <span style="color:#457FBD; font-size:20px;font-weight:bold;padding-top:100px;">{asunto}</span>
              </div>
              <div style="clear:both" class="principal">              
              <p>
              <br/>
              <?php print trans('mail_msg_boletin'); ?>
              </p>
              </div>
              <div class="subprincipal">
			  {cuerpo_boletin}
              </div>
              <div style="padding:10px 0px 10px 30%;">
                  <a href="{url_cancelar_subscripcion}"><?php print trans('subscripcion_cancelar'); ?></a>
              </div>
              <br/>
              <img src="<?php print base_url('/web/img/correo_barra.png'); ?>" />
              <div style="color:#457FBD;">              
              <h3 style="font-size: 12px;font-weight:normal;color:#636363"><strong><?php print trans('mail_direccion_empresa')?>:</strong></h3>
              <p style="color:#457FBD;">
              {direccion_empresa}
              </p>
              <h3 style="font-size: 12px;font-weight:normal;color:#636363"><strong><?php print trans('mail_telefonos_empresa')?>:</strong></h3>
              <p style="color:#457FBD;">              
              {telefonos_empresa}
               {telefono}
               <br/>
              {/telefonos_empresa}
              </p>
              </div>
            </div>
        </div>
    </div>