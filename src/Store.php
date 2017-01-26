<?php
  class Store
  {
    private $name;
    private $id;

    function __construct($name, $id = null)
    {
      $this->name = $name;
      $this->id = $id;
    }

    function setName($new_name)
    {
      $this->name = (string) $new_name;
    }

    function getName()
    {
      return $this->name;
    }

    function getId()
    {
      return $this->id;
    }

    function save()
    {
      $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function update($new_name)
    {
      $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
      $this->setName($new_name);
    }

    function delete()
    {
      $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
      $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};");
    }

    function addBrand($store)
    {
      $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
    }

    function getBrands()
    {
      $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
        JOIN stores_brands ON (stores_brands.store_id = stores.id)
        JOIN brands ON (brands.id = stores_brands.brand_id)
        WHERE store.id = {$this->getId()};");
      $brands = array();
      foreach($returned_brands as $brand) {
        $name = $brand['name'];
        $id = $brand['id'];
        $new_brand = new Store($name, $id);
        array_push($brands, $new_brand);
      }
      return $brands;
    }

    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM stores;");
    }
  }
?>
