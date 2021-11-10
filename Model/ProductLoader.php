<?php
declare(strict_types=1);

class ProductLoader
{
    private DataSource $db;

    public function __construct(DataSource $db) {
        $this->db = $db;
    }

    public function getProducts(): array {
        $result = [];
        $response  = $this->db->getProducts();
        foreach ($response as $key => $z) {
            array_push($result, new Product(intval($z['id']), $z['name'], intval($z['price'])));
        }
       return $result;
    }
}