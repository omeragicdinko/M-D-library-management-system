<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

require_once('../vendor/autoload.php');
require_once('config.php');
require_once('dao/CustomerDao.class.php');
require_once('dao/EmployeeDao.class.php');
require_once('dao/BookDao.class.php');
require_once('dao/BorrowDao.class.php');
require_once('dao/LibraryDao.class.php');

Flight::register('customer_dao', 'CustomerDao');
Flight::register('employee_dao', 'EmployeeDao');
Flight::register('book_dao', 'BookDao');
Flight::register('borrow_dao', 'BorrowDao');
Flight::register('library_dao', 'LibraryDao');

Flight::route('GET /books', function(){
  $books = Flight::book_dao()->get_all();
  Flight::json($books);
 });

Flight::route('GET /customers', function(){
 $customers = Flight::customer_dao()->get_all();
 Flight::json($customers);
});

Flight::route('GET /libraries', function(){
  $libraries = Flight::library_dao()->get_all();
  Flight::json($libraries);
 });

Flight::route('GET /employees', function(){
 $employees = Flight::employee_dao()->get_all();
 Flight::json($employees);
});

Flight::route('GET /borrows', function(){
  $borrows = Flight::borrow_dao()->get_all();
  Flight::json($borrows);
 });

Flight::route('POST /book', function(){
    $book = Flight::request()->data->getData();
    Flight::book_dao()->add($book);
});

Flight::route('POST /borrow', function(){
  $borrow = Flight::request()->data->getData();
  Flight::borrow_dao()->add($borrow);
});

Flight::route('POST /customer', function(){
  $customer = Flight::request()->data->getData();
  Flight::customer_dao()->add($customer);
});

Flight::route('POST /employee', function(){
  $employee = Flight::request()->data->getData();
  Flight::employee_dao()->add($employee);
});

Flight::route('POST /library', function(){
  $library = Flight::request()->data->getData();
  Flight::library_dao()->add($library);
});

Flight::route('GET /book/@id', function($id){
 $book = Flight::book_dao()->get_by_id($id);
 Flight::json($book);
});

Flight::route('GET /customer/@id', function($id){
  $customer = Flight::customer_dao()->get_by_id($id);
  Flight::json($customer);
 });

 Flight::route('GET /employee/@id', function($id){
  $employee = Flight::employee_dao()->get_by_id($id);
  Flight::json($employee);
 });

 Flight::route('GET /library/@id', function($id){
  $library = Flight::library_dao()->get_by_id($id);
  Flight::json($library);
 });

 Flight::route('GET /borrow/@id', function($id){
  $borrow = Flight::borrow_dao()->get_by_id($id);
  Flight::json($borrow);
 });

Flight::route('POST /login', function(){
  $employee = Flight::request()->data->getData();
  $db_employee = Flight::employee_dao()->get_employee_by_email($employee['email']);

  if($db_employee){
    if($db_employee['password'] == $employee['password']){
      //TODO add something
    } else {
      Flight::halt(404, 'Password is not correct');
    }
  } else {
    Flight::halt(404, 'User not found');
  }
});

Flight::route('POST /book/availability/@id', function($id){
    Flight::book_dao()->update_availability($id);
});

Flight::route('POST /books', function(){
    $request = Flight::request()->data->getData();
    $id = $request['id'];
    Flight::book_dao()->update_book($request, $id);
    Flight::json('Updated');
});

Flight::route('POST /customers', function(){
    $request = Flight::request()->data->getData();
    $id = $request['id'];

    Flight::customer_dao()->update_customer($request, $id);
    Flight::json('Updated');
});

Flight::route('POST /libraries', function(){
  $request = Flight::request()->data->getData();
  $id = $request['id'];

  Flight::library_dao()->update_library($request, $id);
  Flight::json('Updated');
});

Flight::route('POST /employees', function(){
    $request = Flight::request()->data->getData();
    $id = $request['id'];
    Flight::employee_dao()->update_employee($request, $id);
    Flight::json('Updated');
});

//TODO update borrow add


Flight::route('DELETE /book/@id', function($id){
  Flight::book_dao()->delete_book($id);
});

Flight::route('DELETE /customer/@id', function($id){
  Flight::customer_dao()->delete_customer($id);
});

Flight::route('DELETE /library/@id', function($id){
  Flight::library_dao()->delete_library($id);
});

Flight::route('DELETE /borrow/@id', function($id){
  Flight::borrow_dao()->delete_borrow($id);
});

Flight::route('DELETE /employee/@id', function($id){
  Flight::employee_dao()->delete_employee($id);
});

Flight::start();
?>
