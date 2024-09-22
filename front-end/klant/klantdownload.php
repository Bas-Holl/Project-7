<?php 
//excel database klanten

 
// Load the database configuration file 
//include_once 'dbConfig.php'; 
 
// Fetch records from database 
$db = new PDO ("mysql:host=localhost;dbname=project-7","root","");
$query = $db->query("SELECT * FROM users"); 
 
if($query->rowCount() > 0){ 
    $delimiter = ";"; 
    $filename = "klanten_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'Voornaam', 'Achternaam', 'Gebruikersniveau', 'E-mail', 'Telefoon', 'Adres', 'Postcode', 'plaats'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch(PDO::FETCH_ASSOC)){ 
        $lineData = array($row['id'], $row['firstname'], $row['lastname'], $row['userlevel'], $row['email'], $row['phone'], $row['address'], 
        $row['zipcode'],$row['city']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>