<?php
  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Store.php";
  require_once "src/Brand.php";

  $server = 'mysql:host=localhost;dbname=shoes_test';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  class StoreTest extends PHPUnit_Framework_TestCase
  {

    protected function tearDown()
    {
      Store::deleteAll();
      Brand::deleteAll();
    }

    function testGetName()
    {
      //Arrange
      $name = "Super Shoes Plus";
      $test_store = new Store($name);

      //Act
      $result = $test_store->getName();

      //Assert
      $this->assertEquals($name, $result);

    }

    function testSetName()
    {
      //Arrange
      $name = "Super Shoes Plus";
      $test_store = new Store($name);

      //Act
      $test_store->setName("Only Clogz");
      $result = $test_store->getName();

      //Assert
      $this->assertEquals("Only Clogz", $result);
    }

    function testGetId()
    {
      //Arrange
      $name = "Super Shoes Plus";
      $id = 1;
      $test_store = new Store($name, $id);

      //Act
      $result = $test_store->getId();

      //Assert
      $this->assertEquals(1, $result);
    }

    function testSave()
    {
      //Arrange
      $name = "Super Shoes Plus";
      $id = 1;
      $test_store = new Store($name, $id);
      $test_store->save();

      //Act
      $result = Store::getAll();

      //Assert
      $this->assertEquals($test_store, $result[0]);
    }
  }
?>
