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


$pageName = 'Edit Profile';

require 'phpComponents/header.php';
require 'phpComponents/connect.php';

require 'phpLibraries/login.php';


?>
<body>
<?php require 'phpComponents/navigation.php';?>

    <main>
        <div id="editProfile">
            <h1>Edit Your Profile Here</h1>
                <form name="editProfile"  method="post" action="profileForm.php">
                    <label for="profilePic">Profile Picture</label>
                    <input type="file" name="profilePic"><br><br>
                    <label for="aboutMe">About Me</label><br>
                    <textarea name="aboutMe"></textarea><br><br>
                    <label for="interests">Interests</label><br><br>
                    <input type="text" name="interests"><br><br>
                    <label for="favoriteMovies">Favorite Movies</label><br><br>
                    <input type="text" name="favoriteMovies"><br><br>
                    <label for="favoriteBooks">Favorite Books</label><br><br>
                    <input type="text" name="favoriteBooks"><br><br>
                    <input type="submit" name= "submitProfileInfo" value="submit">
            </form>
        </div>
    </main>

   <?php require 'phpComponents/footer.php';?>

</body>