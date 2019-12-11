<div class="row">
<div class="col  table-responsive">
<table class="table table-bordered table-striped">
<thead>
          <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Date Of Birth</th>
    <th>Qualification</th>
    <th>Salary</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>
<?php 

    foreach ($employees as $row)
    { ?>

            <tr>
                <td>
                    <?= $row['firstname'] ?>
                </td>
                <td>
                    <?= $row['lastname'] ?>
                </td>
                <td>
                    <?= $row['gender'] ?>
                </td>
                <td>
                    <?= $row['date_of_birth'] ?>
                </td>
                <td>
                    <?= $row['qualification_name'] ?>
                </td>
                <td>
                    <?= $row['salary'] ?>
                </td>
                <td>
                    <a class="btn btn-outline-secondary mb-2" href="update.php?employee_id=<?= $row['id'] ?>">
                    <i class="fa fa-edit"></i> Edit</a>
                    <form method="post">
                      <input type="hidden" name="employee_id" value="<?= $row['id'] ?>" />
                    <button class="btn btn-outline-danger" name="delete_btn" onclick="return confirm('Delete employee: <?= $row['firstname'] ?>?')? true : false" href="delete.php?employee_id=<?= $row['id'] ?>">
                    <i class="fa fa-trash"></i> Delete</button>
                    </form>
                  </td>
               
            </tr>
        <?php }
?>
</tbody>
</table>

    </div>
    </div>