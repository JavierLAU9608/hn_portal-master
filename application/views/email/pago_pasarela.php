    <div style=" background-color: #f6f6f6; padding: 0; font-family:'Trebuchet MS'; font-size: 12px;margin: 0 auto; width: 650px;">
        <div style="position: relative; float: left; width: 650px; border: #e0e0e0 1px solid; background-color: #ffffff;">
            <div style="width: 630px; height: auto; margin-left: 10px;">
              <div class="encabezado">
               <img style="border-right:#C7CAD1 3px; float:left;" src="<?php print base_url('/web/img/logo_email.jpg'); ?>" title="<?php print trans("email_logo_text")?>" alt="<?php print trans("email_logo_text")?>" />
               <img style="border-right:#C7CAD1 3px; float:right;" src="<?php print base_url('/web/img/logo_GranCaribe.jpg'); ?>" title="<?php print trans("email_logo_text")?>" alt="<?php print trans("email_logo_text")?>" />
<!--               <span style="color:#457FBD; font-size:20px;font-weight:bold;padding-top:100px;">{asunto}.</span>-->
              </div>
              <div style="clear:both" class="principal">
              <br/>
              <h1 style="line-height: 20px; margin: 0px 0px 11px; font-weight: normal;color:#457FBD;font-size: 20px;"><?php print trans('email_estimado')?> {nombre} </h1>
              <br/>
              <p style="line-height: 16px; padding: 0; margin: 0;"><?php print trans('mail_text1')?></p><br/>
              <p style="line-height: 16px; padding: 0; margin: 0;"><?php print trans('mail_text2')?></p><br/>
                  <hr/>
              </div>
              <div style="border-top:#9B9B9B 20px !important;">                
                <p style="line-height: 16px; padding: 0; margin: 0;">
                    <b><?php print trans('mail_text3')?></b><br/>
                <br/>
                    <?php print trans('mail_name')?> {titular_reserva}<br/>
                    <?php print trans('mail_nacionalidad')?> {pais}<br/>
                    <?php print trans('mail_telefono')?> {telefono}<br/>
                    <?php print trans('mail_correo')?> {email}<br/>
                <br/>

                <hr/>
                <b><?php print trans('mail_text4')?></b><br/>

<!--                --><?php //print trans('reserva_estado')?><!--: --><?php //print trans('reserva_estado_pagada')?><!--.-->
<!--                <br/>-->
<!--                --><?php //print trans('reserva_numero_reserva')?><!--: {no_reserva}-->
<!--                <br/>-->
<!---->
<!--                <br/>-->
<!--                --><?php //print trans('titular_tarjeta_credito')?><!--: {titualar_tarjeta}-->
<!--                <br/>-->
<!--                --><?php //print trans('no_transaccion')?><!--: {codigo}-->
<!--                <br/>-->
<!--                --><?php //print trans('pagado_a')?><!--: <b>{pagado_a}</b>-->
                </p>
                <br/>
                <br/>
                <p style="line-height: 16px; padding: 0; margin: 0;">
                <div style="width:90% !important;border:1px solid #000;margin-left:2.5%;padding-left:5%;">                
                 {productos_carrito}
                     {plantilla_producto}
                     <div style="clear:both;margin-top:10px;border-bottom:1px solid"></div>
                 {/productos_carrito}
                 <div style="clear:both;margin-top:10px"></div>
                 <div style="margin-top:20px !important;margin-bottom:10px !important;color:#900;border:2px solid #000;width:92.5%;padding:5px;text-align:center;font-weight:bold;">                 
                 <?php print trans('mail_importe_total')?>: <font>{importe_pagar_carro}</font>
                 </div>                 
                </div>
                </p>
              </div>
              <div style="border-top:#9B9B9B 20px !important;">
                  <br/>
                  <hr/>
                  <b><?php print trans('mail_text5')?></b> <br/><br/>

                  <?php print trans('mail_modalidad')?>: <?php print trans('mail_modalidad_text')?><br/>
                  <?php print trans('reserva_estado')?>: <?php print trans('reserva_estado_pagada')?><br/>
                  <?php print trans('mail_transaccion')?>: {codigo}<br/>
                  <?php print trans('mail_operacion')?>: {no_operacion}<br/>
                  <?php print trans('mail_referencia')?>: {pagado_a}<br/><br/>

                  <p style="line-height: 16px; padding: 0; margin: 0;">
                      <?php echo trans('mail_text6', array('pagado_a' => '{pagado_a}')) ?>
                  </p>

              </div>
              <br/>
                <br/>
                <hr/>
                Hotel Nacional de Cuba <br/> {direccion_empresa} <br/>

              <?php print trans('mail_telefonos_empresa')?>:

              {telefonos_empresa}
               {telefono}

              {/telefonos_empresa}

                <?php echo trans('mail_email') ?> <a href="mailto:jcomercial@gcnacio.gca.tur.cu">jcomercial@gcnacio.gca.tur.cu</a> <br/>

                <br/><br/>
                <p style="line-height: 16px; padding: 0; margin: 0;">
                    <?php echo trans('mail_text7') ?>
                </p><br/>
                <p style="line-height: 16px; padding: 0; margin: 0;">
                    <?php echo trans('mail_text8') ?>
                </p><br/>
                <p style="line-height: 16px; padding: 0; margin: 0;">
                    <?php echo trans('mail_text_cancelar', array('correo' => $email_cancelacion)) ?>
                </p>
                <br/><br/>
                <p style="line-height: 16px; padding: 0; margin: 0;font-size: 10px;">
                    <?php echo trans('mail_add') ?>
                </p>
                <br/>
            </div>
        </div>
    </div>