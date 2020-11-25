    <?php   if(isset($_SESSION['message'])){?>
    <p><?=$_SESSION['message']?></p>
    <?php
    unset($_SESSION['message']);
    }
    ?>

<a class="button" href="/employee/add"><?=$text_add_employee?></a>

<table class="data dataTable">
    <thead>
        <tr>
        <th><?=$text_table_employee_name?></th>
        <th><?=$text_table_employee_age?></th>
        <th><?=$text_table_employee_address?></th>
        <th><?=$text_table_employee_salary?></th>
        <th><?=$text_table_employee_tax?></th>
        <th><?=$text_table_employee_control?></th>
</thead>
<tbody>
        </tr>
        <?php
            if(false !== $employees){
                foreach ($employees as $emp) {
                    ?>
                    <tr>
                    <td><?= $emp->name?></td>
                    <td><?=$emp->age?></td>
                    <td><?=$emp->address?></td>
                    <td><?=$emp->salary?></td>
                    <td><?php echo $emp->tax?></td>
                    <td>
                        <a href="/employee/edit/<?= $emp->id?>">  <i class="material-icons">edit</i></a>
                        <a href="/employee/delete/<?=$emp->id?>" onclick="if(!confirm('<?=$text_delete_confirm?>')) return false;">  <i class="material-icons">delete</i></a>
                        
                    </td>
                    </tr>
                    <?php
                }
            }
        ?>
    </tbody>
</table>