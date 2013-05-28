<?php

/* Item.php
 * file containing the definitions of the basic model units as items
 * rjc-5/26/2013

/*
 * ItemClass
 * basic abstract unit of an item containing all of the common
 * elements of the types of elements that may be entered into 
 * the system as data.  The basic item holds only the common
 * data fields and allows for child classes to contain fields 
 * relevant to that item.  In this initial example, subsequent 
 * classes contain only one additional field just to support the 
 * functionality.  The addition of more fields may require 
 * some adjustment in the viewing screens.
 */
abstract class ItemClass
{
   // function required in child classes
   abstract protected function getType();
   abstract protected function getNumAdditionalFields();
   abstract protected function getAdditionalFieldName( $index );
   abstract protected function getAdditionalFieldValue( $index );
   abstract protected function getOutputStr();
   abstract protected function setUpdateFields( $updateStr );

   // function to return the specific type of an item
   public function type()
   {
      return $this->getType();
   }

   // function to supply the number of additional fields a specific 
   // item may contain
   public function numAdditionalFields()
   {
      return $this-> getNumAdditionalFields();
   }

   // function to supply the name of an additional field referenced 
   // by an index in the specific item
   public function additionalFieldName( $index )
   {
      return $this->getAdditionalFieldName( $index );
   }

   // function to supply the value of an addition field referenced
   // by an index in the specific item
   public function additionalFieldValue( $index )
   {
      return $this->getAdditionalFieldValue( $index );
   }

   // function to output a string containing the fields of an item,
   // similar to serialization of an object to allow for persistent 
   // storage
   public function outputStr()
   {
      $type = $this->type();
      $extraStuff = $this->getOutputStr();
      return "$this->name,$type,$this->location,$this->description,$this->value,$extraStuff;";
   }

   // function to allow for the updating of an item from an array 
   // containing the named fields of the item
   public function update( $updateStr )
   {
      if( isset( $updateStr[ 'name' ] ) ) $this->name = $updateStr[ 'name' ];
      if( isset( $updateStr[ 'location' ] ) ) $this->location = $updateStr[ 'location' ];
      if( isset( $updateStr[ 'description' ] ) ) $this->description = $updateStr[ 'description' ];
      if( isset( $updateStr[ 'value' ] ) ) $this->value = $updateStr[ 'value' ];
      $this->setUpdateFields( $updateStr );
   }

   // common fields for all items
   public $name;
   public $location;
   public $description;
   public $value; 
}

/*
 * Electronics class
 * class extended from the item class to contain
 * Electronics items.
 */
class Electronics extends ItemClass
{
   // additional field for Electronics class
   public $make;

   // getType function() required by item class
   protected function getType()
   {
      return "Electronics";
   }

   // getNumAdditionalFields() function required by item class
   protected function getNumAdditionalFields()
   {
      return 1;
   }

   // getAdditionalFieldName() function required by item class
   // referenced by an index value when more than one additional
   // field exists
   protected function getAdditionalFieldName( $index )
   {
      return 'Make:';
   }

   // getAdditionalFieldValue() function required by item class
   // referenced by an index value when more than one additional
   // field exists
   protected function getAdditionalFieldValue( $index )
   {
      return $this->make;
   }

   // getOutputStr() function required by item class to return a 
   // string of additional fields relevant to the Electronics class
   protected function getOutputStr()
   {
      return "$this->make";
   }

   // setUpdateFields() function required by item class to 
   // set the values for the additional fields 
   protected function setUpdateFields( $updateStr )
   {
      for( $i = 0; $i < $this->getNumAdditionalFields(); $i++ )
      {
         if( isset( $updateStr[ $this->getAdditionalFieldName( $i ) ] ) )
         {
            $this->make = $updateStr[ $this->getAdditionalFieldName( $i ) ];
         }
      }
   }

   // class constructor function defaults all values except the name
   public function __construct( $name, $location = "home", $description = "", $value = 0, $make = "not entered" )
   {  
      $this->name = $name;
      $this->make = $make;
      $this->location = $location;
      $this->description = $description;
      $this->value = $value;
   }
}

/*
 * Furniture class
 * class extended from the item class to contain
 * Furniture items.
 */
class Furniture extends ItemClass
{
   // additional field for Furniture class
   public $size;

   // getType function() required by item class
   protected function getType()
   {
      return "Furniture";
   }

   // getNumAdditionalFields() function required by item class
   protected function getNumAdditionalFields()
   {
      return 1;
   }

   // getAdditionalFieldName() function required by item class
   // referenced by an index value when more than one additional
   // field exists
   protected function getAdditionalFieldName( $index )
   {
      return 'Size:';
   }

   // getAdditionalFieldValue() function required by item class
   // referenced by an index value when more than one additional
   // field exists
   protected function getAdditionalFieldValue( $index )
   {
      return $this->size;
   }

   // getOutputStr() function required by item class to return a 
   // string of additional fields relevant to the Furniture class
   protected function getOutputStr()
   {
      return "$this->size";
   }

   // setUpdateFields() function required by item class to 
   // set the values for the additional fields 
   protected function setUpdateFields( $updateStr )
   {
      for( $i = 0; $i < $this->getNumAdditionalFields(); $i++ )
      {
         if( isset( $updateStr[ $this->getAdditionalFieldName( $i ) ] ) )
         {
            $this->size = $updateStr[ $this->getAdditionalFieldName( $i ) ];
         }
      }
   }

   // class constructor function defaults all values except the name
   public function __construct( $name, $location = "home", $description = "", $value = 0, $size = "not entered"  )  
   {  
      $this->name = $name;
      $this->size = $size;
      $this->location = $location;
      $this->description = $description;
      $this->value = $value;
   }
}

/*
 * Appliance class
 * class extended from the item class to contain
 * Appliance items.
 */
class Appliance extends ItemClass
{
   // additional field for Appliance class
   public $make;

   // getType function() required by item class
   protected function getType()
   {
      return "Appliance";
   }

   // getNumAdditionalFields() function required by item class
   protected function getNumAdditionalFields()
   {
      return 1;
   }

   // getAdditionalFieldName() function required by item class
   // referenced by an index value when more than one additional
   // field exists
   protected function getAdditionalFieldName( $index )
   {
      return 'Make:';
   }

   // getAdditionalFieldValue() function required by item class
   // referenced by an index value when more than one additional
   // field exists
   protected function getAdditionalFieldValue( $index )
   {
      return $this->make;
   }

   // getOutputStr() function required by item class to return a 
   // string of additional fields relevant to the Appliance class
   protected function getOutputStr()
   {
      return "$this->make";
   }

   // setUpdateFields() function required by item class to 
   // set the values for the additional fields 
   protected function setUpdateFields( $updateStr )
   {
      for( $i = 0; $i < $this->getNumAdditionalFields(); $i++ )
      {
         if( isset( $updateStr[ $this->getAdditionalFieldName( $i ) ] ) )
         {
            $this->make = $updateStr[ $this->getAdditionalFieldName( $i ) ];
         }
      }
   }

   // class constructor function defaults all values except the name
   public function __construct( $name, $location = "home", $description = "", $value = 0, $make = "not entered" )  
   {  
      $this->name = $name;
      $this->make = $make;
      $this->location = $location;
      $this->description = $description;
      $this->value = $value;
   }
}

?>
