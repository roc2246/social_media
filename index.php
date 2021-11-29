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
                    <input type="text" name='user' placeholder="email/username">
                    <input type="password" name='password' placeholder="password">
                    <input type="button" name= "submit" value="submit" 
                    onclick="submitForm('login', 'index.php')">
                </form>
        </div>
    </main>

    <footer>
        <p>Copyright 2021</p>
    </footer>


</body>
</html>