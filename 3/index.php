<?php
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-login.css">
</head>

	    

<div class="main-content">
    <!-- You only need this form and the form-login.css -->

    <form class="form-login" method="post" enctype="multipart/form-data" action="index.php">

        <div class="form-log-in-with-email">

            <div class="form-white-background">

                <div class="form-title-row">
                    <h1>Log in</h1>
                </div>

                <div class="form-row">
                    <label>
                        <span>Who?</span>
                        <input type="text" name="who">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Password</span>
                        <input type="password" name="password">
                    </label>
                </div>

                <div class="form-row">
                    <button type="submit">Log in</button>
                </div>

            </div>              

        </div>            

    </form>

</div>



<?php
if (isset($_POST['who']) && isset($_POST['password']))
{
    $who = filter_input(INPUT_POST, 'who', FILTER_SANITIZE_SPECIAL_CHARS);
    $psw = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (($who == "Me") && ($psw == "4078940"))
    {
        echo '<div class="auth-result">Угадал</div>';
    }
    else if (($who <> "") && ($psw <> ""))    
    {
        echo '<div class="auth-result">Не угадал !!!</div>';
    }
    
}

else 
    
{
//    echo '<div class="auth-result">Не угадал !!!!</div>';
}
    
?>