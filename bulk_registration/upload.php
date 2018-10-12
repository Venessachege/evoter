<?php 
 session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evoter";

$errors = array();
 
// Create connection
 
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
 
 
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
        $duplicate_error = array();
 
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
                    $data['position_id'] = $row[5];
                     
                    //Here, You can insert data into database.
                    //Checks for existing user
                    $query="SELECT * FROM users WHERE Email=? ;";
                    $stmt1 = $conn->prepare($query);
                    $email = $data['Email'];
                    $stmt1->bind_param('s', $email );
                    $stmt1->execute();
                    $result = $stmt1->get_result();
                    if($result->num_rows > 0){
                        $duplicate_error[] = "Duplicate on entry #".($count-1);
                       
                    }else{                        
                         $sql = "INSERT INTO users(First_name, Last_name, Email, Admission_year, Usertype_id) VALUES (?,?,?,?,?)";
                        $stmt2 = $conn->prepare($sql);
                        $stmt2->bind_param('sssii',$data['First_name'],$data['Last_name'],$data['Email'],$data['Admission_year'],$data['Usertype_id']);

                        $stmt2->execute();
                        
                        //insert into candidate details
                        $stmt1->execute();
                        $result2 = $stmt1->get_result();
                        if($result2->num_rows > 0){
                            $row = $result2->fetch_array();
                            $user_id = $row['User_id'];
                            $sql1 = "INSERT INTO candidate_details(User_id,Position_id) VALUES(?,?)";
                            $stmt3 = $conn->prepare($sql1);
                            
                            $stmt3->bind_param('ii',$user_id,$data['position_id'] );

                            if(!$stmt3->execute()){
                                $errors['position_id'] = 'Could not set candidate details';    
                            }                                
                            
                        }
                    }
                    
                   
                }
                $count++;
            }
        }
        $errors['duplicate_errors'] = $duplicate_error;
 
        // Close excel file
        $reader->close();
 
    } else {
        $errors['invalid_excel'] = "Please Select Valid Excel File"; 
    }
 
} else {
    $errors['no_excel'] = "Please Select Excel File";
}
    $_SESSION['error_msg'] = $errors;
    header('location:../adminre.php ');
?>