<div class="animate form login_form">

    <section class="login_content">
        <form action="<?= base_url('login/auth') ?>" enctype="multipart/form-data" method="POST">
            <h1>Login</h1>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="text-center text-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required />
            </div>
            <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required />
            </div>
            <div>
                <button type="submit" class="btn btn-primary submit">Login</button>
            </div>

            <div class="clearfix"></div>


            <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                    <h1><a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/Difoss-Header.png') ?>" alt="logo difoss" width="150px"></a></h1>
                    <span><a href="<?= base_url('oai?verb=ListRecords&metadataPrefix=oai_dc') ?>">OAI PMH</a></span>
                    <div>Designed &amp; Developed By <a href="https://setiadifoss.org">DIFOSS</a></div>
                    <code>Version : 4.1.0</code> | <code>Code name : Rangkui</code>
                </div>
            </div>
        </form>
    </section>
</div>