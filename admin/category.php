<?php

require_once '../lib/checkAdmin.php';
require_once '../Models/Database.php';

use Models\Category;;

if (
    !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
) {

    // Get search value, limit, and start from DataTables parameters
    $search = $_GET['search']['value']; // Search input
    $limit = $_GET['length']; // Limit per page
    $start = $_GET['start']; // Start position for pagination

    // Build the query with search
    $query = Category::query();
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%");
        });
    }

    // Get total records count without search
    $totalData = Category::count();

    // Get filtered records count with search
    $totalFiltered = $query->count();

    // Apply pagination and get the records
    $places = $query->offset($start)->limit($limit)->get();

    // Prepare data for DataTables
    $data = [];
    foreach ($places as $place) {
        $data[] = [
            'id' => $place->id,
            'name' => $place->name,
            'description' => $place->description,
        ];
    }

    // Return JSON response
    echo json_encode([
        'draw' => intval($_GET['draw']),
        'recordsTotal' => $totalData,
        'recordsFiltered' => $totalFiltered,
        'data' => $data,
    ]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Time Traver - Admin</title>

    <!-- Custom fonts for this template-->
    <link href="<?= $base_url ?>admin/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= $base_url ?>admin/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= $base_url ?>admin/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once 'components/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- header -->
                <?php require_once 'components/header.php' ?>
                <!-- End of header -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Tempat Wisata</h6>
                        </div>
                        <div class="card-body">
                            <!-- Add New Place Button -->
                            <div class="container-fluid">
                                <button class="btn btn-success mb-4" data-toggle="modal" data-target="#addPlaceModal">Add New Place</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="placesTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Naman Tempat</th>
                                            <th>Description</th>
                                           
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <!-- Data will be populated by DataTables -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require_once 'components/footer.php' ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Add New Place Modal -->
    <div class="modal fade" id="addPlaceModal" tabindex="-1" role="dialog" aria-labelledby="addPlaceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlaceModalLabel">Add New Place</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addPlaceForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Add Place</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Place Modal -->
    <div class="modal fade" id="editPlaceModal" tabindex="-1" role="dialog" aria-labelledby="editPlaceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPlaceModalLabel">Edit Place</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editPlaceForm">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-name">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-description">Description</label>
                            <textarea class="form-control" id="edit-description" name="description" required></textarea>
                        </div>
                       

                        <button type="submit" class="btn btn-primary">Update Place</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php require_once 'components/logout.php' ?>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= $base_url ?>admin/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= $base_url ?>admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= $base_url ?>admin/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= $base_url ?>admin/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= $base_url ?>admin/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= $base_url ?>admin/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= $base_url ?>admin/assets/js/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#placesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?= $base_url ?>admin/category.php", // Update this with the actual path to your PHP file
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "description"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-primary edit-btn'>Edit</button> <button class='btn btn-danger delete-btn'>Delete</button>"
                    }
                ]
            });

            // Fetch categories and populate dropdown
            function populateCategories() {
                $.ajax({
                    url: '<?= $base_url ?>admin/ajax/fetch_categories.php',
                    type: 'GET',
                    success: function(response) {
                        var categories = JSON.parse(response);
                        var categoryDropdown = $('#category_id');
                        categoryDropdown.empty();
                        categories.forEach(function(category) {
                            categoryDropdown.append($('<option>', {
                                value: category.id,
                                text: category.name
                            }));
                        });
                    }
                });
            }

            // Show add modal and populate categories
            $('#addPlaceModal').on('show.bs.modal', function() {
                populateCategories();
            });

            // Handle edit button click
            $('#placesTable tbody').on('click', '.edit-btn', function() {
                var data = table.row($(this).parents('tr')).data();
                $('#edit-id').val(data.id);
                $('#edit-name').val(data.name);
                $('#edit-description').val(data.description);
                $('#edit-city').val(data.city);
                $('#edit-photos').val(data.photos);
                $('#edit-admin_id').val(data.admin_id);
                $('#edit-category_id').val(data.category_id);
                $('#edit-created_at').val(data.created_at);
                $('#editPlaceModal').modal('show');
            });

            // Handle delete button click
            $('#placesTable tbody').on('click', '.delete-btn', function() {
                var data = table.row($(this).parents('tr')).data();
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '<?= $base_url ?>admin/ajax/category_delete.php', // Update this with the actual path to your PHP delete file
                        type: 'POST',
                        data: {
                            id: data.id
                        },
                        success: function(response) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Record deleted successfully!'
                            });
                        }
                    });
                }
            });

            // Handle add form submit
            $('#addPlaceForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?= $base_url ?>admin/ajax/category_add.php', // Update this with the actual path to your PHP add file
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addPlaceModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Record added successfully!'
                        });
                    }
                });
            });

            // Handle edit form submit
            $('#editPlaceForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?= $base_url ?>admin/ajax/category_update.php', // Update this with the actual path to your PHP update file
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editPlaceModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Record updated successfully!'
                        });
                    }
                });
            });
        });
    </script>
</body>


</html>