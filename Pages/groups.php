<?php

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

// Fetch groups and members from the database
$sql = "SELECT G.GroupID, G.GroupName, GM.MemberName
        FROM Groups G
        JOIN GroupsMembers GM ON G.GroupID = GM.GroupID";

$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$groups = array();

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $groupID = $row['GroupID'];
    $groupName = $row['GroupName'];
    $memberName = $row['MemberName'];

    if (!isset($groups[$groupName])) {
        $groups[$groupName] = array(
            'GroupID' => $groupID,
            'GroupName' => $groupName,
            'Members' => array()
        );
    }

    $groups[$groupName]['Members'][] = $memberName;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Groups</title>
</head>
<body>

<div class="container mt-5">
    <form>
        <!-- Compact dropdown for GroupID -->
        <div class="form-group">
            <label for="groupIDSelect">Select GroupID:</label>
            <select class="form-control" name="groupIDSelect">
                <option value="" selected disabled>Select</option>
                <?php
                $sqlGroupID = "SELECT GroupID FROM Groups";
                $stmtGroupID = sqlsrv_query($conn, $sqlGroupID);

                while ($rowGroupID = sqlsrv_fetch_array($stmtGroupID, SQLSRV_FETCH_ASSOC)) {
                    echo "<option value='" . $rowGroupID['GroupID'] . "'>" . $rowGroupID['GroupID'] . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Compact dropdown for GroupName -->
        <div class="form-group">
            <label for="groupNameSelect">Select GroupName:</label>
            <select class="form-control" name="groupNameSelect">
                <option value="" selected disabled>Select</option>
                <?php
                $sqlGroupName = "SELECT GroupName FROM Groups";
                $stmtGroupName = sqlsrv_query($conn, $sqlGroupName);

                while ($rowGroupName = sqlsrv_fetch_array($stmtGroupName, SQLSRV_FETCH_ASSOC)) {
                    echo "<option value='" . $rowGroupName['GroupName'] . "'>" . $rowGroupName['GroupName'] . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Compact text box for searching MemberName -->
        <div class="form-group">
            <label for="memberNameSearch">Search MemberName:</label>
            <input type="text" class="form-control" name="memberNameSearch">
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<div class="container mt-5">
    <div class="blue-box p-3 rounded">
        <h2 class="text-center blue-heading mb-0">Groepen en Studenten</h2>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col" class="text-center align-middle">Groep</th>
            <th scope="col" class="text-center align-middle">Groeps naam</th>
            <th scope="col" class="text-center align-middle">Studenten</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($groups as $group): ?>
            <tr>
                <th scope="row" class="text-center align-middle"><?php echo $group['GroupID']; ?></th>
                <td class="text-center align-middle"><?php echo $group['GroupName']; ?></td>
                <td class="text-center">
                    <ul class="list-unstyled mb-3 mt-3">
                        <?php foreach ($group['Members'] as $member): ?>
                            <li class="mb-1"><?php echo $member; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>




</body>
</html>
