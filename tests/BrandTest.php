<?php
  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Brand.php";
  require_once "src/Store.php";

  $server = 'mysql:host=localhost;dbname=shoes_test';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  class BrandTest extends PHPUnit_Framework_TestCase
  {

    protected function tearDown()
    {
      Brand::deleteAll();
      Store::deleteAll();
    }

    function testGetName()
    {
      //Arrange
      $name = "Nike";
      $test_store = new Brand($name);

      //Act
      $result = $test_store->getName();

      //Assert
      $this->assertEquals($name, $result);

    }

    function testSetName()
    {
      //Arrange
      $name = "Nike";
      $test_store = new Brand($name);

      //Act
      $test_store->setName("Adidas");
      $result = $test_store->getName();

      //Assert
      $this->assertEquals("Adidas", $result);
    }

    function testGetId()
    {
      //Arrange
      $name = "Nike";
      $id = 1;
      $test_store = new Brand($name, $id);

      //Act
      $result = $test_store->getId();

      //Assert
      $this->assertEquals(1, $result);
    }

    function testSave()
    {
      //Arrange
      $name = "Nike";
      $id = 1;
      $test_store = new Brand($name, $id);
      $test_store->save();

      //Act
      $result = Brand::getAll();

      //Assert
      $this->assertEquals($test_store, $result[0]);
    }
  }
?>
