<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit('POST request method required');
}

if (empty($_FILES)) {
    exit('$_FILES is empty - is file_uploads set to "On" in php.ini?');
}

if ($_FILES["photo_upload"]["error"] !== UPLOAD_ERR_OK) {

    switch ($_FILES["photo_upload"]["error"]) {
        case UPLOAD_ERR_PARTIAL:
            exit('File only partially uploaded');
            break;
        case UPLOAD_ERR_NO_FILE:
            exit('No file was uploaded');
            break;
        case UPLOAD_ERR_EXTENSION:
            exit('File upload stopped by a PHP extension');
            break;
        case UPLOAD_ERR_FORM_SIZE:
            exit('File exceeds MAX_FILE_SIZE in the HTML form');
            break;
        case UPLOAD_ERR_INI_SIZE:
            exit('File exceeds upload_max_filesize in php.ini');
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            exit('Temporary folder not found');
            break;
        case UPLOAD_ERR_CANT_WRITE:
            exit('Failed to write file');
            break;
        default:
            exit('Unknown upload error');
            break;
    }
}

// Reject uploaded file larger than 1MB
if ($_FILES["photo_upload"]["size"] > 1048576) {
    exit('File too large (max 1MB)');
}

// Use fileinfo to get the mime type
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $finfo->file($_FILES["photo_upload"]["tmp_name"]);

$mime_types = ["image/gif", "image/png", "image/jpeg"];
        
if ( ! in_array($_FILES["photo_upload"]["type"], $mime_types)) {
    exit("Invalid file type");
}

// Replace any characters not \w- in the original filename
$pathinfo = pathinfo($_FILES["photo_upload"]["name"]);

$base = $pathinfo["filename"];

$base = preg_replace("/[^\w-]/", "_", $base);

$filename = $base . "." . $pathinfo["extension"];

$destination = __DIR__ . "/uploads/" . $filename;

// Add a numeric suffix if the file already exists
$i = 1;

while (file_exists($destination)) {

    $filename = $base . "($i)." . $pathinfo["extension"];
    $destination = __DIR__ . "/uploads/" . $filename;

    $i++;
}

if ( ! move_uploaded_file($_FILES["photo_upload"]["tmp_name"], $destination)) {

    exit("Can't move uploaded file");

}

// Database integration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO barangay_id_requests (first_name, last_name, age, user_address, photo_upload, contact_number, emergency_contact, birthdate) 
                            VALUES (:first_name, :last_name, :age, :user_address, :photo_upload, :contact_number, :emergency_contact, :birthdate)");

    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':user_address', $user_address);
    $stmt->bindParam(':photo_upload', $filename);
    $stmt->bindParam(':contact_number', $contact_number);
    $stmt->bindParam(':emergency_contact', $emergency_contact);
    $stmt->bindParam(':birthdate', $birthdate);

    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $user_address = $_POST['user_add'];
    $contact_number = $_POST['contact_number'];
    $emergency_contact = $_POST['emergency_contact'];
    $birthdate = $_POST['birthdate'];

    $stmt->execute();

    echo "New record created successfully";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
