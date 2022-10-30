<!DOCTYPE html>
<!-- Declare the language -->
  <html lang = "en">
    <head>
      <!-- Create some set style classes -->
      <style>
        *{
          box-sizing: border-box;
        }
        
        body{
          font-family: Roboto, veranda, sans-serif;
          margin: 10;
          background-color:#FCF3CF;
          height: 800px;

        }
        
        /*Top Title */
        .header{
          padding: 10px;
          text-align: center;
          background: #40E0D0;
          color: #154360;
        }
        
        /*Font in header*/
        .header h1{
        font: size: 30px;
        }

        /* Style the tab */
        .tab {
          overflow: hidden;
          border: 1px solid #ccc;
          background-color: #f1f1f1;
        }
        
        /* Style the buttons inside the tab */
        .tab button {
          background-color: inherit;
          float: left;
          border: none;
          outline: none;
          cursor: pointer;
          padding: 14px 16px;
          transition: 0.3s;
          font-size: 17px;
        }
        
        /* Change background color of buttons on hover */
        .tab button:hover {
          background-color: #ddd;
        }
        
        /* Create an active/current tablink class */
        .tab button.active {
          background-color: #ccc;
        }
        
        /* Style the tab content */
        .tabcontent {
          padding: 6px 12px;
          border: 1px solid #ccc;
          border-top: none;
        }

        /*Button Style*/ 
        .pressbutton {
          margin:10px;  
          width:200px;
          background-color:#ddd; 
          border:double #154360; 
          color:#154360; 
          font-size:15px; 
          text-align:center; 
          font-weight:bold; 
          min-height:40px; 
          font-size:15px; 
          text-align:center;
          padding: 10px;
        }

        /*Create a second button style*/
        .otherbutton {
          margin:10px;  
          width:100px;
          background-color:#E9F7EF; 
          border:soild #154360; 
          color:#154360; 
          font-size:30px;
          font-weight: bold;
          font-family: Veranda;
          text-align:center; 
          min-height:40px; 
          font-size:15px; 
          text-align:center;
          padding: 10px;
        }

        /*Create a third button style*/
        .pressbuttontwo {
          margin:10px;  
          width:200px;
          background-color:#E9F7EF; 
          border:double #154360; 
          color:#154360; 
          font-size:15px; 
          text-align:center; 
          font-weight:bold; 
          min-height:40px; 
          font-size:15px; 
          text-align:center;
          padding: 10px;
        }

        /*Bottom Footer (branding purposes) */
        .footer {
          position: fixed;
          text-align: center;
          bottom: 0px;
          width: 99%;
          background-color: DarkSalmon;
          color: white;
          
        }
      </style>
    </head>

    <body>
        <!-- Create the website header -->
      <div class="header">
        <h1> The Restock Tracker </h1>
        <p> Account of Products.</p>
      </div>

      <div class="tab">
        <!--Navigation back to the home page-->
        <a href = "Main.html">
          <button class="tablinks">Home</button> </a>
        <a href = "ProductEntry.html">
          <button class="tablinks"> Add Products </button> </a>
        <a href = "ProductView.php">
          <button class="tablinks"> View Products </button> </a>
        <a href = "ProductEdit.html">
          <button class="tablinks" > Edit Products </button> </a>
        <a href = "index.html">
          <button class = "tablinks" style = "position:absolute; right:10px"> Log Out </button> </a>
      </div>

      
      <!--Create a path for viewing products -->
      <div id="viewproduct" class="tabcontent" >
        <div style="width:225px; height:450px; position:absolute; left:8px; top:220px; border:1px solid #000; background-color:#F9EBEA">
          <p style="position:absolute; top:1px; left:30px; font-size:15px; font-family:Garamond"> Select a Category:</p>
          <br><br><br>
          <form method="post">
            <button class="pressbuttontwo" name="toiletries" type="submit">Toiletries</button>
            <button class="pressbuttontwo" name = "Kitchen" type = "submit">Kitchen</button>
            <button class="pressbuttontwo" name = "Cleaning" type = "submit">Cleaning</button>
            <button class="pressbuttontwo" name = "Supplies" type = "submit">Supplies</button> 
            <button class="pressbuttontwo" name = "PersonalCare" type = "submit">Personal Care</button>
            <button class="pressbuttontwo" name = "Other" type = "submit">Other</button>
          </form>
       </div>


          
          <?php
            if(array_key_exists('toiletries', $_POST)) {
            display('toiletries');
        } else if (array_key_exists('Kitchen', $_POST)){
              display('Kitchen');
        }else if (array_key_exists('Cleaning', $_POST)){
              display('Cleaning');
        }else if (array_key_exists('Supplies', $_POST)){
              display('Supplies');
        }else if (array_key_exists('PersonalCare', $_POST)){
              display('PersonalCare');
        }else if (array_key_exists('Other', $_POST)){
              display('Other');
            }
             function display($filename){
               echo "<div style=\"width:600px; position:absolute; left:300px; top:250px; min-height:100px; border-color:#ddd; border: double 5px; background-color:#40E0D0\">
         <p style=\"font-weight:bold; position:absolute; top:0px; left:5px;\"> Product Name</p>
          <p style=\"font-weight:bold; position:absolute; top:0px; left:150px;\"> Entry Date</p>
          <p style=\"font-weight:bold; position:absolute; top:0px; left:300px;\"> Finish Date</p>
          <p style=\"font-weight:bold; position:absolute; top:0px; left:450px;\"> Days to Finish</p>";
                $fp = fopen ( $filename.".csv" , "r" );
               //$newLine = "</br>";
                echo "</br>";
                while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) {
                  $i = 0;
                  foreach($data as $row) { 
                    if ($i == 0){
                      echo "<p style=\" padding:1px; position:absolute; left:5px;\" > $row </p>";
                    } else if ($i == 1){
                      $rows = explode(".", $row);
                      echo "<p style=\" padding:1px; position:absolute; left:150px;\" > $rows[0] / $rows[1] </p>";
                    } else if ($i == 2){
                      $rows = explode(".", $row);
                      echo "<p style=\"  padding:2px; position:absolute; left:300px;\" > $rows[0] / $rows[1] </p>";
                    } else if ($i == 3){
                      echo "<p style=\" padding:1px; position:absolute; left:450px;\" > $row </p>";
                    }
                    $i ++;
                   
                  }
                  echo "</br> ";
                  echo "</br>";
                  }
                fclose ( $fp );
              }
          ?>
        </div>
      </div>

      <div class="footer">
          <p> Author: Ritika Roy </p>
      </div>
    </body>
  </html>