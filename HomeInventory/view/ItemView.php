<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

   <!-- Viewing of an individual item allowing for editing of an existing item and creation of a new item -->

   <title>Ron's Home Inventory Webapp</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection, tv" />
   <link rel="stylesheet" href="css/style-print.css" type="text/css" media="print" />

   <script>
      function checkAndDeleteItem( name )
      {
         var result = confirm( "Are you sure you want to delete the " + name + " item?" );
         if( result == true )
         {
            window.location='index.php?delete=' + name;
         }
         else
         {
            return false;
         }
      }
   </script>

   <script>
      function validateForm()
      {
         // validate that a name was entered
         if( document.forms[ "itemForm" ][ "update"] .value == "New Item" )
         {
            var x = document.forms[ "itemForm" ][ "name"] .value;
            if( ( x == null ) || ( x == "" ) || ( x == "New Item" ) )
            {
               alert( "Name must entered and it must be unique");
               return false;
            }
         }
         // validate other client side stuff here
      }
   </script>
</head>

<body>
   <div id="wrapper">
      <div class="title">
         <div class="title-top">
         <div class="title-left">
         <div class="title-right">
         <div class="title-bottom">
         <div class="title-top-left">
         <div class="title-bottom-left">
         <div class="title-top-right">
         <div class="title-bottom-right">
            <h1>Ron's <span>Home Inventory</span> Webapp</h1>
            <p>a demo app by Ron Cameron</p>
         </div>
         </div>
         </div>
         </div>
         </div>
         </div>
         </div>
         </div>
      </div>
      <hr class="noscreen" />
      <div class="content">
         <div class="column-left">
            <h3>MENU</h3>
            <a href="#skip-menu" class="hidden">Skip menu</a>
            <ul class="menu">
               <li><a href="./index.html">Home</a></li>
               <li><a href="./index.php">List Items</a></li>
            </ul>
         </div>
         <div id="skip-menu"></div>
         <div class="column-right">
            <div class="box">
               <div class="box-top"></div>
               <div class="box-in">
                  <p>
                  <?php
                     if( $item == NULL )
                     {
                        $name = "New Item";
                        echo "<h2>Create $name</h2>";
                        echo "Fill initial fields to create object<br/>Edit new item to fill in type specific fields<br/><br/>";
                     }
                     else
                     {
                        $name = $item->name; 
                        echo "<h2>Edit $name</h2>";
                        echo "Edit fields and select appropriate button below or 
                           <button name=\"deleteButton\" type=\"text\" value=\"removeItem\" onclick=\"checkAndDeleteItem( '$name' )\">Delete Item</button><br/><br/>";
                     }
                  ?>
                  <form name="itemForm" action="index.php" method="get" onsubmit="return validateForm()">
                  <input type="hidden" name="update" value="<?php echo $name ?>" >
                  <table>
                     <?php
                        if( $item != NULL )
                        {
                           echo '<tr><td>Name:</td><td><input type="text" name="name" value="' . $item->name . '"></td></tr>
                              <tr><td>Type:</td><td>' . $item->type() . '</td></tr>
                              <tr><td>Location:</td><td><input type="text" name="location" value="' . $item->location . '"></td></tr>
                              <tr><td>Description:</td><td><input type="text" name="description" value="' . $item->description . '"></td></tr>
                              <tr><td>Value:</td><td><input type="text" name="value" value="' . $item->value . '"></td></tr>';
                           for( $i = 0; $i < $item->numAdditionalFields(); $i++ )
                           {
                              echo '<tr><td>'.$item->additionalFieldName( $i ).'</td>
                                 <td><input type="text" name="'.$item->additionalFieldName( $i ).'" value="'.$item->additionalFieldValue( $i ).'"></td></tr>';
                           }
                        }
                        else
                        {
                           echo '<tr><td>Name:</td><td><input type="text" name="name" value="' . $name . '"></td></tr>
                              <tr><td>Type:</td><td><select name="type" required>
                                                                        <option value="">-- Type --</option>
                                                                        <option value="Electronics">Electronics</option>
                                                                        <option value="Appliance">Appliance</option>
                                                                        <option value="Furniture">Furniture</option>
                                                                     </select></td></tr>
                              <tr><td>Location:</td><td><input type="text" name="location" value="home"></td></tr>
                              <tr><td>Description:</td><td><input type="text" name="description" value="not set"></td></tr>
                              <tr><td>Value:</td><td><input type="text" name="value" value="$0"></td></tr>';
                        }
                     ?>
                  </table>
                  <br/><br/>
                  <input type="submit" value="Submit"/>
                  <input type="reset" value="Reset"/>
                  <button type="button" value="Cancel" onclick="window.location='index.php'">Cancel</button>
                  </form>
                  </p>
               </div>
            </div>
         </div>
         <div class="cleaner">&nbsp;</div>
      </div>
   </div>
</body>
</html>
