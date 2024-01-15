<?php
include '../Includes/header.php';
?>
<body>

<div class="container group-container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="form-container text-center">
                <h2>Groep selectie</h2>
                <p>Voer groeps naam in</p>
                <input type="text" class="form-control mb-3" placeholder="Groepsnaam">
                <p>Namen leerlingen</p>
                <div class="mb-3">
                    <input type="text" class="form-control mb-2" placeholder="Leerling 1">
                    <input type="text" class="form-control mb-2" placeholder="Leerling 2">
                    <input type="text" class="form-control mb-2" placeholder="Leerling 3">
                </div>
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="circle-container">
                        <i class='bx bx-plus'></i>
                    </div>
                </div>
                <button type="button" class="btn group-next">Volgende</button>
            </div>
        </div>
    </div>
</div>

</body>
