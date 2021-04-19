<?php 
    //Fungsi CSV

    function read_csv($spesificId = null){
        $rows = array();
        foreach (file("requirement.csv", FILE_IGNORE_NEW_LINES) as $line){
            if(isset($spesificId)){
                if($line[0] == $spesificId){
                    $rows[] = str_getcsv($line);
                }
            }else{
                $rows[] = str_getcsv($line);
            }  
        }

        return $rows;
    }

    function write_csv($rows){
        $file = fopen("requirement.csv", 'w');

        foreach ($rows as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
    }

    function update_csv($rows, $id, $dataUpdate){
        $file = fopen("requirement.csv", 'w');

        foreach ($rows as $row) {
            if($row[0] == $id){
                fputcsv($file, $dataUpdate);
                continue;
            }
            fputcsv($file, $row);
        }

        fclose($file);
    }

    function delete_csv($rows, $id){
        $file = fopen("requirement.csv", 'w');

        foreach ($rows as $row){
            if($row[0] == $id){
                continue;
            }
            fputcsv($file, $row);
        }
    }

    //Membaca CSV
    $data = read_csv();

     //jika tombol simpan diklik
	if(isset($_POST['simpan_data']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
            $dataUpdate = array($_GET['id'], $_POST['tnim'], $_POST['tnama'], $_POST['temail'], $_POST['tprodi']);
			update_csv($data, $_GET['id'], $dataUpdate);

				echo "<script>
						alert('Edit data suksess!');
						document.location='table.php';
				     </script>";	
		}
		else
		{
			//Data akan disimpan Baru
            $data[] = array($data[count($data) - 1 ][0] + 1 ,$_POST['tnim'], $_POST['tnama'], $_POST['temail'], $_POST['tprodi']);
			write_csv($data);

				echo "<script>
						alert('Simpan data suksess!');
						document.location='table.php';
				     </script>";
		}
	}

    if(isset($_GET['hal'])){
        //Pengecekan Edit Data
        if($_GET['hal'] == "edit"){
            //Tampilkan data yang di edit
            $update = read_csv($_GET['id']);
            if($update){
                //jika data ketemu maka akan ditampung dalam variabel
                $vnim = $update[0][1];
                $vnama = $update[0][2];
                $vemail = $update[0][3];
                $vprodi = $update[0][4];
            }
        }

        if($_GET['hal'] == "hapus"){
            //Query hapus data
            delete_csv($data, $_GET['id']);
                echo    "<script>
                            alert('Berhasil Menghapus data!!');
                            document.location='table.php';
                        </script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link rel="icon" href="./assets/ACU.ico" type="image/icon type">
        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
        />

        <title>Template Table Form</title>
    </head>
    <!-- <body style="background: <?php //echo $data[0][5]; ?>;"> -->
    <body>
        <div class="container">
            <h1 class="text-center mt-3">Data Mahasiswa Pemweb-F</h1>

            <!-- Awal card form -->
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    Form input data mahasiswa
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>Masukkan Nim :</label>
                            <input
                                type="number"
                                name="tnim"
                                class="form-control"
                                placeholder="NIM"
                                value="<?=@$vnim?>"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label>Masukkan Nama :</label>
                            <input
                                type="text"
                                name="tnama"
                                class="form-control"
                                placeholder="Nama"
                                value="<?=@$vnama?>"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label>Masukkan Program Studi :</label>
                            <select class="form-control" name="tprodi">
                                <option  value="<?=@$vprodi?>">
                                <?= isset($vprodi)?@$vprodi: "-- Pilih Program Studi --"?>
                                </option>
                                <option value="Teknik Informatika">
                                    Teknik Informatika
                                </option>
                                <option value="Teknologi Informasi">
                                    Teknologi Informasi
                                </option>
                                <option value="Sistem Informasi">
                                    Sistem Informasi
                                </option>
                                <option value="Pendidikan Teknologi Informasi">
                                    Pendidikan Teknologi Informasi
                                </option>
                                <option value="Teknik Komputer">
                                    Teknik Komputer
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Masukkan Email :</label>
                            <input
                                type="email"
                                name="temail"
                                class="form-control"
                                placeholder="Email"
                                value="<?=@$vemail?>"
                                required
                            />
                        </div>
                        <button
                            type="submit"
                            class="btn btn-primary"
                            name="simpan_data"
                        >
                            <?php echo isset($_GET['hal']) == "edit"? "Update": "Tambah";?>
                        </button>
                        <button
                            type="reset"
                            class="btn btn-warning"
                        >
                            Reset
                        </button>
                    </form>
                </div>
            </div>
            <!-- Akhir card form -->

            <!-- Awal card Table -->
            <div class="card mt-3">
                <div class="card-header bg-success text-white">
                    Daftar Mahasiswa
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>Nim</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Program Studi</th>
                            <th>Aksi</th>
                        </tr>
                        <?php 
                            $no = 1;
                            while($no < count($data)) :
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$data[$no][1]?></td>
                            <td><?=$data[$no][2]?></td>
                            <td><?=$data[$no][3]?></td>
                            <td><?=$data[$no][4]?></td>
                            <td>
                         <a
                            href="table.php?hal=edit&id=<?=$data[$no][0]?>"
                            class="btn btn-info"
                           
                        > 

                            Edit
                        </a>
                       <a
                            
                            onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')"
                            class="btn btn-danger"
                            href="table.php?hal=hapus&id=<?=$data[$no][0]?>"
                        >

                            Hapus
                        </a>
                            </td>
                        </tr>
                        <?php $no++; endwhile; //penutup loop quey?>
                    </table>
                </div>
            </div>
            <!-- Akhir card Table -->
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"
        ></script>
    </body>
</html>



<?php
    //FITUR KONEKSI DATABASE
	//Koneksi Database
	// $server = "localhost";
	// $user = "root";
	// $pass = "";
	// $database = "dblatihan";

	// $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	// //jika tombol simpan diklik
	// if(isset($_POST['bsimpan']))
	// {
	// 	//Pengujian Apakah data akan diedit atau disimpan baru
	// 	if($_GET['hal'] == "edit")
	// 	{
	// 		//Data akan di edit
	// 		$edit = mysqli_query($koneksi, "UPDATE tmhs set
	// 										 	nim = '$_POST[tnim]',
	// 										 	nama = '$_POST[tnama]',
	// 											alamat = '$_POST[talamat]',
	// 										 	prodi = '$_POST[tprodi]'
	// 										 WHERE id_mhs = '$_GET[id]'
	// 									   ");
	// 		if($edit) //jika edit sukses
	// 		{
	// 			echo "<script>
	// 					alert('Edit data suksess!');
	// 					document.location='index.php';
	// 			     </script>";
	// 		}
	// 		else
	// 		{
	// 			echo "<script>
	// 					alert('Edit data GAGAL!!');
	// 					document.location='index.php';
	// 			     </script>";
	// 		}
	// 	}
	// 	else
	// 	{
	// 		//Data akan disimpan Baru
	// 		$simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi)
	// 									  VALUES ('$_POST[tnim]', 
	// 									  		 '$_POST[tnama]', 
	// 									  		 '$_POST[talamat]', 
	// 									  		 '$_POST[tprodi]')
	// 									 ");
	// 		if($simpan) //jika simpan sukses
	// 		{
	// 			echo "<script>
	// 					alert('Simpan data suksess!');
	// 					document.location='index.php';
	// 			     </script>";
	// 		}
	// 		else
	// 		{
	// 			echo "<script>
	// 					alert('Simpan data GAGAL!!');
	// 					document.location='index.php';
	// 			     </script>";
	// 		}
	// 	}


		
	// }


	// //Pengujian jika tombol Edit / Hapus di klik
	// if(isset($_GET['hal']))
	// {
	// 	//Pengujian jika edit Data
	// 	if($_GET['hal'] == "edit")
	// 	{
	// 		//Tampilkan Data yang akan diedit
	// 		$tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]' ");
	// 		$data = mysqli_fetch_array($tampil);
	// 		if($data)
	// 		{
	// 			//Jika data ditemukan, maka data ditampung ke dalam variabel
	// 			$vnim = $data['nim'];
	// 			$vnama = $data['nama'];
	// 			$valamat = $data['alamat'];
	// 			$vprodi = $data['prodi'];
	// 		}
	// 	}
	// 	else if ($_GET['hal'] == "hapus")
	// 	{
	// 		//Persiapan hapus data
	// 		$hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_GET[id]' ");
	// 		if($hapus){
	// 			echo "<script>
	// 					alert('Hapus Data Suksess!!');
	// 					document.location='index.php';
	// 			     </script>";
	// 		}
	// 	}
	// }

?>