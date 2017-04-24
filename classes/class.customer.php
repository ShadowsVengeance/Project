<?php

/**
 * Created by PhpStorm.
 * User: Beans
 * Date: 4/2/2017
 * Time: 10:26 PM
 */
class customer
{
    private $customerID;
    private $customerName;
    private $database;

    function customer($customerID, $database) {

        $this->database = $database;

        $sql = file_get_contents('sql/getCustomer.sql');
        $params = array(
            'customerid' => $customerID
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $customers = $statement->fetchAll(PDO::FETCH_ASSOC);

        $customer = $customers[0];

        $this->customerName = $customer['username'];
        $this->customerID = $customer['customerid'];
    }

    public function getCustomerName() {
        return $this->customerName;
    }


}