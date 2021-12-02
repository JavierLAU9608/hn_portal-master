<!DOCTYPE html>
<html lang="en">
    <?php include 'partial/_head.php' ?>
    <body>
        <?php
        include_once(__DIR__. '/../libraries/profiler/lib/SqlFormatter.php');
        function realza($val, $limit, $pre = '[', $pos = ']')
        {
            return ($val > $limit ? '<span class="realza">' . $pre. $val .$pos. '</span>' : $pre. $val .$pos);
        }

        function formatQuery($sql, $highlightOnly = false)
        {
            \SqlFormatter::$pre_attributes            = 'class="highlight highlight-sql"';
            \SqlFormatter::$quote_attributes          = 'class="string"';
            \SqlFormatter::$backtick_quote_attributes = 'class="string"';
            \SqlFormatter::$reserved_attributes       = 'class="keyword"';
            \SqlFormatter::$boundary_attributes       = 'class="symbol"';
            \SqlFormatter::$number_attributes         = 'class="number"';
            \SqlFormatter::$word_attributes           = 'class="word"';
            \SqlFormatter::$error_attributes          = 'class="error"';
            \SqlFormatter::$comment_attributes        = 'class="comment"';
            \SqlFormatter::$variable_attributes       = 'class="variable"';

            if ($highlightOnly) {
                $schemas = array('public.', 'auto.', 'circuito.', 'combinado.', 'evento.', 'excursion.', 'hotel.', 'maneja.', 'seguridad.', 'traslado.', 'vuelo.', 'buceo.', 'naturaleza.', 'frontend.', 'nautica.', 'oferta.', 'bar.', 'restaurante.');
                $html = str_replace('"', '', $sql);
                $html = str_replace($schemas, '', $html);
                $html = str_replace(' = ', '=', $html);
                $html = str_replace('=', ' = ', $html);
                $html = \SqlFormatter::highlight($html);;
            } else {
                $html = \SqlFormatter::format($sql);
            }

            return $html;
        }

        function classByTime($time) {
            if ($time >= 0 && $time <= 0.1) {
                return null;
            } elseif ($time > 0.1 && $time <= 0.3) {
                return 'info';
            } elseif ($time > 0.3 && $time <= 0.5) {
                return 'warning';
            }

            return 'danger';
        }

        ?>

        <div id="content" class="container">
            <div id="main">
                <div id="collector-wrapper">
                    <div id="collector-content">

                        <h2 style="color: #262626">Consultas SQL <?php echo realza($total_query + $total_query_ajax, 50) ?>
                            <?php if (isset($queries_ajax)) { ?>
                            - por Ajax <?php echo realza($total_query_ajax, 50); } ?> </h2>

                        <?php if ($total_query > 0 || $total_query_ajax > 0) { ?>
                        <a href="<?php echo base_url('profiler/clearqueries') ?>">Borrar consultas</a>

                        <?php $c = 0 ?>
                        <?php if (isset($queries_ajax)) { ?>
                        <?php foreach ($queries_ajax as $controller => $datos) { ?>

                        <?php foreach ($datos as $url => $items) { ?>
                        <?php $c++ ?>
                        <table class="alt queries-table">
                            <thead>
                                <tr>
                                    <th>###</th>
                                    <th>Time<span></span></th>
                                    <th style="width: 100%;"><?php echo realza(count($items), 50)?> <a href="#" onclick="javascript:togglebody(this)" data-target-id="queries-<?php echo $c ?>"><?php echo $url ?> [Ajax]</a></th>
                                </tr>
                            </thead>

                            <tbody id="queries-<?php echo $c ?>" class="">
                                <?php foreach ($items as $pos => $item) { ?>
                                <?php $pos++ ?>
                                <tr class="<?php echo $pos % 2 == 0 ? 'odd' : 'even' ?>" id="queryNo-<?php echo $pos ?>-<?php echo $c ?>">
                                    <td><?php echo $pos ?></td>
                                    <td class="nowrap"><?php echo round(round($item['time'] * 1000)/1000, 2) ?>&nbsp;ms</td>
                                    <td class="<?php echo classByTime($item['time']) ?>">
                                        <div>
                                            <?php echo realza($item['total_used'], 1) ?>
                                            <?php echo formatQuery(SqlFormatter::compress($item['sql']), true); ?>
                                        </div>

                                        <div class="text-small font-normal">
                                            <a href="#" class="sf-toggle link-inverse"
                                               data-toggle-selector="#formatted-query-<?php echo $c ?>-<?php echo $pos + 1 ?>"
                                               data-toggle-alt-content="Hide formatted query">View formatted query</a>

                                            &nbsp;&nbsp;

                                            <a href="#" class="sf-toggle link-inverse"
                                               data-toggle-selector="#original-query-<?php echo $c ?>-<?php echo $pos + 1 ?>"
                                               data-toggle-alt-content="Hide runnable query">View runnable query</a>
                                        </div>

                                        <div id="formatted-query-<?php echo $c ?>-<?php echo $pos + 1 ?>"
                                             class="sql-runnable hidden sf-toggle-content sf-toggle-hidden">
                                            <?php echo formatQuery($item['sql']) ?>
                                        </div>

                                        <div id="original-query-<?php echo $c ?>-<?php echo $pos + 1 ?>"
                                             class="sql-runnable hidden sf-toggle-content sf-toggle-hidden">
                                            <?php echo $item['sql'] ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                            <?php foreach ($queries as $controller => $datos) { ?>

                        <?php foreach ($datos as $url => $items) { ?>
                        <?php $c++ ?>
                        <table class="alt queries-table">
                            <thead>
                                <tr>
                                    <th>###</th>
                                    <th>Time<span></span></th>
                                    <th style="width: 100%;"><?php echo realza(count($items), 50)?> <a href="#" onclick="javascript:togglebody(this)" data-target-id="queries-<?php echo $c ?>"><?php echo $url ?></a></th>
                                </tr>
                            </thead>

                            <tbody id="queries-<?php echo $c ?>" class="">
                                <?php foreach ($items as $pos => $item) { ?>
                                <?php $pos++ ?>
                                <tr class="<?php echo $pos % 2 == 0 ? 'odd' : 'even' ?>" id="queryNo-<?php echo $pos ?>-<?php echo $c ?>">
                                    <td><?php echo $pos ?></td>
                                    <td class="nowrap"><?php echo round(round($item['time'] * 1000)/1000, 2) ?>&nbsp;ms</td>
                                    <td class="<?php echo classByTime($item['time']) ?>">
                                        <div>
                                            <?php echo realza($item['total_used'], 1) ?>
                                            <?php echo formatQuery(SqlFormatter::compress($item['sql']), true); ?>
                                        </div>

                                        <div class="text-small font-normal">
                                            <a href="#" class="sf-toggle link-inverse"
                                               data-toggle-selector="#formatted-query-<?php echo $c ?>-<?php echo $pos + 1 ?>"
                                               data-toggle-alt-content="Hide formatted query">View formatted query</a>

                                            &nbsp;&nbsp;

                                            <a href="#" class="sf-toggle link-inverse"
                                               data-toggle-selector="#original-query-<?php echo $c ?>-<?php echo $pos + 1 ?>"
                                               data-toggle-alt-content="Hide runnable query">View runnable query</a>
                                        </div>

                                        <div id="formatted-query-<?php echo $c ?>-<?php echo $pos + 1 ?>"
                                             class="sql-runnable hidden sf-toggle-content sf-toggle-hidden">
                                            <?php echo formatQuery($item['sql']) ?>
                                        </div>

                                        <div id="original-query-<?php echo $c ?>-<?php echo $pos + 1 ?>"
                                             class="sql-runnable hidden sf-toggle-content sf-toggle-hidden">
                                            <?php echo $item['sql'] ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                    </div>
                </div>

                <?php include 'partial/_sidebar.php' ?>
            </div>
        </div>

        <?php include 'partial/_footer.php' ?>
    </body>
</html>