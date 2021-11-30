<?php
/** 
 * Functions for logging in, registering usernames, 
 * and logging out.
 * 
 * PHP version 7.4
 * 
 * @category PHP
 * @package  Libraries
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     http://wh963069.ispot.cc/projects/social_media/phpLibraries/login.php
 */


/** 
 * Register Username 
 * 
 * @param string $table     the database table to use
 * @param string $loginPage the name of the login page to redirect to
 * 
 * @return new login credentials
 */
function checkAvailable($table, $loginPage)
{

    /* Validates form data before submission */
    if (empty($_POST['email']) && isset($_POST['submitNewUser']) 
        || empty($_POST['user'])&& isset($_POST['submitNewUser'])
        || empty($_POST['password'])&& isset($_POST['submitNewUser'])
    ) {
        echo "<h4>Please enter a username and password!</h4>";
    } else if (isset($_POST['submitNewUser']) && !empty($_POST)) {
        global $connection;

        $email = $_POST['email'];
        $username = $_POST['user'];
        $password = $_POST['password'];     
        
        $query = "SELECT * from $table where username = '$username'";

        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);

        /* Checks if username is available */
        if ($count>0) {
            /*  echo "User unavailable"; */
            echo "<script>alert('Username is unavailable');</script>";
        } else if ($count == 0) {

            /* Encrypts password */
            $username = mysqli_real_escape_string($connection, $username);   
            $password = mysqli_real_escape_string($connection, $password);
            $hashFormat = "$2y$10$"; 
            $salt = "iusesomecrazystrings22";
            $hashF_and_salt = $hashFormat . $salt;
            $password = crypt($password, $hashF_and_salt);   

            /* Creates New User */
            $query = "INSERT INTO $table(email, username, password) ";
            $query .= "VALUES ('$email','$username', '$password')";  
            /* header('Refresh: 2; URL = ' . $loginPage); */
   
            /* Checks if query is successful */
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("QUERY FAILED" . mysqli_error($connection));    
            } else {
                /* echo "User Created";  */
                echo "<script>alert('User has been registered');</script>";
            }
        }
    } 
}

/** 
 * Greets username 
 * 
 * @return username and logout link
 */
function greetUser()
{
    if (isset($_SESSION['username']) && isset($_SESSION['password'])
    ) {
        echo "<h4>Hello, ".$_SESSION['username']."! 
         <a href='logoutCustomer.php'>Logout</a></h4>";
    }
}

/** 
 * Checks if admin is logged in
 * 
 * @return admin name greeting or error message
 */
function pleaseLoginAdmin() 
{
    if (isset($_SESSION['AMusername']) && isset($_SESSION['AMpassword']) ) {
        echo "<h4>Hello" . " " .$_SESSION['AMusername'] .
         " <a href='logoutAdmin.php'>Logout</a></h4>";
    } else {
        header('Refresh: 0; loginError.php');
    }  
} 

/** 
 * Logs in user or admin
 * 
 * @param string $table     the database table to use
 * @param string $time      the time it takes a successful login to redirect   
 * @param string $otherPara other parameters that may be needed   
 *
 * @return successful or failed login
 */
function login($table, $time, $otherPara) 
{
    global $connection;
    $username = $_POST['user'];
    $password = $_POST['password'];

    /* For decryption */
    $hashFormat = "$2y$10$"; 
    $salt = "iusesomecrazystrings22";
    $hashF_and_salt = $hashFormat . $salt;
    $password = crypt($password, $hashF_and_salt);  

    /* Strores query and query results */
    $query = "SELECT * from $table WHERE username = '$username' ";
    $query .= "AND password = '$password' limit 1";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    
    if (isset($_POST['submit'])) {
        if (isset($username) && isset($password)
            && !empty($username) && $count ==1
        ) {
            $_SESSION['user'] = $username;
            $_SESSION['password'] = $password;

            header("Refresh:". $time .";". $otherPara); 
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
    
            /*  echo "<h1>SUCCESS!</h1>"; */
        } else if ($count ==0 && !empty($username)) {
            echo "</h4>Error: Username/password does not exist!</h4>";
        } else {
            echo "";
        }
    }
}

/** 
 * Echos either the admin page link or admin login link
 * 
 * @return Admin link or Admin logout
 */
function adminPage()
{
    if (isset($_SESSION['AMusername']) && isset($_SESSION['AMpassword'])
    ) {
        echo "<a href='mainAdmin.php'>Admin</a>";
    } else {
        echo "<a href='admin.php'>Admin Login</a>";
    }
} 

/** 
 * Logs out user or admin
 * 
 * @param string $userType the type of user
 * @param string $col1     the first field of the form
 * @param string $col2     the second field of the form
 * @param string $page     the page to be redirected to
 * 
 * @return successful or failed logout
 */
function logout($userType, $col1, $col2, $page) 
{
    echo "<header><h4>" . $userType . ' has logged out.</h4></header>';
    echo "<h4>You will be redirected momentarily.</h4>";

    session_start();
    unset($_SESSION[$col1]);
    unset($_SESSION[$col2]);
  
    header("Refresh: 2; URL = " . $page);
} 

?>