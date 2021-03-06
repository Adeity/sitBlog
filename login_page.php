<?php
session_start();
include_once("reload_cookie.php");
include_once("db_operations.php");
include_once("utils.php");
$_PAGE_TITLE = "Login";

//  function that unsets all error and success messages. Gets at start of php code and at the very end of html serving.
function unset_all_messages() {
    unset($_SESSION["error_code"]);
    unset($_SESSION["login_email_error"]);
    unset($_SESSION["login_password_error"]);
    unset($_SESSION["message"]);
    unset($_SESSION["login_form_email"]);
}

if(isset($_SESSION["logged_user"])){
    $_SESSION["success_message"] = "You are already logged in.";
    header("Location: ".base_path."/success.php");
    exit;
}

//  is method post? if so, proceed
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Save form values
    unset_all_messages();
    $_SESSION["login_form_email"] = $email;

    // Regexes for input values
    $re_email = '/^[a-zA-Z0-9][a-zA-Z0-9-_\.]*@[a-zA-Z0-9-_]+\.[a-zA-Z]{1,24}$/m';
    $re_password = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/m';

    // Validate input
    $is_invalid_input = false;
    if (!preg_match($re_email, $email)){
        //  for validation. if is set, let user know by setting class, via php echo in html code
        $_SESSION["login_email_error"] = "Invalid email".preg_match($re_email, $email);
        $is_invalid_input = true;
    }
    if(!preg_match($re_password, $password)){
        //  for validation. if is set, let user know by setting class, via php echo in html code
        $_SESSION["login_password_error"] = "Invalid password";
        $is_invalid_input = true;
    }
    if($is_invalid_input) {
        $_SESSION["message"] = "Invalid input.";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }

    // Get user by email
    $db_user = get_user_by_email($email);
    if(!$db_user == true) {
        $_SESSION["message"] = "You entered wrong email and/or password.";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }

    // Verify password
    if (!password_verify($password, $db_user["password"])) {
        $_SESSION["message"] = "You entered wrong email and/or password.";
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }

    // Log in!
    $username = $db_user["username"];
    $_SESSION['logged_user'] = $username;
    $_SESSION["success_message"] = "You are now logged in. Welcome ".$username.".";
    header("Location: ".base_path."/success.php");
}
include_once("topbar.php");
?>

<main class="container">
    <div class="d-flex justify-content-center">
        <div class="card" id="login">
            <div class="card-body">
                <form method="post" action="login_page.php" class="form-signin mb-2" name="login" id="loginForm">
                    <div class="d-flex">
                        <i class="fas fa-bug fs-1 d-flex fa-align-start"></i>
                    </div>
                    <h1 class="h3 mb-3 font-weight-normal">Sign in <?php echo session_get("login_email_error", ""); ?></h1>

                    <label for="inputEmail" class="sr-only">Email address</label>
                    <!--  If email is stored (and valid), echo it into form for user-->
                    <!--  Class is-invalid gets set if input was invalid-->
                    <input
                            type="text"
                            id="inputEmail"
                            class="form-control<?php if(session_get("login_email_error", false)){echo ' is-invalid';}?>"
                            placeholder="Email address"
                            required=""
                            autofocus=""
                            name="email"
                            value="<?php echo session_get("login_form_email");?>"
                            pattern="^[a-zA-Z0-9][a-zA-Z0-9-_.]*@[a-zA-Z0-9-_]+.[a-zA-Z]{1,24}$"
                    >
                    <div class="invalid-feedback" id="invalid-email">
                        Please enter a valid email address.
                    </div>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input
                            type="password"
                            id="inputPassword"
                            class="form-control<?php if(session_get("login_password_error", false)){echo ' is-invalid';}?>"
                            placeholder="Password"
                            required=""
                            name="password"
                            pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"
                    >
                    <div class="invalid-feedback" id="invalid-password">
                        Password is atleast 8 characters long, must contain one of each characters: a-b, A-B, 0-9, special char.
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                </form>
                <p class="text-muted">Email address must be of valid format.</p>
                <p class="text-muted">Password must be 8 characters long, contain one lowercase character, one uppercase character, one number, one special character!</p>
                <p class="text-center">Not registered yet?<a href="register_page.php" class="text-decoration-none"> Register</a></p>
            </div>
        </div>
    </div>
    <div class="text-center pt-3 text-danger">
        <?php if(isset($_SESSION["message"])){echo $_SESSION["message"];} ?>
    </div>

</main>
<script>
    //  frontend validation using regex
    $("#loginForm").submit(function(event){
        $("#invalid-email").hide();
        $("#invalid-password").hide();

        //  if this stays true, form gets sent
        var isValid = true;

        //  Set RegexExpressions
        var reEmail = new RegExp("^[a-zA-Z0-9][a-zA-Z0-9-_\.]*@[a-zA-Z0-9-_]+\.[a-zA-Z]{1,24}$");
        var rePassword = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$");

        //  Sets variables of input forms and removes red border should there be one
        inputEmail = $("input[name=email]");
        inputEmail.removeClass("is-invalid");
        inputEmailValue = inputEmail.val();
        inputPassword = $("input[name=password]");
        inputPassword.removeClass("is-invalid");
        inputPasswordValue = inputPassword.val();

        //  test regex, if doesnt pass then is invalid
        if (!reEmail.test(inputEmailValue)){
            console.log(inputEmailValue)
            inputEmail.addClass("is-invalid");
            $("#invalid-email").show();
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
<?php
    include("footer.php");
    unset_all_messages();
?>


