<?php
$conn = get_sqlite_connection();
if ($conn) {
    $stmt = $conn->prepare("SELECT * FROM example_table");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        echo $row['id'] . ' - ' . $row['name'] . PHP_EOL;
    }
} else {
    echo "Failed to establish a connection to the local SQLite database." . PHP_EOL;
}