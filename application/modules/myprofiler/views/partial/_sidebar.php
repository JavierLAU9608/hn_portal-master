<div id="sidebar">
    <div id="sidebar-shortcuts">
        <div class="shortcuts">
            <a class="btn btn-sm"  href="<?php echo base_url('profiler/clearAll') ?>">Borrar todo</a>
        </div>
    </div>

    <div class="menu-item">
        <a href="<?php echo base_url('profiler') ?>">
            <span class="icon">
                <svg xml:space="preserve" enable-background="new 0 0 24 24" viewBox="0 0 24 24" height="24" y="0px" x="0px" xmlns="http://www.w3.org/2000/svg" version="1.1">
                    <path d="M5,8h14c1.7,0,3-1.3,3-3s-1.3-3-3-3H5C3.3,2,2,3.3,2,5S3.3,8,5,8z M18,3.6c0.8,0,1.5,0.7,1.5,1.5S18.8,6.6,18,6.6s-1.5-0.7-1.5-1.5S17.2,3.6,18,3.6z M19,9H5c-1.7,0-3,1.3-3,3s1.3,3,3,3h14c1.7,0,3-1.3,3-3S20.7,9,19,9z M18,13.6
                    c-0.8,0-1.5-0.7-1.5-1.5s0.7-1.5,1.5-1.5s1.5,0.7,1.5,1.5S18.8,13.6,18,13.6z M19,16H5c-1.7,0-3,1.3-3,3s1.3,3,3,3h14c1.7,0,3-1.3,3-3S20.7,16,19,16z M18,20.6c-0.8,0-1.5-0.7-1.5-1.5s0.7-1.5,1.5-1.5s1.5,0.7,1.5,1.5S18.8,20.6,18,20.6z" fill="#262626"/>
                </svg>
            </span>

            Consultas SQL <?php echo $resumen['db'] ?>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo base_url('profiler/lang') ?>">
            <span class="icon">
                <svg xml:space="preserve" enable-background="new 0 0 24 24" viewBox="0 0 24 24" height="24" width="24" y="0px" x="0px" xmlns="http://www.w3.org/2000/svg" version="1.1">
                    <path d="M5.4,6H7v0.3c0,1.2-0.7,1.9-1.7,1.9c-1.1,0-1.4-0.4-1.4-1.1C3.9,6.2,4.5,6,5.4,6z M9.2,0H2.7
                        C1.2,0,0,0.9,0,2.4v6.5C0,10.4,1.2,11,2.7,11h1.2l3.3,3.2C7.6,14.4,8,14.5,8,14.1c0-1.4,0-2.8,0-4.2c0-0.4,0-0.7,0.1-1.1
                        c-0.1,0-0.3,0-0.4,0C7.4,8.9,7,8.7,7,8.4V7.9c0,0.7-1,1-1.8,1c-1.5,0-2.4-0.7-2.4-2c0-1.3,1.1-2,2.6-2H7V4.5c0-1-0.4-1.6-1.5-1.6
                        C4.8,2.9,4.4,3.1,4,3.6C3.8,3.8,3.8,3.8,3.7,3.8c-0.2,0-0.4-0.2-0.4-0.4c0-0.1,0-0.2,0.1-0.2C3.8,2.5,4.4,2,5.6,2C7.2,2,8,3,8,4.5v3
                        c1-1.4,1.8-2.4,4-2.4c0,0,0-1.9,0-2.7C12,0.9,10.7,0,9.2,0z M20.7,6h-8C10.8,6,9,7.2,9,9v8c0,1.8,2,3.3,4,3.3v3
                        c0,0.5,0.5,0.7,0.9,0.3l4-3.7h2.7c1.8,0,3.3-1.2,3.3-3V9C24,7.2,22.5,6,20.7,6z M13,9c0,0,0.6,0,1.1,0h4.8C19.3,9,20,9,20,9v0.8
                        c0,0-0.7,0.3-1.1,0.3h-4.8C13.7,10,13,9.7,13,9.7V9z M12.5,16.9c-0.2-0.2-0.3-0.3-0.6-0.5c1-0.8,1.8-2.1,2.2-3.4l0.7,0.3
                        C14.2,14.8,13.4,15.9,12.5,16.9z M17,12v4.8c0,0.7-0.2,0.8-1.2,0.8c-0.4,0-1,0-1.4-0.1c0-0.3-0.1-0.4-0.2-0.7
                        c0.6,0.1,0.9,0.1,1.4,0.1c0.4,0,0.4,0,0.4-0.3V12h-2.9c-0.4,0-1.1,0.1-1.1,0.1v-0.8c0,0,0.7-0.4,1.1-0.4h6.8c0.5,0,1.1,0.4,1.1,0.4
                        v0.8c0,0-0.6-0.1-1.1-0.1H17z M20.7,16.8c-1-1.1-1.6-1.9-2.3-3.6L19,13c0.5,1.1,0.8,1.7,1.4,2.4c0.3,0.3,0.5,0.5,0.8,0.9
                        C21.1,16.4,20.9,16.6,20.7,16.8z" fill="#262626"/>
                </svg>
            </span>

            Traducciones <?php echo $resumen['lang'] ?></a>
    </div>
    <div class="menu-item">
        <a href="<?php echo base_url('profiler/email') ?>">
            <span class="icon">
                <svg xml:space="preserve" enable-background="new 0 0 24 24" viewBox="0 0 24 24" height="24" y="0px" x="0px" xmlns="http://www.w3.org/2000/svg" version="1.1">
                    <path d="M22,4.9C22,3.9,21.1,3,20.1,3H3.9C2.9,3,2,3.9,2,4.9v13.1C2,19.1,2.9,20,3.9,20h16.1c1.1,0,1.9-0.9,1.9-1.9V4.9z M8.3,14.1l-3.1,3.1c-0.2,0.2-0.5,0.3-0.7,0.3S4,17.4,3.8,17.2c-0.4-0.4-0.4-1,0-1.4l3.1-3.1c0.4-0.4,1-0.4,1.4,0S8.7,13.7,8.3,14.1z M20.4,17.2c-0.2,0.2-0.5,0.3-0.7,0.3s-0.5-0.1-0.7-0.3l-3.1-3.1c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l3.1,3.1C20.8,16.2,20.8,16.8,20.4,17.2z M20.4,7.2l-7.6,7.6c-0.2,0.2-0.5,0.3-0.7,0.3s-0.5-0.1-0.7-0.3L3.8,7.2c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l6.9,6.9L19,5.8c0.4-0.4,1-0.4,1.4,0S20.8,6.8,20.4,7.2z" fill="#262626"/>
                </svg>
            </span>

            Correos enviados <?php echo $resumen['email'] ?>
        </a>
    </div>

    <div class="menu-item">
        <a href="<?php echo base_url('profiler/config') ?>">
            <span class="icon">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                    <path fill="#262626" d="M15.8,6.4h-1.1c0,0-0.1,0.1-0.1,0l0.8-0.7c0.5-0.5,0.5-1.3,0-1.9l-1.4-1.4c-0.5-0.5-1.4-0.5-1.9,0l-0.6,0.8
                        c-0.1,0,0,0,0-0.1V2.1c0-0.8-1-1.4-1.8-1.4h-2c-0.8,0-1.9,0.6-1.9,1.4v1.1c0,0,0.1,0.1,0.1,0.1L5.1,2.5c-0.5-0.5-1.3-0.5-1.9,0
                        L1.8,3.9c-0.5,0.5-0.5,1.4,0,1.9l0.8,0.6c0,0.1,0,0-0.1,0H1.4C0.7,6.4,0,7.5,0,8.2v2c0,0.8,0.7,1.8,1.4,1.8h1.2c0,0,0.1-0.1,0.1-0.1
                        l-0.8,0.7c-0.5,0.5-0.5,1.3,0,1.9L3.3,16c0.5,0.5,1.4,0.5,1.9,0l0.6-0.8c0.1,0-0.1,0-0.1,0.1v1.2c0,0.8,1.1,1.4,1.9,1.4h2
                        c0.8,0,1.8-0.6,1.8-1.4v-1.2c0,0-0.1-0.1,0-0.1l0.7,0.8c0.5,0.5,1.3,0.5,1.9,0l1.4-1.4c0.5-0.5,0.5-1.4,0-1.9L14.6,12
                        c0-0.1,0,0.1,0.1,0.1h1.1c0.8,0,1.3-1.1,1.3-1.8v-2C17.1,7.5,16.5,6.4,15.8,6.4z M8.6,13c-2.1,0-3.8-1.7-3.8-3.8
                        c0-2.1,1.7-3.8,3.8-3.8c2.1,0,3.8,1.7,3.8,3.8C12.3,11.3,10.6,13,8.6,13z"></path>
                                        <path fill="#262626" d="M22.3,15.6l-0.6,0.2c0,0,0,0.1,0,0l0.3-0.5c0.2-0.4,0-0.8-0.4-1l-1-0.4c-0.4-0.2-0.8,0-1,0.4l-0.1,0.5
                        c0,0,0,0,0,0l-0.2-0.6c-0.2-0.4-0.8-0.5-1.2-0.3l-1.1,0.4c-0.4,0.2-0.8,0.7-0.7,1.1l0.2,0.6c0,0,0.1,0,0.1,0l-0.5-0.3
                        c-0.4-0.2-0.8,0-1,0.4l-0.4,1c-0.2,0.4,0,0.8,0.4,1l0.5,0.1c0,0,0,0,0,0l-0.6,0.2c-0.4,0.2-0.5,0.8-0.4,1.2l0.4,1.1
                        c0.2,0.4,0.7,0.8,1.1,0.7l0.6-0.2c0,0,0-0.1,0,0l-0.3,0.5c-0.2,0.4,0,0.8,0.4,1l1,0.4c0.4,0.2,0.8,0,1-0.4l0.1-0.5c0,0,0,0,0,0
                        l0.2,0.6c0.2,0.4,0.9,0.5,1.2,0.3l1.1-0.4c0.4-0.2,0.8-0.7,0.6-1.1l-0.2-0.6c0,0-0.1,0,0,0l0.5,0.3c0.4,0.2,0.8,0,1-0.4l0.4-1
                        c0.2-0.4,0-0.8-0.4-1l-0.5-0.1c0,0,0,0,0,0l0.6-0.2c0.4-0.2,0.5-0.8,0.3-1.2l-0.4-1.1C23.2,15.9,22.7,15.5,22.3,15.6z M19.9,20.5
                        c-1.1,0.4-2.3-0.1-2.7-1.2c-0.4-1.1,0.1-2.3,1.2-2.7c1.1-0.4,2.3,0.1,2.7,1.2C21.5,18.9,21,20.1,19.9,20.5z"></path>
                </svg>

            </span>

            Configuraciones
        </a>
    </div>

</div>