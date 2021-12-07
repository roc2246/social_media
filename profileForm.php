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
            <h1>Edit Your Profile Here</h1>
            <form name="editProfile"  method="post" action="profileForm.php">
                <div id="editProfile">
                    <div class="standardBox">
                        <label for="profilePic">
                            <h4 class="boxHeading">Profile Picture</h4>
                        </label>
                        <input type="file" name="profilePic">
                    </div>

                    <div class="standardBox">
                        <label for="interests">
                            <h4 class="boxHeading">Interests</h4>
                        </label>
                        <input type="text" name="interests">
                    </div>
                    <div class="standardBox">
                        <label for="favoriteMovies">
                            <h4 class="boxHeading">Favorite Movies</h4>
                        </label>
                        <input type="text" name="favoriteMovies">
                    </div>
                    <div class="standardBox">
                        <label for="favoriteBooks">
                            <h4 class="boxHeading">Favorite Books</h4>
                        </label>
                        <input type="text" name="favoriteBooks">
                    </div>
                    <div class="standardBox">
                        <label for="aboutMe">
                            <h4 class="boxHeading">About Me</h4>
                        </label>
                        <textarea name="aboutMe" style="resize:none;margin:10px;"
                         rows="10" cols="50"></textarea>
                   </div>
                </div>
                <div id="editProfileBttn">
                    <input type="submit" name= "submitProfileInfo" value="submit">
                </div>
            </form>
            <br>
            <div id="">
            <h4 style="text-align:center;">Or</h4>
            <h4 style="text-align:center;">
                <a href="userHome.php" style="text-align:center;">
                    Go to your homepage
                </a>
            </h4>
    </main>

   <?php require 'phpComponents/footer.php';?>

</body>