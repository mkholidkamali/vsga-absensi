<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Aplikasi Registrasi</title>
</head>
<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("Location: index.php");
	exit;
}

// Include config file
require_once "koneksi.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Check if username is empty
	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter username.";
	} else{
		$username = trim($_POST["username"]);
	}

    // Check if password is empty
	if(empty(trim($_POST["password"]))){
		$password_err = "Please enter your password.";
	} else{
		$password = trim($_POST["password"]);
	}

    // Validate credentials
	if(empty($username_err) && empty($password_err)){

        // Prepare a select statement
		$sql = "SELECT * FROM users";

		if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
			// mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
			$param_username = $username;

            // Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
                // Store result
				mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
				if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
					mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
					if(mysqli_stmt_fetch($stmt)){

						/*
						password_hash(pass, metode); --> untuk enkripsi password ketika
						akan disimpan kedalam basisdata
						password_verify() --> pengecekan, apakah pass yang digunakan untuk login sama atau tidak dengan data yang ada ddalam basis data
						*/

						if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
							session_start();

                            // Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["username"] = $username;                            

                            // Redirect user to welcome page
							header("location: index.php");



						} else{
                            // Password is not valid, display a generic error message
							$login_err = "Invalid username or password.";
						}
					}
				} else{
                    // Username doesn't exist, display a generic error message
					$login_err = "Invalid username or password.";
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}

            // Close statement
			mysqli_stmt_close($stmt);
		}
	}

    // Close connection
	mysqli_close($db);
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



<style>
html, body {
	font-family: 'Roboto', sans-serif;
	margin-left: 20px;
	margin-right: 20px;
	margin-top: 80px;
}
.borderright {
	border-right: 2px solid silver;
}
.borderleft {
	border-left: 2px solid silver;
}
.error {
	border: 1px solid #ff6c6c;
	border-radius: 4px;
	padding: 12px;
	background: #ff7272;
	color: #fff;
}
</style>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-2">
			</div>
			<div class="col-8">
				<form id="formLogin" 
				action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
				 method="post" name="formLogin">
					<?php 
					if(!empty($login_err)){
						echo '<div class="alert alert-danger">' . $login_err . '</div>';
					}        
					?>

					<h1 class="text-center">Login Member </h1>

					<div class="row form-group">
						<div class="col-md-2 text-md-right">
						</div>
						<div class="col-md-8">
							<span id="error" name="error" class="error label"  style="display: none">Name*</span>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 text-md-right">
							<span class="label">Username</span>
						</div>
						<div class="col-md-8">
							<input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
							<span class="invalid-feedback"><?php echo $username_err; ?></span>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 text-md-right">
							<span class="label">Password</span>
						</div>
						<div class="col-md-8">
							<input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
							<span class="invalid-feedback"><?php echo $password_err; ?></span>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 text-md-right">
						</div>
						<div class="col-md-8">
							<button style="width: 200px;" type="submit" class="btn btn-secondary mb-4">login
							</button>
							<button style="width: 200px;" class="btn btn-danger mb-4" type="reset">
								Reset
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>

	</body>
	</html>
	</html>