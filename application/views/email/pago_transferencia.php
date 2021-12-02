    <div style=" background-color: #f6f6f6; padding: 0; font-family:'Trebuchet MS'; font-size: 12px;margin: 0 auto; width: 650px;">
        <div style="position: relative; float: left; width: 650px; border: #e0e0e0 1px solid; background-color: #ffffff;">
            <div style="width: 630px; height: auto; margin-left: 10px;">
              <div class="encabezado">
               <img style="border-right:#C7CAD1 3px; float:left;" src="<?php print base_url('/web/img/logo.png'); ?>" title="<?php print trans("email_logo_text")?>" alt="<?php print trans("email_logo_text")?>" />
               <span style="color:#457FBD; font-size:20px;font-weight:bold;padding-top:100px;">{asunto}.</span>
              </div>
              <div style="clear:both" class="principal">
              <br/>
              <h1 style="line-height: 20px; margin: 0px 0px 11px; font-weight: normal;color:#457FBD;font-size: 20px;"><?php print trans('email_estimado')?> {nombre}</h1>
              <br/>
              <p style="line-height: 16px; padding: 0; margin: 0;"><?php print trans('mail_msg_pago_transferencia')?></p>
              </div>
              <div style="border-top:#9B9B9B 20px !important;">
                <div style="border:1px solid #000; margin:2%; width:96%;">
                <ul style="list-style-type:none">
                 <li><b><?php print trans('banco_financiero_internacional')?>:</b> {banco}</li>
                 <li><b><?php print trans('banco_nombre_cuenta')?>:</b> {titularcuenta}</li>
                 <li><b><?php print trans('banco_numero_cuenta')?>:</b> {cuentabanco}</li>
                 <li><b><?php print trans('banco_swift')?>:</b> {swift}</li>
                 <li><b><?php print trans('mail_detalles_reserva')?>:</b></li>
                </ul>
                </div>
                <p style="line-height: 16px; padding: 0; margin: 0;">
                <?php print trans('reserva_estado')?>: <?php print trans('reserva_estado_confirmada_pendiente_pago')?>.
                <br/>
                <?php print trans('reserva_numero_reserva')?>: {no_reserva}
                <br/>
                <?php print trans('titular_reserva')?>: {titular_reserva}
                <br/>
                <?php print trans('titular_tarjeta_credito')?>: {titualar_tarjeta}
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
              <h2 style="line-height: 20px; margin: 0px 0px 11px; font-weight: normal;color:#457FBD;font-size: 18px;" ><?php print trans('mail_datos_usuario_creado')?>:</h2>
              <p style="line-height: 16px; padding: 0; margin: 0;">
              <?php print trans('correo')?>: {email}
              <br/>
              <br/>
              <?php print trans('mail_msg_pie', array('email' => 'jcomercial@gcnacio.gca.tur.cu'))?>
              <br/>
              <a href='{url_sitio}'>Hotel Nacional de Cuba</a>
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