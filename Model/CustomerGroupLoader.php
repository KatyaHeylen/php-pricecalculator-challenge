<?php

declare(strict_types=1);

class CustomerGroupLoader {
    private DataSource $db;

    public function __construct(DataSource $db) {
        $this->db = $db;
    }

    public function getGroupBranch(int $groupId): array {
        $result = [];
        $reachedRoot = false;
        $currentGroupId = $groupId;

        do {
            $response = $this->db->getCustomerGroupById($currentGroupId);
            $customerGroup = new CustomerGroup(
                intval($response['id']),
                $response['name'],
                is_null($response['parent_id']) ? $response['parent_id'] : intval($response['parent_id']),
                is_null($response['fixed_discount']) ? $response['fixed_discount'] : intval($response['fixed_discount']),
                is_null($response['variable_discount']) ? $response['variable_discount'] : intval($response['variable_discount'])
            );
            array_push($result, $customerGroup);

            if (is_null($customerGroup->getParentId())) {
                $reachedRoot = true;
            } else {
                $currentGroupId = $customerGroup->getParentId();
            }
        } while ($reachedRoot === false);

        return $result;
    }
}
