<?php

require ROOTPATH . "admin/setting.php";

$_SESSION['IS_WORKING'] = 1;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DIFOSS INSTALLER</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('difoss/assets/css/bd-wizard.css'); ?>">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="javascript:void(0)"><img src="<?= base_url('assets/images/Difoss-Header.png') ?>" alt="DIFOSS logo" style="height: 50px;"></a>
            </div>
        </nav>
    </header>
    <main class="d-flex align-items-center">
        <div class="container">
            <div id="wizard">
                <h3>System Requirement</h3>
                <section>
                    <h5 class="bd-wizard-step-title">System Requirement</h5>
                    <h2 class="section-heading">Check System</h2>
                    <p>Before installing this application, let's first check the system requirements.</p>
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>Configuration</th>
                                <th>Requirement</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PHP Version</td>
                                <td> >= <?= $minPhpVersion; ?></td>
                                <td>
                                    <?php
                                    if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
                                        $message = sprintf(
                                            'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
                                            $minPhpVersion,
                                            PHP_VERSION
                                        );
                                        echo '<i class="fa fa-times text-danger"></i> ' . $message;
                                    } else {
                                        echo '<i class="fa fa-check text-success"></i> PHP : ' . PHP_VERSION;
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>PHP Extension</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php foreach ($php_ext as $extension): ?>
                                <tr>
                                    <td></td>
                                    <td><?= $extension; ?></td>
                                    <td>
                                        <?php if (!extension_loaded($extension)): ?>
                                            <i class="fa fa-times text-danger"></i>Extension has not been activated
                                        <?php else: ?>
                                            <i class="fa fa-check text-success"></i>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td>Session</td>
                                <td></td>
                                <td>
                                    <?php if (isset($_SESSION['IS_WORKING'])): ?>
                                        <i class="fa fa-check text-success"></i>
                                    <?php else: ?>
                                        <i class="fa fa-times text-danger"></i>Session not working
                                    <?php endif ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <h3>Installation Type</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Installation Type</h5>
                    <h2 class="section-heading">Select Installation type </h2>
                    <div class="purpose-radios-wrapper row">
                        <div class="purpose-radio">
                            <input type="radio" name="purpose" id="branding" class="purpose-radio-input" value="fresh" checked>
                            <label for="branding" class="purpose-radio-label">
                                <span class="label-icon">
                                    <img src="./difoss/assets/images/icon_branding.svg" alt="fresh install" class="label-icon-default">
                                    <img src="./difoss/assets/images/icon_branding_green.svg" alt="fresh install green" class="label-icon-active">
                                </span>
                                <span class="label-text">New Install</span>
                            </label>
                        </div>

                        <div class="purpose-radio">
                            <input type="radio" name="purpose" id="web-design" class="purpose-radio-input" value="upgrade">
                            <label for="web-design" class="purpose-radio-label">
                                <span class="label-icon">
                                    <img src="./difoss/assets/images/icon_web_design.svg" alt="upgrade" class="label-icon-default">
                                    <img src="./difoss/assets/images/icon_web_design_green.svg" alt="upgrade green" class="label-icon-active">
                                </span>
                                <span class="label-text">Upgrade to latest</span>
                            </label>
                        </div>
                    </div>
                </section>
                <h3>Configuration</h3>
                <section id="step2-content">
                    <section id="fresh"></section>
                </section>
                <h3>Review Installation</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Review Installation</h5>
                    <h2 class="section-heading mb-5">Review your Details and installing</h2>
                    <h6 class="font-weight-bold">Installation Type: </h6>
                    <p class="mb-4" id="install-type"></p>
                    <p class="mb-4" id="progress-install"></p>
                </section>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="<?= base_url('difoss/assets/js/jquery.steps.min.js'); ?>"></script>
    <script src="<?= base_url('difoss/assets/js/bd-wizard.js'); ?>"></script>
</body>

</html>