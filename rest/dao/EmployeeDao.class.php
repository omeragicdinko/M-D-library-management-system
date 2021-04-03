<?php
require_once 'BaseDao.class.php';

class EmployeeDao extends BaseDao
{
    public $table = 'employees';

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function deleteEmployee($id)
    {
        $query = "DELETE FROM employees WHERE id =:id";
        return $this->executeQuerywithoutReturn($query, ['id' => $id]);
    }

    public function updateEmployee($employee, $employee_id)
    {
        $entity[':id'] = $employee_id;
        $query= 'UPDATE '.  $this->table . ' SET ';
        foreach ($employee as $key => $value) {
            $query .= $key . '=:' . $key . ', ';
            $entity[':' . $key] = $value;
        }
        $query = rtrim($query,', ') . ' WHERE id=:id';
        return $this->update($entity, $query);
    }

    public function getEmployeeByEmail($email)
    {
        $query = "SELECT * FROM employees WHERE email=:email";
        return @($this->executeQuerywithReturn($query, ['email' => $email]))[0];
    }
}