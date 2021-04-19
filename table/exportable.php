<?php 

if(isset($_POST["export"]))
{

    //create new folder 
    $dir = "form_table";
    if(is_dir($dir)){
        echo "exist";
    }else{
        mkdir($dir, "0777", true);
    }

    // //connect database
    // $connect = mysqli_connect("localhost", "root", "", "uts_pemweb");
    
    // //create file requirement.csv
    // $output = fopen(__DIR__ . "./form_table/requirement.csv", "w");

    //Create Random Color
    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

    //create headers
    fputcsv($output, array("id", "nim", "nama", "email", "prodi", $color));

    // //Query database
    // $query = "SELECT * FROM tmhs";
    // $result = mysqli_query($connect, $query);

    //Mengisi data
    // while($row = mysqli_fetch_assoc($result))
    // {
    //     fputcsv($output, $row);
    // }

    fputcsv($output, array(1, "19150207111029", "Safir Rahmahuda Machsun", "safirmachsun@student.ub.ac.id", "Teknik Informatika"));
    fputcsv($output, array(2, "19150207111024", "Arief Daffa Abdullah", "arifureta@student.ub.ac.id", "Teknologi Informasi"));
    fputcsv($output, array(3, "19150201111024", "Ahmad Kholish Fauzan Shobiry", "fashobi@student.ub.ac.id", "Sistem Informasi"));
    fputcsv($output, array(4, "19150201111023", "Nuzulul Athaya", "athatheya@student.ub.ac.id", "Pendidikan Teknologi Informasi"));
    fputcsv($output, array(5, "19150200111081", "Muhammad Shovian Hadi Al-Baihaqy", "haqy@student.ub.ac.id", "Teknik Komputer"));
    fclose($output);

    //Membuat ZIP
    // Enter the name of directory
    $pathdir = "form_table/"; 
  
    // Enter the name to creating zipped directory
    $zipcreated = "form_table.zip";
  
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

        header('Content-type: application/zip'); 

        header('Content-Disposition: attachment; filename="'.$zipcreated.'"'); 

        readfile($zipcreated);  

        unlink($zipcreated); 

    } 
}

?>