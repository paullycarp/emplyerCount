<?php if($error) {  ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php } ?>

<form action="<?= $form_url ?>" method="post">
    <div class="form-group">
        <label> First Name</label>
        <input required class="form-control" name="firstname" value="<?= $firstname ?>">
    </div>
    <div class="form-group">
        <label> Surname</label>
        <input required class="form-control" name="lastname" value="<?= $lastname ?>">
    </div>
    <div class="form-group">
        <label> Gender</label>
        <select name="gender" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
        </select>
    </div>
    <div class="form-group">
        <label> Birth Date</label>
        <input type="date" class="form-control" name="date_of_birth" value="<?= $date_of_birth ?>">
    </div>
    <div class="form-group">
        <label> Salary</label>
        <input type="number" class="form-control" name="salary" value="<?= $salary ?>">
    </div>
    <div class="form-group">
        <label> Date Joined</label>
        <input type="date" class="form-control" name="date_joined" value="<?= $date_joined ?>">
    </div>
    <div class="form-group">
        <label> Qualification</label>
        <select name="qualification_id" class="form-control">
            <?php foreach(get_qualifications() as $row) {  ?>
                <option value="<?= $row['id'] ?>"> <?= $row['name'] ?></option>
            <?php }?>
        </select>
    </div>
    <button name="submit" class="btn btn-success btn-block"> Save </button>
<form>