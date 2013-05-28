<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

   <!-- Viewing for the item list -->

   <title>Ron's Home Inventory Webapp</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection, tv" />
   <link rel="stylesheet" href="css/style-print.css" type="text/css" media="print" />
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
               <li><a href="./index.php" class="active">List Items</a></li>
            </ul>
      </div>
      <div id="skip-menu"></div>
      <div class="column-right">
         <div class="box">
            <div class="box-top"></div>
            <div class="box-in">
               <h2>Current Home Inventory List</h2>
               <br/>
               <p>Select an item to edit or remove or
               <button type="button" value="New" onclick="window.location='index.php?create=new'">Add New Item</button>
               </p><br/>
               <p>
               <table border = "1">
                  <tr>
                     <th>Name</th>
                     <th>Type</th>
                     <th>Location</th>
                     <th>Description</th>
                     <th>Value</th>
                     <th colspan="2">Additional Information</th>
                  </tr>
                  <?php 
                     foreach( $items as $name => $item )
                     {
                        echo '<tr>
                           <td><a href="index.php?item='.$item->name.'">'.$item->name.'</a></td>
                           <td>'.$item->type().'</td>
                           <td>'.$item->location.'</td>
                           <td>'.$item->description.'</td>
                           <td>'.$item->value.'</td>';
                        for( $i = 0; $i < $item->numAdditionalFields(); $i++ )
                        {
                           echo '<td>'.$item->additionalFieldName( $i ).'</td>
                              <td>'.$item->additionalFieldValue( $i ).'</td>';
                        }
                        echo '</tr>';
                     }
                  ?>
               </table>
               </p>
            </div>
         </div>
         <div class="cleaner">&nbsp;</div>
      </div>
   </div>
</body>
</html>
