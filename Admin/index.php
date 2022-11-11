<?php require_once ("inc/header.php"); ?>

<div class="row">
    <div class="col-lg-4 m-auto" >

        <div class="card mt-5">
            <div class="card-header">
                <h3>Login</h3>
            </div>
            <?php
            login_system();
            display_message();
            ?>
            <div class="card-body">
                <form method="POST">
                    <input type="text" class="form-control mb2" placeholder="User Name ou Email" name="username">
                    <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="card-footer">
                <button class="btn btn.sucess" name="btn_login">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once ("inc/footer.php"); ?>
