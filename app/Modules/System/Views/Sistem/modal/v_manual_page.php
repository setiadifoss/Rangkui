<div id="manualPageModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Recaptcha V2</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <div class="doc">
                    <p>In the update dated April 13, 2018, Setiadi's development has integrated the <strong>Recaptcha version 2</strong> feature. This feature functions to protect your Setiadi system from <em>spammers</em> attempting to repeatedly access your system, which may affect your server's performance.</p>
                    <p>To use this feature, you need to insert an <em>API</em> key that you can obtain from the following link <br> <a href="https://www.google.com/recaptcha" target="_blank"><strong>https://www.google.com/recaptcha</strong></a>, provided you already have a Gmail account for the <em>logIn</em> process.</p>
                    <p>However, for users operating on a local server such as <em>localhost</em>, you do not need to obtain an <em>API</em> key. Setiadi’s developer has already included an <em>API</em> key that can be used locally only.</p>
                    <p>For users running Setiadi online, you need to update your <em>API</em> key at the link above.</p>
                    <p>Steps to obtain an <em>API</em> key from Google:</p>
                    <ol>
                        <li>Visit the following page <a href="https://www.google.com/recaptcha" target="_blank"><strong>https://www.google.com/recaptcha</strong></a></li>
                        <li>Click the <em><strong>Get reCAPTCHA</strong></em> button at the top right corner.</li>
                        <li>Then, you will be asked to log in with your Gmail account.</li>
                        <li>In the <em>Register a new site</em> section, there is a sub-section labeled "Label" with a text box below it. Enter the label name for the <em>API</em> you are going to use.</li>
                        <li>Next, check the box for <strong>reCAPTCHA v2</strong>.</li>
                        <li>Then, you will see a section labeled <em>Domains</em>.</li>
                        <li>Enter the domain name or IP address you are using to run your Setiadi system in the text box.</li>
                        <li>Next, click the checkbox next to the text <em>Accept the re...</em>.</li>
                        <li>Then click register.</li>
                        <li>After that, a list will appear. Focus on the section labeled <strong>Keys</strong>.</li>
                        <li>Copy and paste the <strong>Site Key</strong> and <strong>Secret Key</strong> into the system module (system > system settings > Recaptcha API Key, click the key icon).</li>
                        <li>Insert the <strong>Site Key</strong> in the text box under <strong>PublicKey</strong>.</li>
                        <li>Insert the <strong>Secret Key</strong> in the text box under <strong>PrivateKey</strong>.</li>
                        <li>Click save, then change the Recaptcha Admin setting to <strong>Enabled</strong> to activate this feature on the Admin login page.</li>
                        <li>Click save, then change the Recaptcha Member setting to <strong>Enabled</strong> to activate this feature on the Member login page.</li>
                    </ol>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>