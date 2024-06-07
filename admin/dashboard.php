<?php

require_once '../lib/checkAdmin.php';
require_once '../Models/Database.php';

use Models\Place;
use Models\Category;
use Models\Comment;
use Models\Photo;


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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Tempat</div>
                                            <?php
                                            $data = Place::count();
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Komentar</div>
                                            <?php
                                            $data = Comment::count();
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Photo
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php
                                                    $data = Photo::count();
                                                    ?>
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $data ?></div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

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
                    <form id="addPlaceForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="photos">Photos</label>
                            <input type="file" class="form-control" id="photos" name="photos" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id">

                                <option value="" <?php echo (isset($_GET['category']) && $_GET['category'] == 'all') ? 'selected' : ''; ?>>All Categories</option>
                                <?php
                                // Loop untuk menampilkan opsi kategori
                                $categories = \Models\Category::all();
                                foreach ($categories as $category) {
                                    echo "<option value='" . $category->id . "' " . ((isset($_GET['category']) && $_GET['category'] == $category->id) ? 'selected' : '') . ">" . $category->name . "</option>";
                                }
                                ?>

                            </select>
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
                    <form id="editPlaceForm" enctype="multipart/form-data">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-name">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-description">Description</label>
                            <textarea class="form-control" id="edit-description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-city">City</label>
                            <input type="text" class="form-control" id="edit-city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-photos">Photos</label>
                            <input type="file" class="form-control" id="edit-photos" name="photos">
                            <div id="current-photo" class="mt-2"></div>
                        </div>
                        <div class="form-group">
                            <label for="edit-category_id">Category</label>
                            <select class="form-control" id="edit-category_id" name="category_id" required></select>
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

</body>


</html>