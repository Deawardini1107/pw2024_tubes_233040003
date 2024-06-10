<?php

require_once '../lib/checkAdmin.php';
require_once '../Models/Database.php';

use Models\Booking;

if (
    !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
) {
    // Get search value, limit, and start from DataTables parameters
    $search = $_GET['search']['value']; // Search input
    $limit = $_GET['length']; // Limit per page
    $start = $_GET['start']; // Start position for pagination

    // Build the query with search
    $query = Booking::with('user', 'place');
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('status', 'like', "%{$search}%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%");
                })
                ->orWhereHas('place', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        });
    }

    // Get total records count without search
    $totalData = Booking::count();

    // Get filtered records count with search
    $totalFiltered = $query->count();

    // Apply pagination and get the records
    $booking = $query->offset($start)->limit($limit)->get();

    // Prepare data for DataTables
    $data = [];
    foreach ($booking as $booking) {
        $data[] = [
            'id' => $booking->id,
            'status' => $booking->status,
            'user' => $booking->user ? $booking->user->username : 'Anonymous',
            'place' => $booking->place ? $booking->place->name : 'Unknown',
            'created_at' => $booking->created_at->format('Y-m-d H:i:s'),
            'action' => '<button class="btn btn-primary change-status" data-id="' . $booking->id . '">Change Status</button>',
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


                    <div class="card-body">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">List Booking</h6>
                            </div>
                            <div class="card-body">
                              
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="bookingTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>User</th>
                                                <th>Place</th>
                                                <th>Created At</th>
                                                <th>Action</th>
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
            var table = $('#bookingTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?= $base_url ?>admin/booking.php", // Update this with the actual path to your PHP file
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "user"
                    },
                    {
                        "data": "place"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "action"
                    }
                ]
            });

            $('#bookingTable').on('click', '.change-status', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Change Status',
                    input: 'select',
                    inputOptions: {
                        'Pending': 'Pending',
                        'Confirmed': 'Confirmed',
                        'Cancelled': 'Cancelled'
                    },
                    inputPlaceholder: 'Select a status',
                    showCancelButton: true,
                    inputValidator: function(value) {
                        return new Promise(function(resolve, reject) {
                            if (value) {
                                resolve();
                            } else {
                                resolve('You need to select a status');
                            }
                        });
                    }
                }).then(function(result) {
                    if (result.isConfirmed) {
                        var newStatus = result.value;
                        $.ajax({
                            url: "<?= $base_url ?>admin/ajax/booking_update.php",
                            method: "POST",
                            data: {
                                id: id,
                                status: newStatus
                            },
                            success: function(response) {
                                var res = JSON.parse(response);
                                if (res.success) {
                                    Swal.fire('Success', 'Status updated successfully', 'success');
                                    table.ajax.reload();
                                } else {
                                    Swal.fire('Error', 'Status update failed', 'error');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>


</html>