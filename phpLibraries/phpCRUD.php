<?php 

/** 
 * General purpose PHP CRUD functions
 * 
 * PHP version 7.4
 * 
 * @category PHP
 * @package  Libraries
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     http://wh963069.ispot.cc/projects/social_media/phpLibraries/phpCRUD.php
 */

require 'include/connect.php';
global $connection;

//Callback functions for CRUD operations

/** 
 * Returns the field names of a table
 * 
 * @param string $table the name of the table to get field names from 
 * 
 * @return Field names
 */
function getFieldNames($table)
{
    global $connection;
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    if (count($row) >= 0) {
        $query = "SHOW COLUMNS FROM $table";
        $res2 = mysqli_query($connection, $query);
        $fieldNames = array();
        while ($row = mysqli_fetch_assoc($res2)) {
            if ($row['Field'] == '/[\s\S]/'.'id') {
                continue;
            } else {
                array_push($fieldNames, $row['Field']);
            }
        }
        return implode(",", $fieldNames);
    }
}
  

/** 
 * Returns the form input values based off of the field names of a linked table
 * 
 * @param string $table the name of the table to get field names from 
 * 
 * @return Field values
 */
function getFieldValues($table)
{
    global $connection;
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    if (count($row) >= 0) {
        $query = "SHOW COLUMNS FROM $table";
        $res2 = mysqli_query($connection, $query);
        $values = array();
        $fieldNames = explode(",", strval(getFieldNames($table)));
        while ($row = mysqli_fetch_assoc($res2)) {
            if ($row['Field'] == 'image') {
                array_push($values, $_FILES["image"]["name"]);
            }
        }
    }
    for ($i=0; $i<count($fieldNames); $i++) {
        if ($fieldNames[$i]=='image') {
            continue;
        } else {
            array_push($values, $_POST[$fieldNames[$i]]);
        }
    }
      $values = implode("','", $values);
      return $values;
}
/////////////////////////////////////////////////////

////////////////////////CRUD Operations///////////////////////////////////
//Create

/** 
 * Uploads a record
 * 
 * @param string $table the name of the table to uplaod record to
 * 
 * @return Success or Error message
 */
function uploadRecord($table)
{
    if (isset($_POST['submit'])) {
        global $connection;
        $query = "INSERT INTO $table(".getFieldNames($table).") ";
        $query .= "VALUES ('".getFieldValues($table)."')";
        if (mysqli_query($connection, $query)) {
            /* echo "New record created successfully"; */
        } else {
            echo "Error: ".$query."<br><br>".mysqli_error($connection)."<br><br>";
        }
    }
}

//Read

/** 
 * Displays table data in JSON format
 * 
 * @param string $table the name of the table to get data from
 * 
 * @return JSON data
 */
function getapi($table)
{
    header('Content-type: application/json');
    global $connection;
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        header("Content");
        $json =  "[";
        while ($row = mysqli_fetch_assoc($result)) {
            $response = array();
            $columns =  array_keys($row);
            for ($i = 0; $i<count($row); $i++) {
                $response[$columns[$i]] = $row[$columns[$i]];
            }
            $json .= json_encode($response, JSON_PRETTY_PRINT) . ",";
            
        }
        $json = rtrim($json, ",");
        $json .= "]";
    }
    echo $json;
}

//Update  

/** 
 * Updates record
 * 
 * @param string $table    the name of the table to get data from
 * @param string $redirect the name of the page to redirect to on submit
 * 
 * @return Confirmation message
 */
function updateRecords($table, $redirect) 
{
    if (isset($_POST['submit2'])) {  
        global $connection;
        getFieldNames($table);
        getFieldValues($table);
      
        $fieldNames = explode(",", strval(getFieldNames($table)));
        $fieldValues = explode(",", strval(getFieldValues($table)));
  
        $ID = $_POST['/[\s\S]/'.'id'];
    
        $query = "UPDATE $table SET ";
        for ($i=0; $i<count($fieldNames); $i++) {
            if ($fieldNames[$i] == end($fieldNames)) {
                $query .= "$fieldNames[$i] = $fieldValues[$i]'  ";
            } else if ($i == 0) {
                $query .= "$fieldNames[$i] = '$fieldValues[$i],  ";
            } else {
                $query .= "$fieldNames[$i] = $fieldValues[$i], ";
            }
        }
        $query .= "WHERE ".'/[\s\S]/'."'id' = '$ID'";
  
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("QUERY FAILED" . mysqli_error($connection)); 
        } else {
            header('location:'.  $redirect);
        }
    }   
}
  
//Delete 

/** 
 * Deletes record
 * 
 * @param string $table    the name of the table to delete data from
 * @param string $redirect the name of the page to redirect to on submit
 * 
 * @return Confirmation message
 */
function deleteRows($table, $redirect) 
{
    global $connection;
    $ID = $_GET['/[\s\S]/'.'id'];
    $query = "DELETE FROM $table WHERE ".'/[\s\S]/'."'id' = '$ID'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));    
    } else {
        echo "Record Deleted"; 
        header('location:'.  $redirect);
    }
}
/////////////////////////////////////


//Creating A New Form based on database design
  
/** 
 * Creates a form based off of a table
 * 
 * @param string $table            the name of the table 
 * @param string $name             the 'name' attribute of the form
 * @param string $method           the form's method (i.e; get, post, etc.)
 * @param string $other_attributes other attributes for the form
 * @param string $refreshTo        the name of the page to redirect to on submit
 * 
 * @return Confirmation message
 */
function createForm($table, $name, $method, $other_attributes, $refreshTo)
{
    global $connection;
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        header("Content");
        $row = mysqli_fetch_assoc($result);
        if (count($row) >= 0) {
            $query = "SHOW COLUMNS FROM $table";
            $res2 = mysqli_query($connection, $query);
            $fieldNames = array();
            while ($row = mysqli_fetch_assoc($res2)) {
                array_push($fieldNames, $row['Field']);
            
            }
            echo "<form name='".$name."'  method='".$method."' autocomplete='off' ";
            echo "$other_attributes>";
            for ($i = 1; $i<count($fieldNames); $i++) {
                echo "<label>" . ucfirst($fieldNames[$i]) . "</label><br>";
                if ($fieldNames[$i] == 'image') {
                    enableUpload();//Located in images.php
                } else {
                    echo "<input type='text' name='" .$fieldNames[$i] . "'><br><br>";
                }
            }
               echo "<button type='submit' value='submit' name='submit' ";
               echo "onclick='submitForm(". $name. ", ". "\"".$refreshTo."\"" .")'>";
               echo "submit</button>";
               echo "</form>";
        } 
    } else {
        echo "<h1>ERROR</h1>";
    }
}

?>