<!DOCTYPE html>
<html lang="en">

<?php include 'partial/_head.php' ?>

    <body>

        <div id="content" class="container">
            <div id="main">
                <div id="collector-wrapper">
                    <div id="collector-content">

                        <h2>Traducciones faltantes (<?php echo $total_missing ?>)</h2>

                        <?php if ($total_missing > 0) { ?>
                            <a href="<?php echo base_url('profiler/clearlangs') ?>">Borrar traducciones</a>


                            <table>
                                <thead>
                                    <tr>
                                        <th>Key</th>
                                        <th>Controller</th>
                                        <th>Url</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($missing as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['key'] ?></td>
                                        <td><?php echo $item['controller'] ?></td>
                                        <td><?php echo $item['url'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>


                        <div>
                            <h3>PHP code:</h3>
                            <div>
                                <?php foreach ($missing as $item) { ?>
                                    $lang['<?php echo $item['key'] ?>'] = '<?php echo $item['key'] ?>';<br/>
                                <?php } ?>
                            </div>
                        </div>

                        <?php } ?>
                    </div>
                </div>

                <?php include 'partial/_sidebar.php' ?>
            </div>
        </div>

        <?php include 'partial/_footer.php' ?>
    </body>
</html>