<?php 
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evoter";
 
// Create connection
 
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
 
echo "connected";
 
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
 
// Include Spout library 
require_once 'spout-master\src\Spout\Autoloader\autoload.php';
 
// check file name is not empty
if (!empty($_FILES['file']['name'])) {
      
    // Get File extension eg. 'xlsx' to check file is excel sheet
    $pathinfo = pathinfo($_FILES["file"]["name"]);
     
    // check file has extension xlsx, xls and also check 
    // file is not empty
   if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') 
           && $_FILES['file']['size'] > 0 ) {
         
        // Temporary file name
        $inputFileName = $_FILES['file']['tmp_name']; 
    
        // Read excel file by using ReadFactory object.
        $reader = ReaderFactory::create(Type::XLSX);
 
        // Open file
        $reader->open($inputFileName);
        $count = 1;
 
        // Number of sheet in excel file
        foreach ($reader->getSheetIterator() as $sheet) {
             
            // Number of Rows in Excel sheet
            foreach ($sheet->getRowIterator() as $row) {
 
                // It reads data after header. In the my excel sheet, 
                // header is in the first row. 
                if ($count > 1) { 
 
                    // Data of excel sheet
                    $data['First_name'] = $row[0];
                    $data['Last_name'] = $row[1];
                    $data['Email'] = $row[2];
                    $data['Admission_year'] = $row[3];
					$data['Usertype_id'] = $row[4];
                     
                    //Here, You can insert data into database. 
                    print_r($data /"</br/>");
                    $sql = "INSERT INTO users(First_name, Last_name, Email, Admission_year, Usertype_id) VALUES (?,?,?,?,?)";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param('sssii',$data['First_name'],$data['Last_name'],$data['Email'],$data['Admission_year'],$data['Usertype_id']);
					
					$stmt->execute();
					$conn->query($sql);
                }
                $count++;
            }
        }
 
        // Close excel file
        $reader->close();
 
    } else {
 
        echo "Please Select Valid Excel File";
    }
 
} else {
 
    echo "Please Select Excel File";
     
}
?>