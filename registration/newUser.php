<?php 

/** 
 * YourSpace User Registration
 * 
 * PHP version 7.4
 * 
 * @category PHP
 * @package  Registration
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     http://wh963069.ispot.cc/projects/social_media/registration/newUser.php
 */

?>
        <form method="post" name="newUser">
            <input type="text" name="email" placeholder="email"><br>
            <input type="text" name="user" placeholder="username"><br>
            <input type="text" name="password" placeholder="passowrd"><br>
            <input type="submit" name= "submit" value="submit" 
            onclick="submitForm('newUser', 'newUser.php')">
            <h4>Registration Status:</h4>
            <!--insert PHP function here-->
        </form>





