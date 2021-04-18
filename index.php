<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <!-- BootstrapCSS -->
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
        />
    </head>
    <body style="background: linear-gradient(120deg, #2691d9, #8e44ad)">
        <div class="container mb-5">
            <div class="title text-center text-white mt-5">
            <h1><b>Template Generator</b></h1>
            <p>UTS Pemrograman Web F - Kelompok 7</p>
            </div>
            <div class="row items-center justify-content-center">
            <div class="card col-md-4 m-3 py-3 rounded-lg shadow" style="width: 18rem">
                <img class="card-img-top mx-auto" src="./table.svg" alt="Card image cap" style="width: 16rem"/>
                <div class="card-body text-center">
                    <h2 class="card-title">Input Data & Table Form</h2>
                    <p class="card-text">
                        Template Input data dan menampilkan data yang mendukung metode CRUD Melalui Database/file CSV
                    </p>
                    <form action="table.php" method="POST">
                        <button
                            type="submit"
                            name="export"
                            class="btn btn-primary"
                            style="width: 12rem"
                        >
                            Lihat Template
                        </button>
                    </form>
                    <form action="exportable.php" method="POST">
                        <button
                            type="submit"
                            name="export"
                            class="btn btn-warning mt-3"
                            style="width: 12rem"
                        >
                            Download Template
                        </button>
                    </form>
                </div>
            </div>
            <div class="card col-md-4 m-3 py-3 rounded-lg shadow" style="width: 18rem">
                <img class="card-img-top mx-auto" src="./login.svg" alt="Card image cap" style="width: 16rem" />
                <div class="card-body text-center mt-3">
                    <h2 class="card-title">Login Form</h2>
                    <p class="card-text mt-4">
                        Template Login Form yang mendukung Cookie dan Session serta autentikasi user melalui Database
                    </p>
                    <form action="login.php" method="POST">
                        <button
                            type="submit"
                            name="export"
                            class="btn btn-primary mt-2"
                            style="width: 12rem"
                        >
                            Lihat Template
                        </button>
                    </form>
                    <form action="exportlogin.php" method="POST">
                        <button
                            type="submit"
                            name="export"
                            class="btn btn-warning mt-3"
                            style="width: 12rem"
                        >
                            Download Template
                        </button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <!-- Bootstrap script -->
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
