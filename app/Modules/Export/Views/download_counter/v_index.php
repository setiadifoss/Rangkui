<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1">
    <thead>
        <tr>
            <th style="background-color: #2A3F54;color: #fff;">No</th>
            <th style="background-color: #2A3F54;color: #fff;">Title</th>
            <th style="background-color: #2A3F54;color: #fff;">Attachment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($data as $key => $value) :
        ?>
            <tr>
                <td style="vertical-align: top;"><?= $i++ ?></td>
                <td style="vertical-align: top;"><?= $value->title ?></td>
                <td>
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="text-align: center;background-color: #2A3F54;color: #fff;">File Name</th>
                                <th style="text-align: center;background-color: #2A3F54;color: #fff;">Downloads</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($value->attachment as $attachment): ?>
                                <tr>
                                    <td style="vertical-align: top;"><?= $attachment->file_name  ?> </td>
                                    <td style="vertical-align: top;text-align: right; color:<?= $attachment->count > 0 ? "green" : "red" ?>"><?= $attachment->count  ?> downloaded</td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>