<?php
session_start();

if (!empty($_SESSION['email'])) {
    $_SESSION = [];
}
$current_data = file_get_contents('data.json');
$array_data   = json_decode($current_data);
if (isset($_POST['email']) && !empty($_POST['email'])) {
    if (file_exists('data.json')) {
        $current_data = file_get_contents('data.json');
        $array_data   = json_decode($current_data);
        $extral       = array(
            'name'     => $_POST['name'],
            'email'    => $_POST['email'],
            'password' => $_POST['password'],
            'image'    => '',
            'images'   => []
        );
        $array_data[] = $extral;
        $finel_data   = json_encode($array_data, JSON_PRETTY_PRINT);
        file_put_contents('data.json', $finel_data);
        header('Location:index.php');
    }
    else {
        echo "lracreq tvyalnery";
    }
}
if (isset($_POST['loginemail']) && isset($_POST['loginpassword'])) {
    $loginemail = $_POST['loginemail'];
    $loginpass  = $_POST['loginpassword'];
}

$ddd       = file_get_contents('data.json');
$sss       = json_decode($ddd);
$emails    = [];
$passwords = [];
foreach ($sss as $key) {
    if (isset($key->email) && isset($key->password)) {
        $emails[]    = $key->email;
        $passwords[] = $key->password;
    }
}
echo "<br>";
echo "<br>";
echo "<br>";
print_r($emails);
echo "<br>";
echo "<br>";
echo "<br>";
print_r($passwords);
echo "<br>";
echo "<br>";
echo "<br>";


if (isset($loginemail) && !empty($loginemail)) {

    for ($i = 0; $i < count($sss); $i++) {
        if ($loginemail == $emails[$i] && $loginpass == $passwords[$i]) {
            $_SESSION['email'] = $emails[$i];
            header("Location: login.php?id=$i");
        }
        elseif ($loginemail != $emails[$i] && $loginpass == $passwords[$i] || $loginemail == $emails[$i] && $loginpass != $passwords[$i]) {
            echo "stugeq tvyalnery";
        }


    }

}

?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form action="index.php" method="post" class="smart-form">
    <fieldset style="width: 30%;margin: auto; text-align: center; background-color: lightblue; border-radius: 12px;">
        <header>Registration</header>
        <section style="margin-top: 20px;">
            <label class="label">Name</label>
            <label class="input">
                <input type="text" placeholder="Name" name="name">
            </label>
        </section>

        <section style="margin-top: 20px;">
            <label class="label">E-mail</label>
            <label class="input">
                <input type="email" placeholder="Email" name="email">
            </label>
        </section>

        <section style="margin-top: 20px;">
            <label class="label">Password</label>
            <label class="input">
                <input type="password" placeholder="Password" name="password">

        </section>

        <button type="submit" name="data" class="btn btn-primary" style="margin-top: 20px; background: lightgreen;">
            registr
        </button>
    </fieldset>


</form>
<form method="post">

    <section
            style="display: flex; flex-direction: column; width: 30%;margin: auto; margin-top: 50px; padding: 25px; background-color: lightgreen; border-radius: 11px;border: 2px solid gray">
        <label class="label" style="margin: auto;">login</label>
        <input type="email" placeholder="Email" name="loginemail" style="margin-top: 20px;">
        <input type="password" placeholder="Password" name="loginpassword" style="margin-top: 20px;">
        <input type="submit" name="submit" style="margin-top: 20px; background: lightblue;">
    </section>

</form>

</body>
<script>

</script>
</html>

