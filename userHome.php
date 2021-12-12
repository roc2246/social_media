<?php 

/** 
 * YourSpace User Home Page
 * 
 * PHP version 7.4
 * 
 * @category Pages
 * @package  Pages
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     http://wh963069.ispot.cc/projects/social_media/userHome.php
 */


$pageName = 'User Home';

require 'phpComponents/header.php';
require 'phpComponents/connect.php';

require 'phpLibraries/login.php';


?>
<body>
<?php require 'phpComponents/navigation.php';?>

    <main>
        <div id="user-profile">
            <div id="profile-upper-left">
                <div id="username-and-pic">
                    <h4>Username</h4>
                    <img src="" alt="" width="180" height="200">
                </div>
                <div id="stats">
                    <ul style="list-style-type: none;">
                        <li>Gender</li>
                        <li>Age</li>
                        <li>City</li>
                        <li>State</li>
                        <li>Country</li>
                    </ul><br>
                    <ul style="list-style-type: none;">
                        <li>Last Login:</li>
                        <li>Last Login Date</li>
                    </ul>
                </div>
            </div>
            <p>View My: <a href="">Pics</a> | <a href="">Videos</a></p>
            <div id="contacting-user">
                <h4 class="boxHeading">Contacting User</h4>
                <div id="contacting-user-links">
                   <div id="contacting-user-links-left"> 
                       <a href="">
                           <img src="" alt="">
                           Send Message
                        </a>
                   </div>
                   <div id="contacting-user-links-right">
                       <a href="">
                           <img src="" alt="">
                           Add to Friends
                        </a>
                   </div>
                </div>
            </div>
            <div id="user-url">
                <b>YourSpace URL:</b>
                <p style="margin-top:-1px;margin-left:8px;">
                    User URL
                </p>
            </div>
        </div>
    </main>


    <?php require 'phpComponents/footer.php';?>

</body>