<!DOCTYPE html>
<html lang="en">

<?php include 'partial/_head.php' ?>

    <body>

        <div id="content" class="container">
            <div id="main">
                <div id="collector-wrapper">
                    <div id="collector-content">

                        <h2>Configuraciones (<?php echo count($config) ?>)</h2>

                        <table class="alt queries-table">
                            <thead>
                                <tr>
                                    <th width="20%">Llave</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($config as $key => $item) {?>
                                    <tr>
                                    <?php
                                        echo '<td>'.$key . '</td>';
                                        echo '<td>';
                                        displayArray($item);
                                        echo '</td>';
                                    ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php include 'partial/_sidebar.php' ?>
            </div>
        </div>

        <?php include 'partial/_footer.php' ?>
    </body>
</html>