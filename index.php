<?php 

/** 
 * YourSpace Main Page
 * 
 * PHP version 7.4
 * 
 * @category Pages
 * @package  Pages
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     http://wh963069.ispot.cc/projects/social_media/index.php
 */

$pageName = 'Homepage';

 require 'phpComponents/header.php';
 require 'phpComponents/connect.php';

 require 'phpLibraries/login.php';


?>
<body>
<script src="jsLibraries/validate.js"></script>

    <header>
        <h1>yourspace</h1>
        <h4>not <i>my</i> space!</h4>
    </header>

    <nav>
        <!--Echo dropdown here for user-->
        <a href="index.php">home</a> |
    </nav>

    <main>
        <div id="homeContent">
            <div id="statusFeed">
                <h4 id="feedHeading">The Daily Chatter</h4>
            </div>
                <form id="loginForm" name='login' method='post'>
                    <h4>Login</h4>
                    <input type="text" name='user' placeholder="username">
                    <input type="password" name='password' placeholder="password">
                    <input type="submit" name= "submit" value="submit" 
                    onclick="submitForm('login', 'index.php')">
                    <?php login('users', '2', ''); ?><br>
                    <a id="myBtn" style="cursor: pointer;" >Register User</a>
                </form>
        </div>

        <!-- New User Popup-->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
               <span class="close">&times;</span>
               <h4 style="text-align:center;">Register New User</h4>
               <form method="post" name="newUser">
                   <input type="text" name="email" placeholder="email"><br>
                   <input type="text" name="user" placeholder="username"><br>
                   <input type="password" name="password" placeholder="passowrd"><br>
                   <input type="submit" name= "submitNewUser" value="submit" 
                   onclick="submitForm('newUser', 'index.php')" >
                   <!-- <h4>Registration Status:</h4> -->
                   <?php checkAvailable('users', 'index.php');?>
               </form>
            </div>

        </div>

    </main>

    <footer>
        <p>Copyright 2021</p>
    </footer>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>

</body>
</html>