<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
            o.OrderNo, s.OrderDate, s.CustomerName, 
            i.ItemName, i.UnitCost, o.QuantityOrdered, o.TotalAmount
        FROM ORDERLINE o
        JOIN SALESORDER s ON o.OrderNo = s.OrderNo
        JOIN ITEM i ON o.ItemNo = i.ItemNo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Order No</th>
                <th>Order Date</th>
                <th>Customer Name</th>
                <th>Item Name</th>
                <th>Unit Cost</th>
                <th>Quantity Ordered</th>
                <th>Total Amount</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['OrderNo']}</td>
                <td>{$row['OrderDate']}</td>
                <td>{$row['CustomerName']}</td>
                <td>{$row['ItemName']}</td>
                <td>{$row['UnitCost']}</td>
                <td>{$row['QuantityOrdered']}</td>
                <td>{$row['TotalAmount']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
