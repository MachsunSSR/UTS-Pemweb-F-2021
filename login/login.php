<?php 

// CSV Based connection
function read_csv($spesificId = null){
    $rows = array();
    foreach (file("login.csv", FILE_IGNORE_NEW_LINES) as $line){
        if(isset($spesificId)){
            if($line[0] == $spesificId){
                $rows[] = str_getcsv($line);
            }
        }else{
            $rows[] = str_getcsv($line);
        }  
    }

    return $rows;
}

$data = read_csv();

//Database based Connection

// $server = "localhost";
// $user = "root";
// $pass = "";
// $database = "uts_pemweb";

// $connect = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($connection));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Login Form</title>
    <link rel="icon" href="./assets/ACU.ico" type="image/icon type">
    <link rel="stylesheet" href="login.css">
</head>
<body style="background: <?php echo $data[0][3]; ?>">
<div class="login_container">
            <div class="center">
                <h1>Login</h1>
                <form method="POST">
                    <div class="txt_field">
                        <input type="text" name="username" required />
                        <span></span>
                        <label>Username</label>
                    </div>
                    <div class="txt_field">
                        <input type="password" name="password" required />
                        <span></span>
                        <label>Password</label>
                    </div>
                    <div class="pass">Forgot Password?</div>
                    <Link to="/home">
                        <button
                            class="button-login"
                            type="submit"
                            name="login"
                        >
                            Login
                        </button>
                    </Link>
                    <div class="signup_link">
                        Not a member? <a href="#">SignUp</a>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>

<?php 
if(isset($_POST['login'])){
    $result = 0;
    $username = $_POST['username'];
    $password = $_POST['password'];
    foreach ($data as $row) {
        if($row[1] == $username && $row[2] == $password){
            echo"<script>
                    alert('Berhasil Login!!');
                </script>";
            $result = 1;
            break; 
        }
    }
    if($result == 0){
        echo"<script>
                 alert('GAGAL!! Password atau Username Salah!!');
            </script>";
    }

    //Database Based Connection

    // $query = "SELECT * FROM tlogin WHERE username = '$username' and password = '$password' ";
    // $result = mysqli_query($connect, $query);
    // $cek = mysqli_num_rows($result);
    // if($cek == 1){
    //     echo "      <script>
	// 					alert('Berhasil Login!!');
	// 			     </script>";
    // }else{
    //     echo "      <script>
	// 					alert('GAGAL!! Password atau Username Salah!!');
	// 			     </script>";
    // }
}

?>