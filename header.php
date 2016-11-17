<script>
    $(document).ready(function () {
        $('#navigation a').each(function (index) {
            if (this.href.trim() == window.location)
                $(this).addClass("active");
        });
    });
</script>

<div id="header">

    <a href="/">
        <div id="logo_background">
            <div id="logo_text">Townsville Childrens Hospital</div>
        </div>
    </a>

    <div id="loggedin_info">
        <?php

        $username = $_SESSION['username'];

        $sql = "SELECT first_name, surname, role FROM staff WHERE username  = '$username'";

        $result = query($sql);

        $row = mysql_fetch_array($result);

        $name = $row[0] . ' ' . $row[1];

        $role = $row[2];
        ?>

        Currently logged in as: <?php echo $name ?> <br>
        Role: <?php echo $role ?> <br>
        <a href="singleStaff.php?staff_username=<?php echo $username; ?>">Manage your profile</a><br/>

        <div id="lg_button">
            <form action="logout.php" method="">
                <input type="submit" value="Logout" class="btn btn-default"/>
            </form>
        </div>
    </div>

    <div id="menu_bg">
        <div id="menu">

            <ul class="nav nav-pills" id="navigation">
                <li><a href="index.php">Home</a></li>

                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Patients<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="viewPatients.php">Search for patients</a></li>
                        <li><a href="addPatient.php">Add new patients</a></li>
                        <li><a href="requestedTests.php">Requested tests</a></li>
                        <li><a href="scheduledSurgeries.php">Scheduled surgeries</a></li>
                    </ul>
                </li>


                <li><a href="staff.php">Staff</a></li>
                <li><a href="contact.php">Contact</a></li>

            </ul>

        </div>
    </div>

</div>