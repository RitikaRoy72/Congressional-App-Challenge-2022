<!DOCTYPE html>

<?php
/*A function to storethe information about products. */

class ProductEntry {
  function __construct($type, $name, $days, $amount, $enterday, $left, $rate){
    $this -> type = $type;
    $this -> name = $name; 
    $this -> days = $days;
    $this -> amount = $amount;
    $this -> enterday = $enterday;
    $this -> left = $left;
    $this -> rate = $rate;
  }

  function write(){
    /*A function to write the information to a file */
    //Create an array with the new information
    $writefile = array([$this->name, $this->enterday, $this->left, $this->rate]);
    //Open and write the file
    $file = fopen($this->type.".csv", "a");
    foreach($writefile as $i){
      fputcsv($file, $i);
    }
    //Close the file
    fclose($file);
  }

  function getname(){
    /*A function to get the name from a csv file*/
    $file = fopen("name.csv", "r");
    while (!feof($file)){
      $lines[] = fgetcsv($file, 100, ",");
    }
    fclose($file);
    $this -> name = $lines[0][0];
  }
  
  function findleft(){
    /*A function to determine how much of a product is left*/
    //Find out how many days until the product runs out if new entry
    $this->left = $this -> amount * $this ->days;
    $this->rate = $this->left;
  }
  
  function date(){
    //WORK ON THISSSSSS
    /* A function to determine and write the date of entry in a form that can be manipulated. */
    //A class in the event that a product takes more than a year to finish
   //Set the date date_default_timezone_set('EST');
    $datemonth = date("F");
    $dateday = date("d");
    $months = array("January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    //Use a loop to find the month
    for ($n = 0; $n<11; $n ++){
      if ($datemonth == $months[$n]){
        $n ++;
        $monthnum = $n;
        break;
      }
    }
    //Write the date in numerical format
    $this->enterday = $monthnum + ($dateday/100);
    //echo $this->enterday;
    $left = $this->rate;

   //Create a loop to find out the day the product runs out
    while (true){
      if ($monthnum == "2"){
        //If the month is febuary
        if ($left < (28 - $dateday)){
          //If the product takes less than a month to finish
          $dateday = $dateday + $left;
          //Terminate function
          break;
        } else {
          //If the product takes more than a month the finish
          $left = $left - (28-$dateday);
          $dateday = 0;
          //Increment the month
          $monthnum++;
        }

      } else if ($monthnum == "4" || $monthnum == "6" || $monthnum == "9" || $monthnum == "11"){
        //If the month has 30 days
        if ($left < (30 - $dateday)){
          //If the product takes less than a month to finish
          $left = $dateday + $left;
          break;
        } else {
          //If the product takes more than a month to finish
          $left = $left - (30-$dateday);
          $dateday = 0;
          $monthnum++;
        }

      } else if ($monthnum == "1" || $monthnum == "3" || $monthnum == "5" || $monthnum == "7" || $monthnum == "8" || $monthnum == "10" || $monthnum == "12"){
        //If the month has 31 days
        if ($left <= (31 - $dateday)){
          //If the product takes less than a month to finish
          $left = $dateday + $left;
          //Terminate the function
          break;
        } else {
          //If the product takes more than a year to finish
          $left = $left - (31-$dateday);
          $dateday = 0;
          $monthnum++;
          //Ensure to increment the year if need be
          if ($monthnum == 13){
            $monthnum = $monthnum - 12;
          }
        }
      }
    }
    //Assemble the date
    $this -> left = $monthnum + $left/100;
  }
      
  function checkduplicate(){
   /*Check if a product appears twice in the records*/
    //Read the file into an array
    $file = fopen($this->type.".csv", "r");
    while (!feof($file)){
     $lines[] = fgetcsv($file, 100, ",");
    }
    //Close the reading file
    fclose($file);
    //Sift through the array
    //Eliminate elements that have the same name
    $a = 0;
    $count = count($lines);
    while ($a < $count){
      $data1 = $lines[$a][0];
      $aa = $a + 1;
      while ($aa < ($count-1)){
        $data2 = $lines[$aa][0];
        if ($data1 == $data2){
          //$lines = array_diff($lines,[$a]);
          unset($lines[$a]);
        }
        $aa ++;
      }
      $a ++;
    }
    //Delete the old file
    unlink($this->type.".csv");
    //Write the array into a new file with the same name
    $rewrite = fopen($this->type.".csv", "a");
    $count = 0;
    foreach ($lines as $ii){
      if ($count < count($lines)-1){
        fputcsv($rewrite, $ii);
      }
      $count ++;
    }
  }  
  
  function enter(){
    /*A function to call entry operations in respective order*/
    $this -> getname();
    $this->findleft();
    $this->date();
    $this->write();
    $this->checkduplicate();
  }

  function restock(){
    /*A function to caal restock operation in order*/
    $this->date();
    $this->write();
    $this->checkduplicate();
  }
} 

$type = $_GET["category"];
$days = $_GET["userate"];
$amount = $_GET["packamnt"];
$enterday = 0;
$left = 0;
$name = 0;
$rate = 0;
$restocker = new ProductEntry($type, $name, $days, $amount, $enterday, $left, $rate);
$restocker -> enter();

?>

<html>
  <body>
  <meta http-equiv="refresh" content="0;  URL=ProductEntry.html"> 
  </body>
</html>


