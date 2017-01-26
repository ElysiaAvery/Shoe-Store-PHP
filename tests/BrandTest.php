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
      $test_brand = new Brand($name);

      //Act
      $result = $test_brand->getName();

      //Assert
      $this->assertEquals($name, $result);

    }

    function testSetName()
    {
      //Arrange
      $name = "Nike";
      $test_brand = new Brand($name);

      //Act
      $test_brand->setName("Adidas");
      $result = $test_brand->getName();

      //Assert
      $this->assertEquals("Adidas", $result);
    }

    function testGetId()
    {
      //Arrange
      $name = "Nike";
      $id = 1;
      $test_brand = new Brand($name, $id);

      //Act
      $result = $test_brand->getId();

      //Assert
      $this->assertEquals(1, $result);
    }

    function testSave()
    {
      //Arrange
      $name = "Nike";
      $id = 1;
      $test_brand = new Brand($name, $id);
      $test_brand->save();

      //Act
      $result = Brand::getAll();

      //Assert
      $this->assertEquals($test_brand, $result[0]);
    }

    function testUpdate()
    {
      //Arrange
      $name = "Nike";
      $id = 1;
      $test_brand = new Brand($name, $id);
      $test_brand->save();

      //Act
      $test_brand->update("Adidas");
      $result = $test_brand->getName();

      //Assert
      $this->assertEquals("Adidas", $result);
    }

    function testDeleteAll()
    {
      //Arrange
      $name = "Nike";
      $id = 1;
      $test_brand = new Brand($name, $id);
      $test_brand->save();

      $name2 = "Adidas";
      $id2 = 1;
      $test_brand2 = new Brand($name, $id);
      $test_brand2->save();

      //Act
      Brand::deleteAll();

      //Assert
      $this->assertEquals([], Brand::getAll());
    }

    function testDeleteBrand()
    {
      //Arrange
      $name = "Nike";
      $id = 1;
      $test_brand = new Brand($name, $id);
      $test_brand->save();

      $name2 = "Adidas";
      $id2 = 1;
      $test_brand2 = new Brand($name, $id);
      $test_brand2->save();

      //Act
      $test_brand->delete();

      //Assert
      $this->assertEquals([$test_brand2], Brand::getAll());
    }
  }
?>
