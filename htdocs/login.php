<?php
    require "db.php";

    $data = $_POST;
    if (isset($data['do_login']))
    {
        $errors = array();
        $user = R::findOne('users', 'username = ?', array($data['username']));
        if($user)
        {
        if (password_verify($data['password'], $user->password))
        {
            $_SESSION['logged_user'] = $user;
            echo '<div>Welcome!</div><hr>';
        }
        else
        {
            $errors[] = 'Incorrect password!';
        }
        }
        else
        {
            $errors[] = 'Username does not exist!';
        }
        if ( ! empty($errors))
        {
            echo '<div id="errors">'.array_shift($errors).'</div><hr>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DWMT</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
<form action="login.php" method="post">
    <p>
        <a>
        <input type="text" name="username" placeholder="Please enter username" value="<?php echo @$data['username']; ?>">
        <input type="password" name="password" placeholder="Please enter password">
        <button type="submit" name="do_login">Login</button>
        </a>
    </p>
</form>
</body>
</html>