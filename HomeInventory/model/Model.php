<?php

/*
 * Model.php
 * file containing the model class that will manipulate the
 * model data 
 * rjc - 5/26/2013
 */

include_once("model/Item.php");

// function itemSort() used by PHP builtin function usort() 
// to sort the item data based on type then alphabetical 
// by name
function itemSort( $aItem, $bItem )
{
   if( $aItem->type() == $bItem->type() )
   {
      return( $aItem->name < $bItem->name ) ? -1 : 1;
   }
   return ( $aItem->type() < $bItem->type() ) ? -1 : 1;
}

/*
 * Model class
 * class to contain the basic functionality of the model data.
 * Items are saved in a flat file named "Inventory.txt" (shame
 * on me for using constants in the code).  The data is 
 * presented as an array referenced by name, thus the name
 * of an item must be unique.
 */
class Model 
{
   // function to provide a list of item retrieved from persistent 
   // storage.  An initial hard coded list is supplied to get the 
   // user started with examples.  After the initial values are
   // loaded into memory, they are saved in a flat file that will
   // contain all subsequent updates and entries.  Deletion of 
   // the "Inventory.txt" file will cause the default values to be
   // reinitialized.
   public function getItemList()
   {
      $itemArray = array();
      $file = @fopen( "Inventory.txt", "r" );
      if( $file != 0 )
      {
         while( !feof( $file ) )
         {
            $itemStr = fgets( $file );
            $items = explode( ";", $itemStr );
            foreach( $items as $itemVar )
            {
               $item = explode( ",", $itemVar );
               $newItem = NULL;
               if( $item[ 1 ] == 'Electronics' )
               {
                  $newItem = new Electronics( $item[ 0 ], $item[ 2 ], $item[ 3 ], $item[ 4 ], $item[ 5 ] );
               }
               else if( $item[ 1 ] == 'Furniture' )
               {
                  $newItem = new Furniture( $item[ 0 ], $item[ 2 ],  $item[ 3 ], $item[ 4 ], $item[ 5 ] );
               }
               else if( $item[ 1 ] == 'Appliance' )
               {
                  $newItem = new Appliance( $item[ 0 ], $item[ 2 ],  $item[ 3 ], $item[ 4 ], $item[ 5 ] );
               }
               if( $newItem != NULL )
               {
                  if( count( $itemArray ) > 0 )
                  {
                     $itemArray[ $item[ 0 ] ] = $newItem;
                  }
                  else
                  {
                     $itemArray = array( $item[ 0 ] => $newItem );
                  }
               }
            }
         }
         fclose( $file );
      }
      else
      {
         // some default values to get started 
         $itemArray = array(
            "ReceiverTV" => new Electronics( "ReceiverTV", "great room", "main entertainment sound reproduction" ),
            "Couch" => new Furniture( "Couch", "great room", "main social and snoozing area" ),
            "Refrigerator" => new Appliance( "Refrigerator", "kitchen", "main food storage unit" ),
            "TVmain" => new Electronics( "TVmain", "great room", "main viewing monitor" ),
            "TVaux" => new Electronics( "TVaux", "office", "auxiliary viewing" )
         );
         // create flat file for persistent data
         $this->saveItemList( $itemArray );
      }
      return $itemArray;
   }

   // function to save the items into a file named "Inventory.txt"
   public function saveItemList( $allItems )
   {
      $file = @fopen( "Inventory.txt", "w" );
      if( $file != 0 )
      {
         foreach( $allItems as $item )
         {
            fwrite( $file, $item->outputStr() );
            fwrite( $file, "\n" );
         }
      }
      fclose( $file );
   }

   // function to save an individual item into the file.
   // Item may be a new element or an update of an
   // existing element in the persistent data list.
   public function saveItem( $name, $itemNew )
   {
      $allItems = $this->getItemList();
      $item = $allItems[ $name ];
      if( $item != NULL )
      {
         // Assume that name has been checked to be unique 
         if( $itemNew->name != $item->name )
         {
            $allItems[ $itemNew->name ] = $allItems[ $name ];
            unset( $allItems[ $name ] );
            $name = $itemNew->name;
         }
         $allItems[ $name ] = $itemNew;
      }
      else
      {
         $allItems[ $itemNew->name ] = $itemNew;
      }
      $this->saveItemList( $allItems );
   }

   // function to remove an item from the current list
   // and persistent data storage
   public function removeItem( $name )
   {
      $allItems = $this->getItemList();
      unset( $allItems[ $name ] );
      $this->saveItemList( $allItems );
   }

   // function to retrieve an item from the current
   // data list
   public function getItem( $name )
   {
      $allItems = $this->getItemList();
      $item = $allItems[ $name ];
      return $item;
   }

   // function to create a basic item and define its type
   public function createItem( $newItemStr )
   {
      $type = $newItemStr[ 'type' ];
      if( $type == 'Electronics' )
      {
         $item = new Electronics( $newItemStr[ 'name' ], $newItemStr[ 'location' ], $newItemStr[ 'description' ], $newItemStr[ 'value' ] );
         return $item;
      }
      else if( $type == 'Appliance' )
      {
         $item = new Appliance( $newItemStr[ 'name' ], $newItemStr[ 'location' ], $newItemStr[ 'description' ], $newItemStr[ 'value' ] );
         return $item;
      }
      else if( $type == 'Furniture' )
      {
         $item = new Furniture( $newItemStr[ 'name' ], $newItemStr[ 'location' ], $newItemStr[ 'description' ], $newItemStr[ 'value' ] );
         return $item;
      }
      return NULL;
   }
}

?>