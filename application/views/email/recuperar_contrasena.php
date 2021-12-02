    <div style="background-color: #f6f6f6; margin: 5px; padding: 0; font-family:'Trebuchet MS'; font-size: 12px; margin: 0 auto; width: 650px;">
        <div style="position: relative; float: left; width: 650px; border: #e0e0e0 1px solid; background-color: #ffffff;">
            <div style="width: 630px; height: auto; margin: 10px;">
              <div class="encabezado">
               <img style="border-right:#C7CAD1 3px; float:left;" title="<?php print trans("mail_logo_alt")?>" alt="<?php print trans("mail_logo_alt")?>" src="<?php print base_url('/web/img/logo.png'); ?>" />
               <span style="color:#457FBD; font-size:20px;font-weight:bold;padding-top:100px;"><?php print trans('mail_asunto_recuperar_contrasenna') ?>.</span>
              </div>
              <div style="clear:both" class="principal">
              <br/>
              <h1 style="line-height: 20px; margin: 0px 0px 11px; font-weight: normal;color:#457FBD;font-size: 20px;"><?php print trans('mail_estimado') ?> {nombre}</h1>
              <p>
              <?php print trans('mail_msg_contrasenna_recueprada') ?>
              </p>
              </div>
              <div class="subprincipal">
                <?php if ($confirm_mail == 'f') { ?>
                  <p style="line-height: 16px; padding: 0; margin: 0;">
                      <?php print trans('mail_msg_usuario_desactivado') ?>
                  </p>
                    <br/><a href="{link_activacion}">{link_activacion}</a>
                <?php } ?>
              <h2 style="font-size: 18px;"><?php print trans('mail_datos_usuario_creado') ?>:</h2>
              <p style="line-height: 16px; padding: 0; margin: 0;">
              <?php print trans('mail_correo') ?>: {correo}
              <br/>
              <?php print trans('mail_contrasena_nueva') ?>: {password}
              <br/>
              <br/>
              <?php print trans('mail_msg_pie', array('email' => 'jcomercial@gcnacio.gca.tur.cu')) ?>
              </p>
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