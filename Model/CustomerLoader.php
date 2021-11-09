<?php

declare(strict_types=1);

class CustomerLoader {
    private DataSource $db;

    public function __construct(DataSource $db) {
        $this->db = $db;
    }

    public function getCustomers(): array {
        $result = [];
        $response  = $this->db->getCustomers();
        foreach ($response as $key => $v) {
            array_push($result, new Customer(intval($v['id']), $v['firstname'], $v['lastname'], intval($v['group_id']), intval($v['fixed_discount']), intval($v['variable_discount'])));
        }
        return $result;
    }
}
