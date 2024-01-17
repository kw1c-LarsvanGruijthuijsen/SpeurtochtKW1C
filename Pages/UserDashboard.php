<?php
include '../Includes/header.php';

$serverName = "172.16.20.93";
$database = "DbSpeurtocht";
$username = "sa";
$password = "3gh4jdhuHH?@#$";

$connectionOptions = array(
    "Database" => $database,
    "Uid" => $username,
    "PWD" => $password
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    echo 'Connection could not be established.<br />';
    die(print_r(sqlsrv_errors(), true));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted
    if (isset($_POST['group-name']) && isset($_POST['leerlingen'])) {
        $groupName = $_POST['group-name'];
        $memberNames = implode(',', $_POST['leerlingen']);

        // Call stored procedure to insert group and members
        $sql = "{CALL InsertGroupAndMembers (?, ?)}";
        $params = array($groupName, $memberNames);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt) {
            // $successMessage = 'Group and members inserted successfully.';
            header('location: UserDashBoard/Question1.php');
            exit();
        } else {
            $errorMessage = 'Error inserting group and members.';
        }
    }
}
?>






<body>

<div class="container group-container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="form-container text-center">
                <form method="post" action="">
                    <h2>Groep selectie</h2>
                    <p>Voer groeps naam in</p>
                    <input type="text" name="group-name" class="form-control mb-3" placeholder="Groepsnaam" required>
                    <p>Namen leerlingen</p>
                    <div class="mb-2">
                        <input type="text" name="leerlingen[]" class="form-control mb-2" placeholder="Leerling 1" required>
                        <input type="text" name="leerlingen[]" class="form-control mb-2" placeholder="Leerling 2" required>
                        <input type="text" name="leerlingen[]" class="form-control mb-2" placeholder="Leerling 3" id="leerling3" required>
                    </div>
                    <div class="circle-container mb-2 ml-0 ml-sm-auto">
                        <i class='bx bx-plus' onclick="addInputField()"></i>
                    </div>
                    <button type="submit" class="btn group-next mt-2">Volgende</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
// Display success or error message
if (!empty($successMessage)) {
    echo "<div class='alert alert-success mt-3'>$successMessage</div>";
} elseif (!empty($errorMessage)) {
    echo "<div class='alert alert-danger mt-3'>$errorMessage</div>";
}
?>



<form method="post" action="../Login/logout.php">
    <button type="submit" name="logout" class="btn btn-danger">Logout</button>
</form>

<script>
    function addInputField() {
        var inputContainer = document.querySelector('.mb-2');
        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.className = 'form-control mb-2';
        newInput.placeholder = 'Leerling ' + (inputContainer.childElementCount + 1);
        newInput.name = 'leerlingen[]';
        inputContainer.appendChild(newInput);
    }
</script>

</body>
</html>
