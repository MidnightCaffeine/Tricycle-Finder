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
                if ($_SESSION['position'] == 'Administrator' || $_SESSION['position'] == 'Co-Admin') { ?>
                    <div class="d-flex align-items-center mt-3 mb-2">
                        <a type="button" class="btn btn-primary ms-auto mb-2" href="addDriver.php"><i class='bx bx-user-plus'></i> Add Driver</a>
                    </div>
                <?php
                }
                ?>

                <table id="Ridertable" class="display table table-bordered">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Lastname</th>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Suffix</th>
                            <th>Gender</th>
                            <th>Plate Number</th>
                            <th>license</th>
                            <th>TODA</th>
                            <th>MTOP</th>
                            <th>Edit</th>

                            <?php
                            if ($_SESSION['position'] == 'Administrator' || $_SESSION['position'] == 'Co-Admin') { ?>
                                <th>Delete</th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php

                        $select = $pdo->prepare("SELECT * FROM driver_list  ORDER BY user_id ASC");

                        $select->execute();
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td><?php echo $row["user_id"]; ?></td>
                                <td><?php echo $row["driver_lastname"]; ?></td>
                                <td><?php echo $row["driver_firstname"]; ?></td>
                                <td><?php echo $row["driver_middlename"]; ?></td>
                                <td><?php echo $row["driver_sufix"]; ?></td>
                                <td><?php echo $row["gender"]; ?></td>
                                <td><?php echo $row["plate_number"]; ?></td>
                                <td><?php echo $row["license"]; ?></td>
                                <td><?php echo $row["toda"]; ?></td>
                                <td><?php echo $row["mtop"]; ?></td>
                                <td>
                                    <a type="button" class="btn btn-primary ms-auto" href="editDriver.php?id=<?php echo $row["user_id"]; ?>" data-toggle="tooltip" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                </td>

                                <?php
                                if ($_SESSION['position'] == 'Administrator') { ?>
                                    <td>
                                        <?php
                                        $stdId = $row['user_id'];
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
                    <form action="deletedriver.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $stdId; ?>">
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>