<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item"> <a class="nav-link " href="home.php"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a></li>
        <?php
        if ($_SESSION['position'] == 'Administrator' || $_SESSION['position'] == 'TODA-Admin') { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-journal-text"></i><span>Manage</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <?php if ($_SESSION['position'] == 'Administrator') { ?>

                        <li> <a href="coAdmins.php"> <i class="bi bi-circle"></i><span>TODA - Admins</span> </a></li>

                    <?php
                    }
                    ?>

                    <li> <a href="drivers.php"> <i class="bi bi-circle"></i><span>Driver</span> </a></li>

                    <?php if ($_SESSION['position'] == 'Administrator') { ?>
                        <li> <a href="users.php"> <i class="bi bi-circle"></i><span>Commuters</span> </a></li>
                        <li class="nav-heading">Pages</li>
                        <li> <a href="fare.php"> <i class="bi bi-circle"></i><span>Fare</span> </a></li>

                    <?php
                    }
                    ?>

                </ul>
            </li>
        <?php
        }
        ?>
        <?php
        if ($_SESSION['position'] != 'Driver') {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-layout-text-window-reverse"></i><span>Bookings</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li> <a href="pending_bookings.php"> <i class="bi bi-circle"></i><span>Pending Bookings</span> </a></li>
                    <li> <a href="successfullBookings.php"> <i class="bi bi-circle"></i><span>Successfull Bookings</span> </a></li>
                </ul>
            </li>
        <?php
        }
        ?>
        <?php if ($_SESSION['position'] == 'Administrator') { ?>

            <li class="nav-item"> <a class="nav-link collapsed" href="backupAndRestore.php"> <i class="bi bi-person"></i> <span>Backup And Restore</span> </a></li>

        <?php
        }
        ?>
    </ul>
</aside>