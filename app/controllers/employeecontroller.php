<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\EmployeeModel;

class EmployeeController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        //$this->_language->load('template.common');
        $this->_language->load('employee.default');
        $this->_data["employees"] = EmployeeModel::getAll();
        $this->_view();
    }

    public function addAction()
    {
        //$this->_language->load('template.common');
        $this->_language->load('employee.add');
        if( isset($_POST['submit'])){
            $emp = new EmployeeModel();
            $emp->name = $this->filterString($_POST['name']);
            $emp->age = $this->filterInt($_POST['age']);
            $emp->address = $this->filterString($_POST['address']);
            $emp->salary = $this->filterInt($_POST['salary']);
            $emp->tax = $this->filterFloat($_POST['tax']);
            if($emp->save()){
                $_SESSION['message'] = "Employee, Saved Successfully";
                $this->redirect('/employee');
            }
        }
        $this->_view();
    }

    public function editAction()
    {
        //$this->_language->load('template.common');
        $this->_language->load('employee.edit');
        $id = $this->filterInt($this->_params[0]);
        $emp = EmployeeModel::getByPK($id);
        if($emp === false){
            $this->redirect('/employee');
        }
        $this->_data['employee'] = $emp;
        //var_dump($emp);
        if( isset($_POST['submit'])){
            $emp->name = $this->filterString($_POST['name']);
            $emp->age = $this->filterInt($_POST['age']);
            $emp->address = $this->filterString($_POST['address']);
            $emp->salary = $this->filterInt($_POST['salary']);
            $emp->tax = $this->filterFloat($_POST['tax']);
            if($emp->save()){
                $_SESSION['message'] = "Employee, Edited Successfully";
                $this->redirect('/employee');
            }
        }
        $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $emp = EmployeeModel::getByPK($id);
        if($emp === false){
            $this->redirect('/employee');
        }
        var_dump($emp);
            if($emp->delete()){
                $_SESSION['message'] = "Employee, deleted Successfully";
                $this->redirect('/employee');
            }
        $this->_view();
    }


}