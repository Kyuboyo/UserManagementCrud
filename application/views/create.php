<?php
include('nav.php')
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <legend>Add User</legend>
    <?php echo form_open('home/save', ['class'=>'form-horizontal']); ?>
  <div class="form-group">
    <label for="nameField">Name</label>
    <?php echo form_input(['name'=>'Name', 'class'=>'form-control', 'placeholder'=>'Enter your name', 'value'=>set_value('Name')]) ?>
    <?php echo form_error('Name') ?>
  </div>
  <div class="form-group">
    <label for="inputEmail">Email</label>
    <?php echo form_input(['name'=>'Email', 'class'=>'form-control', 'placeholder'=>'Enter your email', 'value'=>set_value('Email')]) ?>
    <?php echo form_error('Email') ?>
  </div>
  <div class="form-group mb-2">
    <label for="phoneField">Phone</label>
    <?php echo form_input(['name'=>'Phone', 'class'=>'form-control', 'placeholder'=>'Enter your phone number', 'value'=>set_value('Phone')]) ?>
    <?php echo form_error('Phone') ?>
  </div>
  <?php echo form_submit(['value'=>'Submit', 'class'=>'btn btn-primary']); ?>
  <?php echo form_reset(['value'=>'Reset', 'class'=>'btn btn-secondary']); ?>
  <?php echo form_close(); ?>
</div>
</body>
</html>