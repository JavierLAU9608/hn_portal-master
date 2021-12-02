<?php $profiler =  getProfilerResumen() ?>
<script>
    $(document).ajaxComplete(function (event, xhr, settings) {

        if (settings.url.indexOf("<?php echo base_url("profiler/resumen") ?>") !== -1) {
            return;
        }
        if (settings.url.indexOf("<?php echo base_url("profiler/preference") ?>") !== -1) {
            return;
        }

        try {
            var c = $('#profiler-ajax-count');
            c.html(parseInt(c.html()) + 1);
            c.addClass('btn-danger');
            blink(c);

            $.ajax({
                method: 'get',
                url: '<?php echo base_url("profiler/resumen") ?>',
                dataType: 'JSON',
                data: {},
                success: function (data) {
                    setProfileItem($('#profiler-db-count'), data.db);
                    setProfileItem($('#profiler-lang-count'), data.lang);
                    setProfileItem($('#profiler-email-count'), data.email);
                }
            });
        } catch (e) {
        }
    });

    function setProfileItem(obj, new_cant)
    {
        var cant = parseInt(obj.html());
        if (cant != new_cant) {
            $('#profiler-bar').show();
            obj.html(new_cant);
            obj.addClass('btn-danger');

            blink(obj);
        }
    }

    function blink(obj)
    {
        var f = function () {
            if (obj.hasClass('btn-primary')) {
                obj.removeClass('btn-primary')
            } else {
                obj.addClass('btn-primary')
            }
        };
        for (var i = 200; i < 1800; i+=100) {
            window.setTimeout(f, i);
        }
    }

    function toggleProfiler() {
        try {
            var bar = $('#profiler-bar');
            bar.toggle();

            $.ajax({
                method: 'get',
                url: '<?php echo base_url("profiler/preference") ?>',
                //dataType: 'JSON',
                data: {'option': 'visible_bar', 'value': bar.css('display')},
                cache: false
            });
        } catch (e){}

    }
</script>

<div id="profiler-bar">
    <nav class="navbar navbar-inverse navbar-fixed-bottom">
        <div class="navbar-left">
            <a target="_blank" class="navbar-brand" href="<?php echo $profiler['preference']['userguide_url'] ?>"><i class="glyphicon glyphicon-question-sign"></i></a>
            <a target="_blank" class="navbar-brand" href="<?php echo $profiler['preference']['panel_url'] ?>"><i class="glyphicon glyphicon-lock"></i></a>

            <a class="navbar-brand" href="javascript:">@<?php echo $profiler['controller'] ?>/<?php echo $profiler['method'] ?></a>
            <a class="navbar-brand" href="javascript:"><?php echo elapseTime($profiler['time_start']) ?> ms</a>
            <a class="navbar-brand" href="javascript:"><?php echo $profiler['memory'] ?> MB</a>
        </div>


        <ul class="nav navbar-nav navbar-left">
            <li>
                <a href="<?php echo base_url("profiler") ?>" target="_blank" title="Consultas SQL">
                    <i class="glyphicon glyphicon-tasks"></i> <span class="badge <?php echo $profiler['db'] > 50 ? 'btn-primary' : null ?>" id="profiler-db-count"><?php echo $profiler['db'] ?></span></a>
            </li>
            <li>
                <a href="<?php echo base_url("profiler/lang") ?>" target="_blank" title="Traducciones faltantes">
                    <i class="glyphicon glyphicon-text-background"></i> <span class="badge <?php echo $profiler['lang'] > 0 ? 'btn-primary' : null ?>" id="profiler-lang-count"><?php echo $profiler['lang'] ?></span></a>
            </li>
            <li>
                <a href="<?php echo base_url("profiler/email") ?>" target="_blank" title="Correos enviados">
                    <i class="glyphicon glyphicon-envelope"></i> <span class="badge <?php echo $profiler['email'] > 0 ? 'btn-primary' : null ?>" id="profiler-email-count"><?php echo $profiler['email'] ?></span></a>
            </li>
            <li id="profiler-ajax-item">
                <a href="<?php echo base_url("profiler") ?>" target="_blank" title="Peticiones Ajax">
                    <i class="glyphicon glyphicon-transfer"></i> <span class="badge" id="profiler-ajax-count">0</span></a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right" style="margin-right: 40px;">
            <li>
                <a href="javascript:">MyProfiler v<?php echo $profiler['version'] ?></a>
            </li>
        </ul>

    </nav>
</div>

<div style="position: fixed; right: 0; bottom: 0px; z-index: 10000;">
    <a style="height: 51px;padding-top: 17px" id="profiler-btn-toggle" class="btn btn-primary" href="javascript:toggleProfiler()">
        <i class="glyphicon glyphicon-object-align-right"></i>
    </a>
</div>

