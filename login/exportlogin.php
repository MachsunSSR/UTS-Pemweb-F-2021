<?php 

if(isset($_POST["export"]))
{

    //create new folder 
    $dir = "form_login";
    if(is_dir($dir)){
        echo "folder exist";
    }else{
        mkdir($dir, "0777", true);
    }

    // //connect database
    // $connect = mysqli_connect("localhost", "root", "", "uts_pemweb");
    
    //create file requirement.csv
    $output = fopen("./form_login/requirement.csv", "w");

    //Create Random Color
    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

    //create headers
    fputcsv($output, array("id", "username", "password", $color));
    fputcsv($output, array(1, "machsunssr", "123", $color));
    fputcsv($output, array(2, "root", "root", $color));
    fputcsv($output, array(3, "admin", "admin", $color));

    // //Query database
    // $query = "SELECT * FROM tlogin";
    // $result = mysqli_query($connect, $query);

    // //Mengisi data
    // while($row = mysqli_fetch_assoc($result))
    // {
    //     fputcsv($output, $row);
    // }
    // fclose($output);

    //Membuat ZIP
    // Enter the name of directory
    $pathdir = "form_login/"; 
  
    // Enter the name to creating zipped directory
    $zipcreated = "form_login.zip";
  
    // Create new zip class
    $zip = new ZipArchive;
   
    if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
      
        // Store the path into the variable
        $dir = opendir($pathdir);
       
            while($file = readdir($dir)) {
                if(is_file($pathdir.$file)) {
                    $zip -> addFile($pathdir.$file, $file);
                }
            }
        $zip ->close();
    }

    if(file_exists($zipcreated))  {  // Unduh Zip 
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="'.$zipcreated.'"'); 
        header('Content-type: application/zip'); 
        header('Content-Transfer-Encoding: binary');
        readfile($zipcreated);  

        unlink($zipcreated); 
        exit;
    } else{
        echo "File does not exist.";
    }
}

?>