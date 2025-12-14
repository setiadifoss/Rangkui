<!-- Gentelella 2 Content Box -->
<div class="x_content">
    <div class="loader" style="display: none;">
        Selamat datang di automasi perpustakaan, saat ini Anda masuk sebagai <strong>Admin</strong>
    </div>
    <div id="mainContent" style="display: block;">
        <div class="x_panel">
            <div class="x_title">
                <h2>Send Mail</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form name="mainForm" id="mainForm" class="form-horizontal form-label-left" method="post" action="/admin/modules/bibliography/sendmail.php?ajaxload=1" target="submitExec" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="db3e0e9f0900e6dff20189dfc94e613f32542d4e6f1931eccaeb243764a26e56">
                    <input type="hidden" name="form_name" value="mainForm">

                    <div class="form-group">
                        <label for="toEmail" class="control-label col-md-3 col-sm-3 col-xs-12">To Email</label>
                        <div class="col">
                            <input type="text" name="toEmail" id="toEmail" class="form-control" value="" maxlength="256">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subjectEmail" class="control-label col-md-3 col-sm-3 col-xs-12">Subject Email</label>
                        <div class="col">
                            <input type="text" name="subjectEmail" id="subjectEmail" class="form-control" value="" maxlength="256">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="emailDesc" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a
                                                href="#"
                                                class="dropdown-toggle"
                                                data-toggle="dropdown"
                                                role="button"
                                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <div
                                                class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Settings 1</a>
                                                <a class="dropdown-item" href="#">Settings 2</a>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div id="alerts"></div>
                                    <div
                                        class="btn-toolbar editor"
                                        data-role="editor-toolbar"
                                        data-target="#editor-one">
                                        <div class="btn-group">
                                            <a
                                                class="btn dropdown-toggle"
                                                data-toggle="dropdown"
                                                title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                                            <ul class="dropdown-menu"></ul>
                                        </div>

                                        <div class="btn-group">
                                            <a
                                                class="btn dropdown-toggle"
                                                data-toggle="dropdown"
                                                title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b
                                                    class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a data-edit="fontSize 5">
                                                        <p style="font-size: 17px">Huge</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-edit="fontSize 3">
                                                        <p style="font-size: 14px">Normal</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-edit="fontSize 1">
                                                        <p style="font-size: 11px">Small</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="btn-group">
                                            <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                                            <a
                                                class="btn"
                                                data-edit="italic"
                                                title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                                            <a
                                                class="btn"
                                                data-edit="strikethrough"
                                                title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                            <a
                                                class="btn"
                                                data-edit="underline"
                                                title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                                        </div>

                                        <div class="btn-group">
                                            <a
                                                class="btn"
                                                data-edit="insertunorderedlist"
                                                title="Bullet list"><i class="fa fa-list-ul"></i></a>
                                            <a
                                                class="btn"
                                                data-edit="insertorderedlist"
                                                title="Number list"><i class="fa fa-list-ol"></i></a>
                                            <a
                                                class="btn"
                                                data-edit="outdent"
                                                title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                                            <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                                        </div>

                                        <div class="btn-group">
                                            <a
                                                class="btn"
                                                data-edit="justifyleft"
                                                title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                            <a
                                                class="btn"
                                                data-edit="justifycenter"
                                                title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                                            <a
                                                class="btn"
                                                data-edit="justifyright"
                                                title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                                            <a
                                                class="btn"
                                                data-edit="justifyfull"
                                                title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                                        </div>

                                        <div class="btn-group">
                                            <a
                                                class="btn dropdown-toggle"
                                                data-toggle="dropdown"
                                                title="Hyperlink"><i class="fa fa-link"></i></a>
                                            <div class="dropdown-menu input-append">
                                                <input
                                                    class="span2"
                                                    placeholder="URL"
                                                    type="text"
                                                    data-edit="createLink" />
                                                <button class="btn" type="button">Add</button>
                                            </div>
                                            <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                                        </div>

                                        <div class="btn-group">
                                            <a
                                                class="btn"
                                                title="Insert picture (or just drag & drop)"
                                                id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                                            <input
                                                type="file"
                                                data-role="magic-overlay"
                                                data-target="#pictureBtn"
                                                data-edit="insertImage" />
                                        </div>

                                        <div class="btn-group">
                                            <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                                            <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                                        </div>
                                    </div>

                                    <div id="editor-one" class="editor-wrapper"></div>

                                    <textarea
                                        name="descr"
                                        id="descr"
                                        style="display: none"></textarea>

                                    <br />

                                    <div class="ln_solid"></div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3">Resizable Text area</label>
                                        <div class="col-md-9 col-sm-9">
                                            <textarea
                                                class="resizable_textarea form-control"
                                                placeholder="This text area automatically resizes its height as you fill in more text courtesy of autosize-master it out..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Send Email</button>
                        </div>
                    </div>
                </form>

                <iframe name="submitExec" class="noBlock" style="visibility: hidden; width: 100%; height: 0;"></iframe>
            </div>
        </div>
    </div>
</div>