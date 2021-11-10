<?php

declare(strict_types=1);

class HomepageController {
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST) {
        //this is just example code, you can remove the line below
        $db = new DataSource();
        $customerLoader = new CustomerLoader($db);
        $productLoader = new ProductLoader($db);

        $customers = $customerLoader->getCustomers();
        $products = $productLoader->getProducts();

        $fixedDiscount = [];
        $variableDiscount = [];

        if (isset($POST['submit'])) {
            if (isset($POST['customerName'])) {
                $selectedCustomer = $customers[intval($_POST['customerName']) - 1];
                // $selectedProduct = $products[intval($_POST['productName']) - 1];
                $customerGroupLoader = new CustomerGroupLoader($db);
                $customerGroups = $customerGroupLoader->getGroupBranch($selectedCustomer->getGroupId());
                $customerName = $selectedCustomer->getFirstName() . " " . $selectedCustomer->getLastName();
                $priceCalculator = new PriceCalculator();
                // $result = $priceCalculator->getPrice($selectedCustomer, $selectedProduct, $customerGroups);
                // var_dump($result);

                // check if the customer has a fixed discount
                if ($selectedCustomer->getFixedDiscount() != null) {
                    array_push($fixedDiscount, $selectedCustomer->getFixedDiscount());
                }

                // add the fixed discounts from the groups
                foreach ($customerGroups as $key => $value) {
                    if ($value->getFixedDiscount() != null) {
                        array_push($fixedDiscount, $value->getFixedDiscount());
                    }
                }

                // check if the customer has a variable discount
                if ($selectedCustomer->getVariableDiscount() != null) {
                    array_push($variableDiscount, $selectedCustomer->getVariableDiscount());
                }

                // add the variable discounts from the groups
                foreach ($customerGroups as $key => $value) {
                    if ($value->getVariableDiscount() != null) {
                        array_push($variableDiscount, $value->getVariableDiscount());
                    }
                }
            }

            if (isset($POST['productName'])) {
            $selectedProduct = $products[intval($_POST['productName']) - 1];
            $productName = $selectedProduct->getName();
            $productPrice = $selectedProduct->getPrice();

            $priceCalculator = $productPrice - (($productPrice - array_sum($fixedDiscount)) * max($variableDiscount)/100);
        }};



        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }
}
