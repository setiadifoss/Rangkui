<div class="x_content">
    <div class="x_panel tile fixed_height_580">
        <div class="x_title">
            <h2>Visualize Diagram</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="sub_section">
                <div class="author-section">
                    <div id="treeView" style="display:none"></div>
                    <div style="padding-bottom:5%;">
                        <div id="tblAuthor_wrapper" class="dataTables_wrapper no-footer">
                            <table class="table responsive table-striped table-bordered table-hover dt-responsive" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th>Author Name</th>
                                        <th>Author Year</th>
                                        <th>Authority Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $value): ?>
                                        <tr role="row" class="odd" onclick="showMm(<?= $value->author_id ?>, '<?= $value->author_name ?>')" style="cursor: pointer;">
                                            <td class="sorting_1"><?= $value->author_name ?></td>
                                            <td><?= $value->input_date ?></td>
                                            <td><?= getAuthorityName($value->authority_type) ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="jsmind" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>