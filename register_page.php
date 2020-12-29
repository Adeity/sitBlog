<?php
$title = "sitBlog"; include("head.php");
include("topbar.php");
include("db_operations.php");

$read_json = file_get_contents(__DIR__ . '/data_users.json');
$data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);
$message = "";

function add_user_to_database($email, $username, $password){
    global $data;
    $user = array(
        "email" => htmlspecialchars($email),
        "username" => htmlspecialchars($username),
        "password" => $password
    );
    $data = array_merge($data, array($user));
    $json_db = json_encode(
        $data,
        JSON_PRETTY_PRINT
    );
    file_put_contents('data_users.json', $json_db);
}

function is_in_database($identificator, $db_identificator){
    global $data;
    foreach ($data as $user){
        if ($user[$db_identificator] == $identificator){
            return true;
        }
    }
    return false;
}

function clear_all_sessions(){
    $_SESSION["reg_email"] = "";
    $_SESSION["reg_username"] = "";
    $_SESSION["message"] = "";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // input
    $email = htmlspecialchars($_POST["email"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];

    // Save form values
    unset_all_messages();
    $_SESSION["login_form_email"] = $email;

    // Regexes for input values
    $re_email = '/^[a-zA-Z0-9][a-zA-Z0-9-_\.]*@[a-zA-Z0-9-_]+\.[a-zA-Z]{1,24}$/m';
    $re_username = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/m';
    $re_password = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/m';
    $_SESSION["reg_email"] = $email;
    $_SESSION["reg_username"] = $username;
    $_SESSION["reg_error"] = "";
    $re = '/^[a-zA-Z0-9][a-zA-Z0-9-_\.]*@[a-zA-Z0-9-_]+\.[a-zA-Z]{1,24}$/m';
    preg_match_all($re, $email, $matches, PREG_SET_ORDER, 0);
    if ($matches[0][0] != $email){
        clear_all_sessions();
        $_SESSION["reg_error"] = "email";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }
    $re = '/[a-zA-Z0-9]+/m';
    preg_match_all($re, $username, $matches, PREG_SET_ORDER);
    if ($matches[0][0] != $username){
        $_SESSION["reg_username"] = "";
        $_SESSION["message"] = "";
        $_SESSION["reg_error"] = "username";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }
    $re = '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$';
    preg_match_all($re, $_POST["password"], $matches, PREG_SET_ORDER);
    if($matches[0][0] != $_POST["password"]){
        $_SESSION["message"] = "";
        $_SESSION["reg_error"] = "password";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }
    if (is_in_database($email, "email")){
        $_SESSION["message"] = "Email already registered";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }
    else if (is_in_database($_POST["username"], "username")){
        $_SESSION["message"] = "Username already registered";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }
    else{
        $pwd = $_POST['password'];
        $pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);
        add_user_to_database($email, $username, $pwd_hashed);
        clear_all_sessions();
        $_SESSION["reg_error"] = "";
        $_SESSION["success_message"] = "Registration successful.";
        header("Location: /semestralka/success.php");
    }
    exit;
}
?>


<main class="container">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form method="post" action="register_page.php" class="form-signin mb-2">
                    <div class="d-flex pb-1">
                        <i class="fas fa-bug fs-1 d-flex fa-align-start"></i>
                    </div>
                    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" id="inputEmail" class="form-control <?php if(isset($_SESSION["reg_error"]) && $_SESSION["reg_error"] == "email"){echo 'wrong-input';}?>" placeholder="Email address" required="" autofocus="" name="email" <?php if(isset($_SESSION["reg_email"])){echo 'value="'.htmlspecialchars($_SESSION["reg_email"]).'"';}?>>
                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text" id="inputUsername" class="form-control <?php if(isset($_SESSION["reg_error"]) && $_SESSION["reg_error"] == "username"){echo 'wrong-input';}?>" placeholder="Username" required="" autofocus="" name="username" <?php if(isset($_SESSION["reg_username"])){echo 'value="'.htmlspecialchars($_SESSION["reg_username"]).'"';}?>>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control <?php if(isset($_SESSION["reg_error"]) && $_SESSION["reg_error"] == "password"){echo 'wrong-input';}?>" placeholder="Password" required="" name="password">
                    <button class="btn btn-primary btn-block mt-2" type="submit">Sign up</button>
                </form>
                <p class="text-muted">Email address must be of valid format.</p>
                <p class="text-muted">Username can only contain characters a-b, A-B, 0-9.</p>
                <p class="text-muted">Password must be 8 characters long, contain one lowercase character, one uppercase character, one number, one special character.</p>
                <p class="text-center">Already registered? <a href="login_page.php" class="text-decoration-none">Log in</a> </p>
            </div>
        </div>
    </div>
    <div class="text-center d-flex justify-content-center pt-3">            <?php
        if(isset($_SESSION["message"])){echo $_SESSION["message"];}
        ?></div>
</main>





