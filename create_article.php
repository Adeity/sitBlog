<?php
$title = "sitBlog"; include("head.php");
include("topbar.php");
include("db_operations.php");

$read_json = file_get_contents(__DIR__ . '/data_users.json');
$data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);
$message = "";



if (isset($_POST["email"])  && isset($_POST["username"]) && isset($_POST["password"])){
    if (is_in_database($_POST["email"], "email")){
        $message = "This email is already registered.";
    }
    if (is_in_database($_POST["username"], "username")){
        $message = "This username is taken.";
    }
    else{
        $pwd = $_POST['password'];
        //$pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
        $pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);
        add_user_to_database($_POST['email'], $_POST['username'], $pwd_hashed);
        $message = "You are now registered.";
    }
}

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



?>

    <main class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pb-2">
                        <i class="fas fa-bug fs-1 d-flex fa-align-start"></i>
                    </div>
                    <?php
                    echo '<p>'.$message.'</p>';
                    echo '<a class="btn btn-primary" href="'.DOCUMENTROOT.'" role="button">Go back</a>';
                    ?>
                </div>
            </div>
        </div>
    </main>
<?php include("footer.php");?>