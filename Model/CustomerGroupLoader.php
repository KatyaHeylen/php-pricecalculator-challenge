<?php

declare(strict_types=1);

class CustomerGroupLoader {
    private DataSource $db;

    public function __construct(DataSource $db) {
        $this->db = $db;
    }

    // public function getCustomerGroup(): array {
    //     $result = [];
    //     $response = $this->db->getCustomerGroups();
    //     foreach ($response as $key => $v) {
    //         array_push($result, new CustomerGroup(
    //             intval($v['id']),
    //             $v['name'],
    //             is_null($v['parent_id']) ? $v['parent_id'] : intval($v['parent_id']),
    //             is_null($v['fixed_discount']) ? $v['fixed_discount'] : intval($v['fixed_discount']),
    //             is_null($v['variable_discount']) ? $v['variable_discount'] : intval($v['variable_discount'])
    //         ));
    //     }
    //     return $result;
    // }

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
