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

    function testUpdate()
    {
      //Arrange
      $name = "Super Shoes Plus";
      $id = 1;
      $test_store = new Store($name, $id);
      $test_store->save();

      //Act
      $test_store->update("Super Shoes +");
      $result = $test_store->getName();

      //Assert
      $this->assertEquals("Super Shoes +", $result);
    }

    function testDeleteAll()
    {
      //Arrange
      $name =  "Super Shoes Plus";
      $id = 1;
      $test_store = new Store($name, $id);
      $test_store->save();

      $name2 =  "Only Clogz";
      $id2 = 2;
      $test_store2 = new Store($name, $id);
      $test_store2->save();

      //Act
      Store::deleteAll();

      //Assert
      $this->assertEquals([], Store::getAll());
    }

    function testDeleteStore()
    {
      //Arrange
      $name =  "Super Shoes Plus";
      $id = 1;
      $test_store = new Store($name, $id);
      $test_store->save();

      $name2 =  "Only Clogz";
      $id2 = 2;
      $test_store2 = new Store($name, $id);
      $test_store2->save();

      //Act
      $test_store->delete();

      //Assert
      $this->assertEquals([$test_store2], Store::getAll());
    }
  }
?>
