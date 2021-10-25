<?php
include 'db_connect.php';
$id = $_GET['id'];
// sql to delete a record
$sql = "DELETE FROM booked WHERE booked.id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>";
    echo "alert('ยกเลิกตั๋วสำเร็จ');";
    echo "window.location = 'index.php?page=booked'; ";
    echo "</script>";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>