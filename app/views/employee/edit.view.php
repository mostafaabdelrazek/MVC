<style>



/* Add padding to containers */
.container {
  padding: 16px;
  background-color: #eee;
  width: 500px;
  margin: auto;
}

/* Full-width input fields */
input {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: white;
}

input:focus, input:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

</style>



<form method="POST" autocomplete="off" >
  <div class="container">
    <h1><?=$text_employee_edit?></h1>
    <p><?=$text_employee_header?></p>
    <hr>

    <label for="name"><b><?=$text_employee_name?></b></label>
    <input type="text" placeholder="Enter Name" name="name" required value="<?=$employee->name?>" >
    <br>
    <label for="age"><b><?=$text_employee_age?></b></label>
    <input type="number" placeholder="Age" name="age"  required value="<?=$employee->age?>">
    <br>
    <label for="Address"><b><?=$text_employee_address?></b></label>
    <input type="text" placeholder="Address" name="address" required value="<?=$employee->address?>">
    <br>
    <label for="salary"><b><?=$text_employee_salary?></b></label>
    <input type="number" placeholder="salary" name="salary" required value="<?=$employee->salary?>">
    <br>
    <label for="tax"><b><?=$text_employee_tax?></b></label>
    <input type="numbe" placeholder="tax" name="tax" required value="<?=$employee->tax?>">
    
    <hr>

    <button type="submit" class="registerbtn" name="submit"><?=$text_employee_edit?></button>
  </div>
</form>

