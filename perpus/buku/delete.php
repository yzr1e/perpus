<?php
include '../koneksi.php';

// Get the buku_id from the query parameters
$buku_id = $_GET['id'];

// Delete related records in the katalog table
$deleteKatalogQuery = "DELETE FROM katalog WHERE buku_id = $buku_id";
$deleteKatalogResult = $mysqli->query($deleteKatalogQuery);

// Now you can safely delete the record from the buku table
$deleteBukuQuery = "DELETE FROM buku WHERE buku_id = $buku_id";
$deleteBukuResult = $mysqli->query($deleteBukuQuery);

// Check if both queries were successful before redirecting
if ($deleteKatalogResult && $deleteBukuResult) {
    header("Location: ../buku"); // Redirect ke tampilan Read setelah berhasil hapus data
    exit;
} else {
    // Handle errors
    echo "Error deleting data: " . $mysqli->error;
}

$mysqli->close();
?>
