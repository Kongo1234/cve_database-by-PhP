<?php
// Connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "cve_database";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching data from CVE website and inserting into the database
$cveUrl = "https://www.cvedetails.com";
$html = file_get_contents($cveUrl);

// Here, appropriate functions should be used to parse data from the CVE website
// and process it in a way that it can be inserted into the database

// Sample data for insertion
$cvss_score = 7.5;
$exploitability_score = 8.0;
$impact_score = 7.0;
$technology = "Example Technology";
$version = "1.0";
$description = "Example description";
$published_at = "2024-03-02";

// Prepare SQL statement
$sql = "INSERT INTO cve (cvss_score, exploitability_score, impact_score, technology, version, description, published_at, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

$stmt = $conn->prepare($sql);

// Handle prepare statement errors
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind data to the SQL statement
$stmt->bind_param("dddsdss", $cvss_score, $exploitability_score, $impact_score, $technology, $version, $description, $published_at);

// Execute the SQL statement
if ($stmt->execute()) {
    echo "Records inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$stmt->close();
$conn->close();

//SQL
// To create database use CREATE TABLE cve (
//    id INT AUTO_INCREMENT PRIMARY KEY,
//    cvss_score FLOAT,
//    exploitability_score FLOAT,
//    impact_score FLOAT,
//    technology VARCHAR(255),
//    version VARCHAR(50),
//    description TEXT,
//    published_at DATE,
//    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//);

// Created by Kongo1234 https://github.com/Kongo1234/cve_database-by-PhP
?>
