
<?php

/*
 * Controller Class
 * simple controller class to respond to actions taken on 
 * the view screens presented to the user
 * rjc - 5/26/2013
 *
 */

include_once( "model/Model.php" );

class Controller 
{
   public $model;

   public function __construct()  
   {  
      $this->model = new Model();
   } 

   /*
    * showList()
    * private function used within the class to present the list in 
    * a predetermined manner.  Changes to this function will change
    * all views that display a list of items
    */
   private function showList()
   {
      $items = $this->model->getItemList();
      usort( $items, "itemSort" );
      include 'view/itemlist.php';
   }

   /*
    * invoke()
    * main function called from index.php after creating a controller
    * function deals with all of the possible selections from the various
    * viewing screens.  The appropriate model manipulation is called and 
    * associated viewing screen called.
    */
   public function invoke()
   {
      if( isset( $_GET[ 'item' ] ) )
      {
         // READ: show the requested item
         $item = $this->model->getItem( $_GET[ 'item' ] );
         include 'view/itemView.php';
      }
      else if( isset( $_GET[ 'create' ] ) )
      {
         // CREATE: initial creation of a new item
         $item = NULL;
         include 'view/itemView.php';
      }
      else if( isset( $_GET[ 'delete' ] ) )
      {
         // Delete: deletes an item from the list and displays the list
         $this->model->removeItem( $_GET[ 'delete' ] );
         $this->showList();
      }
      else if( isset( $_GET[ 'update' ] ) )
      {
         // UPDATE: Items that are updated or after they are created 
         //   get saved in the data structure here 
         if( $_GET[ 'update' ] == "New Item" )
         {
            $item = $this->model->createItem( $_GET );
         }
         else  // update fields
         {
            $item = $this->model->getItem( $_GET[ 'update' ] );
            $item->update( $_GET );
         }
         $this->model->saveItem( $_GET[ 'update' ], $item );
         // go back to list view
         $this->showList();
      }
      else
      {
         // READ ALL: show a list of items
         $this->showList();
      }
   }
}

?>