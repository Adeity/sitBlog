<?php
$title = "sitBlog"; include("head.php");
include_once("topbar.php");
include_once("db_operations.php");
include_once("utils.php");
$read_json = file_get_contents(__DIR__ . '/data_users.json');
$data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);
$message = "";





function unset_all_messages() {
    unset($_SESSION["error_code"]);
    unset($_SESSION["register_email_error"]);
    unset($_SESSION["register_username_error"]);
    unset($_SESSION["register_password_error"]);
    unset($_SESSION["message"]);
    unset($_SESSION["register_form_email"]);
    unset($_SESSION["register_form_username"]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // input
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $_POST['csrfotken'] == $_SESSION['csrftoken'];

    // Save form values
    unset_all_messages();
    $_SESSION["register_form_email"] = $email;
    $_SESSION["register_form_username"] = $username;

    // Regexes for input values
    $re_email = '/^[a-zA-Z0-9][a-zA-Z0-9-_\.]*@[a-zA-Z0-9-_]+\.[a-zA-Z]{1,24}$/m';
    $re_username = '/^[a-zA-Z0-9]*$/m';
    $re_password = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/m';

    $_SESSION["reg_error"] = "";

    // Validate input
    $is_invalid_input = false;
    if (!preg_match($re_email, $email)){
        $_SESSION["register_email_error"] = "Invalid email".preg_match($re_email, $email);
        $is_invalid_input = true;
    }
    if (!preg_match($re_username, $username)){
        $_SESSION["register_username_error"] = "Invalid username".preg_match($re_username, $username);
        $is_invalid_input = true;
    }
    if(!preg_match($re_password, $password)){
        $_SESSION["register_password_error"] = "Invalid password";
        $is_invalid_input = true;
    }
    if($is_invalid_input) {
        $_SESSION["message"] = "Invalid input.";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }

    $db_user = get_user_by_email($email);
    if($db_user){
        $_SESSION["message"] = "Email already registered";
        if($db_user[$username] == $username){
            $_SESSION["message"] = "Email and username already registered";
        }
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }

    $db_user = get_user_by_username($username);
    if($db_user){
        $_SESSION["message"] = "Username already registered";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }

    //  Register!
    $pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
    add_user_to_database($email, $username, $pwd_hashed);
    $_SESSION["success_message"] = "Registration successful.";
    header("Location: /semestralka/success.php");

}
?>


<main class="container">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form method="post" action="register_page.php" class="form-signin mb-2" id="registerForm">
                    <div class="d-flex pb-1">
                        <i class="fas fa-bug fs-1 d-flex fa-align-start"></i>
                    </div>
                    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input
                            type="text"
                            id="inputEmail"
                            class="form-control <?php if(session_get("register_email_error", false)){echo ' is-invalid';}?>"
                            placeholder="Email address"
                            required=""
                            autofocus=""
                            name="email"
                            value="<?php echo session_get("register_form_email");?>"
                            pattern="^[a-zA-Z0-9][a-zA-Z0-9-_.]*@[a-zA-Z0-9-_]+.[a-zA-Z]{1,24}$"
                    >
                    <div class="invalid-feedback" id="invalid-email">
                        Please enter a valid email address.
                    </div>
                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text"
                           id="inputUsername"
                           class="form-control <?php if(session_get("register_username_error", false)){echo ' is-invalid';}?>"
                           placeholder="Username"
                           required=""
                           autofocus=""
                           name="username"
                           value="<?php echo session_get("register_form_username");?>"
                           pattern="^[a-zA-Z0-9]*$"
                    >
                    <input type="hidden" name="csrftoken" value="<?php $_SESSION['CSRFTOKEN'] ?>">
                    <div class="invalid-feedback" id="invalid-username">
                        Username can only contain characters a-b A-B and 0-9.
                    </div>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password"
                           id="inputPassword"
                           class="form-control <?php if(session_get("register_password_error", false)){echo ' is-invalid';}?>"
                           placeholder="Password"
                           required=""
                           name="password"
                           pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"
                    >
                    <div class="invalid-feedback" id="invalid-password">
                        Password is atleast 8 characters long, must contain one of each characters: a-b, A-B, 0-9, special char.
                    </div>
                    <button class="btn btn-primary btn-block mt-2" type="submit">Sign up</button>
                </form>
                <p class="text-muted">Email address must be of valid format.</p>
                <p class="text-muted">Username can only contain characters a-b, A-B, 0-9.</p>
                <p class="text-muted">Password must be 8 characters long, contain one lowercase character, one uppercase character, one number, one special character.</p>
                <p class="text-center">Already registered? <a href="login_page.php" class="text-decoration-none">Log in</a> </p>
            </div>
        </div>
    </div>
    <div class="text-center d-flex justify-content-center pt-3 text-danger">            <?php
        if(isset($_SESSION["message"])){echo $_SESSION["message"];}
        ?></div>
</main>


<?php
include("footer.php");
unset_all_messages();
?>
<script type="application/javascript">
    $("#registerForm").submit(function(event){
        $("#invalid-email").hide();
        $("#invalid-username").hide();
        $("#invalid-password").hide();
        //  Function returns and therefore prevents default:
        var isValid = true;

        //  Set RegexExpressions
        var reEmail = new RegExp("^[a-zA-Z0-9][a-zA-Z0-9-_\.]*@[a-zA-Z0-9-_]+\.[a-zA-Z]{1,24}$");
        var reUsername = new RegExp(/^[a-zA-Z0-9]*$/m);
        var rePassword = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$");

        //  Sets variables of input forms and removes red border should there be one
        inputEmail = $("input[name=email]");
        inputEmail.removeClass("is-invalid");
        inputEmailValue = inputEmail.val();
        inputUsername = $("input[name=username]");
        inputUsername.removeClass("is-invalid");
        inputUsernameValue = inputUsername.val();
        inputPassword = $("input[name=password]");
        inputPassword.removeClass("is-invalid");
        inputPasswordValue = inputPassword.val();

        if (!reEmail.test(inputEmailValue)){
            console.log(inputEmailValue)
            inputEmail.addClass("is-invalid");
            $("#invalid-email").show();
            isValid = false;
        }
        if (!reUsername.test(inputUsernameValue)){
            console.log(inputEmailValue)
            inputUsername.addClass("is-invalid");
            $("#invalid-username").show();
            isValid = false;
        }
        if (!rePassword.test(inputPasswordValue)){
            console.log(inputPasswordValue)
            inputPassword.addClass("is-invalid");
            $("#invalid-password").show();
            isValid = false;
        }
        if(!isValid){
            event.preventDefault();
        }
    });
</script>


