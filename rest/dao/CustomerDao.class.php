<?php
require_once 'BaseDao.class.php';

class CustomerDao extends BaseDao
{
    public $table = 'customers';

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function deleteCustomer($id)
    {
        $query = "DELETE FROM customers WHERE id =:id";
        return $this->executeQuerywithoutReturn($query, ['id' => $id]);
    }

    public function updateCustomer($customer, $customer_id)
    {
        $entity[':id'] = $customer_id;
        $query= 'UPDATE '.  $this->table . ' SET ';
        foreach ($customer as $key => $value) {
            $query .= $key . '=:' . $key . ', ';
            $entity[':' . $key] = $value;
        }
        $query = rtrim($query,', ') . ' WHERE id=:id';
        return $this->update($entity, $query);
    }
}