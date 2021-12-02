<!DOCTYPE html>
<html lang="en">

    <?php include 'partial/_head.php' ?>

    <body>

        <div id="content" class="container">
            <div id="main">
                <div id="collector-wrapper">
                    <div id="collector-content">

                        <h2>Correos enviados (<?php echo $total_mail ?>)</h2>
                        <?php if ($total_mail > 0) { ?>
                        <a href="<?php echo base_url('profiler/clearmails') ?>">Borrar correos</a>

                        <table>
                            <thead>
                                <tr>
                                    <th>To</th>
                                    <th>Subject</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($mails as $item) { ?>
                                <tr>
                                    <td><?php displayArray($item['to']) ?></td>
                                    <td><?php echo $item['subject'] ?></td>
                                    <td>
                                        <a data-target="<?php echo $item['message'] ?>" href="#" onclick="javascript:showEmail(this)"><?php echo $item['message'] ?></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>

                    </div>
                </div>

                <?php include 'partial/_sidebar.php' ?>

                <form action="<?php base_url('profiler/mailshow'); ?>" id="form_email">
                    <input id="input_file" type="hidden" name="file"/>
                </form>
            </div>
        </div>

        <div id="content_email">

        </div>

        <?php include 'partial/_footer.php' ?>
    </body>
</html>