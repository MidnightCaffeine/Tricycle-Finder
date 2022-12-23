<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item"> <a class="nav-link <?php if ($page == 'Home') {
                                    } else {
                                        echo 'collapsed';
                                    } ?>" href="home.php"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a></li>
        <?php
        if ($_SESSION['position'] == 'Administrator' || $_SESSION['position'] == 'TODA-Admin') { ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($page == 'Manage Toda Admin' || $page == 'Manage User' || $page == 'Manage Driver') {
                                    } else {
                                        echo 'collapsed';
                                    } ?>" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-journal-text"></i><span>Manage</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="forms-nav" class="nav-content <?php if ($page == 'Manage Toda Admin' || $page == 'Manage User' || $page == 'Manage Driver') {
                                                        } else {
                                                            echo 'collapse';
                                                        } ?>" data-bs-parent="#sidebar-nav">
                    <?php if ($_SESSION['position'] == 'Administrator') { ?>

                        <li> <a href="coAdmins.php" class="<?= $page == 'Manage Toda Admin' ? 'active' : '' ?>"> <i class="bi bi-circle"></i><span>TODA - Admins</span> </a></li>

                    <?php
                    }
                    ?>

                    <li> <a href="drivers.php" class="<?= $page == 'Manage Driver' ? 'active' : '' ?>"> <i class="bi bi-circle"></i><span>Driver</span> </a></li>

                    <?php if ($_SESSION['position'] == 'Administrator') { ?>
                        <li> <a href="users.php" class="<?= $page == 'Manage User' ? 'active' : '' ?>"> <i class="bi bi-circle"></i><span>Commuters</span> </a></li>

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
                <a class="nav-link <?php if ($page == 'Pending Booking' || $page == 'Successfull Booking') {
                                    } else {
                                        echo 'collapsed';
                                    } ?>" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-layout-text-window-reverse"></i><span>Bookings</span><i class="bi bi-chevron-down ms-auto"></i> </a>
                <ul id="tables-nav" class="nav-content <?php if ($page == 'Pending Booking' || $page == 'Successfull Booking') {
                                                        } else {
                                                            echo 'collapse';
                                                        } ?>" data-bs-parent="#sidebar-nav">
                    <li> <a href="pending_bookings.php" class="<?= $page == 'Pending Booking' ? 'active' : '' ?>"> <i class="bi bi-circle"></i><span>Pending Bookings</span> </a></li>
                    <li> <a href="successfullBookings.php" class="<?= $page == 'Successfull Booking' ? 'active' : '' ?>"> <i class="bi bi-circle"></i><span>Successfull Bookings</span> </a></li>
                </ul>
            </li>
        <?php
        }
        ?>
        <?php if ($_SESSION['position'] == 'Administrator') { ?>

            <li class="nav-item"> <a class="nav-link <?php if ($page == 'Backup And Restore') {
                                    } else {
                                        echo 'collapsed';
                                    } ?>" href="backupAndRestore.php"> <i class="bi bi-person"></i> <span>Backup And Restore</span> </a></li>

        <?php
        }
        ?>
    </ul>
</aside>