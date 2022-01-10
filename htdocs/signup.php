
<?php
    require "db.php";

    $data = $_POST;
    if (isset($data['do_signup']))
    {
    if (trim($data['username']) == '')
    {
        $errors[] = 'Please enter correct username';
    }
    if (trim($data['email']) == '')
    {
        $errors[] = 'Please enter correct email';
    }
    if ($data['password'] == '')
    {
        $errors[] = 'Please enter correct password';
    }
    if ($data['password_2'] != $data['password'])
    {
        $errors[] = 'Passwords does not match';
    }
    if (R::count('users', "username = ?", array($data['username'])) > 0)
    {
        $errors[] = "Username already exist!";
    }
    if (R::count('users', "email = ?", array($data['email'])) > 0)
    {
    $errors[] = "Email already exist!";
    }
    if (empty($errors))
    {
     $user = R::dispense('users');
     $user->username = $data['username'];
     $user->email = $data['email'];
     $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
     R::store($user);
     echo '<div>Registration complete!</div><hr>';
    }
    else
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
<form action="" method="post">
    <p>
        <a>
        <input type="text" name="username" placeholder="Please enter username" value="<?php echo @$data['username']; ?>">
        <input type="email" name="email" placeholder="Please enter email" value="<?php echo @$data['email']; ?>">
        <input type="password" name="password" placeholder="Please enter password">
        <input type="password" name="password_2" placeholder="Please confirm password">
        </a>
    </p>
    <p1>
        <a>
        <button type="submit" name="do_signup">Signup</button>
        </a>
    </p1>

</form>
</body>
</html>