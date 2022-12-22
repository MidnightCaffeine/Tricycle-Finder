<?php
include_once 'lib/connection.php';
$page = "Manage User";
session_start();

if (!isset($_SESSION['username'])) {
    session_unset();
    session_write_close();
    session_destroy();
    header("Location: index.php");
}


if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = $pdo->prepare("DELETE FROM `admin_toda` WHERE admin_id='$id' ");
    $delete->execute();
    $delete = $pdo->prepare("DELETE FROM `user_list` WHERE user_id='$id' ");
    if ($delete->execute()) {

        $_SESSION['status'] = "dsuccess";

        header("location: coAdmins.php");
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
include 'includes/head.php';
?>


<body>
    <?php
    include 'includes/navigation.php';
    include 'includes/side_nav.php';
    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage Drivers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Manage</li>
                    <li class="breadcrumb-item active">Driver</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">


                <?php
                if ($_SESSION['position'] == 'Administrator') { ?>
                    <div class="d-flex align-items-center mt-3 mb-2">
                        <a type="button" class="btn btn-primary ms-auto mb-2" href="addAdmin.php"><i class='bx bx-user-plus'></i> Add TODA - Admin</a>
                    </div>
                <?php
                }
                ?>

                <table id="Ridertable" class="display table table-bordered">
                    <thead>
                        <tr>
                            <th>TODA Admin ID</th>
                            <th>TODA</th>
                            <?php
                            if ($_SESSION['position'] == 'Administrator') { ?>
                                <th>Delete</th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php

                        $select = $pdo->prepare("SELECT * FROM admin_toda  ORDER BY admin_id ASC");

                        $select->execute();
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td><?php echo $row["admin_id"]; ?></td>
                                <td><?php echo $row["toda"]; ?></td>


                                <?php
                                if ($_SESSION['position'] == 'Administrator') { ?>
                                    <td>
                                        <?php
                                        $stdId = $row['admin_id'];
                                        ?>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal" data-toggle="tooltip" title="Delete"><i class="bi bi-trash"></i></button>
                                    </td>
                            </tr>
                    <?php
                                }
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php
    include 'includes/footer.php';
    ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?php
    include 'includes/script_list.php';
    ?>

    <script>
        $('#Ridertable').DataTable({
            pagingType: 'full_numbers',
            responsive: true,
            columnDefs: [{
                'targets': [0, 2, 3, 4, 5, 6, 7],
                /* column index */

                'orderable': false,
                /* true or false */
            }, ],
        });
    </script>

    <?php

    if ($_SESSION['status'] ==  "usuccess") { ?>

        <script type="text/javascript">
            toastr.success("Chages are saved Successfully");
        </script>

    <?php
    } elseif ($_SESSION['status'] ==  "asuccess") { ?>

        <script type="text/javascript">
            toastr.success("Added Successfully");
        </script>

    <?php
    } elseif ($_SESSION['status'] ==  "dsuccess") { ?>
        <script type="text/javascript">
            toastr.success("Deleted Successfully");
        </script>
    <?php
    }
    $_SESSION['status'] = '';
    ?>
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="coAdmins.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $stdId; ?>">
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>