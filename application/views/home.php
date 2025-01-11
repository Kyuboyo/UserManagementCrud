<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>
<body>
<?php if($error = $this->session->flashdata('response')){ ?>
<div class="alert alert-success" role="alert">
  <?php echo $error; ?>
</div>
<?php } ?>
<div id="container"><!-- As a link -->
<?php include('nav.php') ?>
</div>
<div class="container">
<table id="userTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
	</tbody>
</table>	
			</div>

			<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script src="//cdn.datatables.net/2.2.1/css/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
		$('#userTable').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo base_url().'index.php/home/getPaginatedUsers'; ?>",
				type: "POST",
				dataSrc: function(json) {
					console.log("AJAX URL:", "<?php echo base_url() . 'home/getPaginatedUsers'; ?>");
            console.log("Data received:", json.data); // Log the data received
			if (json.error) {
                console.error("Server error:", json.error);
            }
            return json.data; // Ensure you're returning the correct data array
        }
			},
			"columns": [
                { "data": "Id" },
                { "data": "Name" },
                { "data": "Email" },
                { "data": "Phone" },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `<a href="<?php echo base_url('index.php/home/update/'); ?>${row.Id}" class="btn btn-primary me-2">Update</a>
                                <a href="<?php echo base_url('index.php/home/delete/'); ?>${row.Id}" class="btn btn-danger">Delete</a>`;
                    }
                }
            ]
		});
	});
</script>
</body>
</html>
