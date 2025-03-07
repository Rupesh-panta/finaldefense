<?php
// Include header file
include('include/header.php');

// Fetch blood stock data
$query = "SELECT blood_group, units_available, last_updated FROM blood_stock";
$result = $conn->query($query);

// Fetch total available blood quantity
$totalQuery = "SELECT SUM(units_available) AS total_quantity FROM blood_stock";
$totalResult = $conn->query($totalQuery);
$totalQuantity = $totalResult->num_rows > 0 ? $totalResult->fetch_assoc()['total_quantity'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Stock</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Blood Donation Stock</h1>
    <div class="text-right mb-3">
        <h5><strong>Total Blood Available:</strong> <?= number_format($totalQuantity) ?> mL</h5>
    </div>
    <table class="table table-bordered table-hover mt-4">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Blood Group</th>
                <th>City</th>
                <th>Contact No</th>
                <th>Quantity (mL)</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['blood_group']) ?></td>
                        <td><?= htmlspecialchars($row['city']) ?></td>
                        <td><?= htmlspecialchars($row['contact_no']) ?></td>
                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No donors found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Optional: Include JavaScript for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
