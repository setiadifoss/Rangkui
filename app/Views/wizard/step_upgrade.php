<h5 class="bd-wizard-step-title">Configuration Database Existing</h5>
<h2 class="section-heading">Configuration Database Existing</h2>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="hostName" class="sr-only">Host</label>
            <input type="text" name="host" id="hostName" class="form-control" placeholder="Host Database" data-config="db" value="<?= $hostName ?? "localhost"; ?>">
        </div>
        <div class="form-group">
            <label for="dbName" class="sr-only">Database</label>
            <input type="text" name="database" id="dbName" class="form-control" placeholder="Database Name" data-config="db" value="<?= $dbName ?? "rangkui"; ?>">
        </div>
        <div class="form-group">
            <label for="userName" class="sr-only">Username</label>
            <input type="text" name="username" id="userName" class="form-control" placeholder="Username Database" data-config="db" value="<?= $userName ?? "root"; ?>">
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>

            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password Database" data-config="db" value="<?= $password ?? ""; ?>">
                <span class="input-group-append" id="show-password" title="Tampilkan password" data-bs-toggle="tooltip">
                    <span class="input-group-text" id="show">
                        <i class="fa fa-eye"></i>
                    </span>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="port" class="sr-only">Port</label>
            <input type="number" name="port" id="port" class="form-control" placeholder="Port Database" value="3306" data-config="db" value="<?= $port ?? "3306"; ?>">
        </div>
    </div>
</div>