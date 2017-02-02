<?php
  class Brand
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
      $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function update($new_name)
    {
      $GLOBALS['DB']->exec("UPDATE brands SET name = '{$new_name}' WHERE id = {$this->getId()};");
      $this->setName($new_name);
    }

    function delete()
    {
      $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
      $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$this->getId()};");
    }

    static function getAll()
    {
      $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
      $brands = array();
      foreach($returned_brands as $brand) {
        $name = $brand['name'];
        $id = $brand['id'];
        $new_brand = new Brand($name, $id);
        array_push($brands, $new_brand);
      }
      return $brands;
    }

    function addStore($store)
    {
      $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
    }

    function getStores()
    {
      $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
        JOIN stores_brands ON (stores_brands.brand_id = brands.id)
        JOIN stores ON (stores.id = stores_brands.store_id)
        WHERE brands.id = {$this->getId()};");
      $stores = array();
      foreach($returned_stores as $store) {
        $name = $store['name'];
        $id = $store['id'];
        $new_store = new Store($name, $id);
        array_push($stores, $new_store);
      }
      return $stores;
    }

    static function find($search_id)
    {
      $found_brand = null;
      $brands = Brand::getAll();
      foreach($brands as $brand) {
        $brand_id = $brand->getId();
        if ($brand_id == $search_id) {
          $found_brand = $brand;
        }
      }
      return $found_brand;
    }

    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM brands;");
    }
  }
?>
