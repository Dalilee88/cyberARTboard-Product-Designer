<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect data from the form
    $fabricOption = $_POST["fabric-option"];
    $fabricOptionDescription = ""; // You can define descriptions for the fabric options here

    // Define an array to store the selected sizes and their quantities
    $sizes = [
        "S" => $_POST["s"],
        "M" => $_POST["m"],
        "L" => $_POST["l"],
        "XL" => $_POST["xl"],
        "2XL" => $_POST["2xl"],
        "3XL" => $_POST["3xl"],
        "4XL" => $_POST["4xl"],
        "5XL" => $_POST["5xl"],
        "6XL" => $_POST["6xl"],
        "7XL" => $_POST["7xl"]
    ];

    // Calculate the total quantity
    $totalQty = array_sum($sizes);

    // Collect other form data
    $requestedBy = $_POST["requested-by"];
    $contactDetails = $_POST["contact-details"];
    $jobDescription = $_POST["jobDescription"];
    $jobPONO = $_POST["jobPONO"];
    $requestedDate = $_POST["requestedDate"];
    $frontImg =  basename($_FILES["FrontfileUpload"]["name"]);
    $sideImg = basename($_FILES["SidefileUpload"]["name"]);
    $backImg = basename($_FILES["BackfileUpload"]["name"]);

    // Perform any additional processing here...
    $queryParameters = http_build_query([
        'totalQty' => $totalQty,
        'fabricOption' => $fabricOption,
        'fabricOptionDescription' => $fabricOptionDescription,
        'requestedBy' => $requestedBy,
        'contactDetails' => $contactDetails,
        'jobDescription' => $jobDescription,
        'jobPONO' => $jobPONO,
        'requestedDate' => $requestedDate,
        'frontName' => $frontImg,
        'sideName' => $sideImg,
        'backName' => $backImg
    ]);

    header("Location: checkout.php?$queryParameters");
    exit();
} else {
    // If the form was not submitted, handle the error or redirect elsewhere
    // For example, you can redirect to an error page
    header("Location: error.php");
    exit();
}
?>
