<!-- Aplikasi Antrian Berbasis Web 
**********************************************
* Developer   : Indra Styawantoro
* Company     : Indra Studio
* Release     : Juni 2021
* Update      : -
* Website     : www.indrasatya.com
* E-mail      : indra.setyawantoro@gmail.com
* WhatsApp    : +62-821-8686-9898
-->

<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Antrian Berbasis Web">
    <meta name="author" content="Indra Styawantoro">

    <!-- Title -->
    <title>Aplikasi Antrian Berbasis Web</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
        crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <div class="container pt-5">
            <div class="row justify-content-lg-center">
                <div class="col mb-4">
                    <div class="px-4 py-3 mb-4 bg-white rounded-2 shadow-sm">
                        <!-- judul halaman -->
                        <div class="d-flex align-items-center me-md-auto">
                            <i class="bi-people-fill text-success me-3 fs-3"></i>
                            <h1 class="h5 pt-2">Nomor Antrian Farmasi</h1>
                        </div>
                    </div>


                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center d-grid p-5">
                            <div class="row">
                            <div class="col">
                            <!-- informasi antrian umum -->
                            <div class="border border-success rounded-2 py-2 mb-5">
                                <h3 class="pt-4">ANTRIAN FARMASI RACIK</h3>
                                <h1 id="antrian" class="display-1 fw-bold text-success text-center lh-1 pb-2"></h1>
                            </div>

                            <!-- Tombol pengambilan nomor antrian untuk antrean umum -->
                            <a id="insert_umum" href="javascript:void(0)" onclick="printAntrianUmum()"
                                class="btn btn-success btn-block rounded-pill fs-5 px-5 py-4 mb-2">
                                <i class="bi-person-plus fs-4 me-2"></i> Ambil Nomor
                            </a>
                            </div>

                            <div class="col">
                            <!-- informasi antrian BPJS -->
                            <div class="border border-primary rounded-2 py-2 mb-5">
                                <h3 class="pt-4">ANTRIAN FARMASI NON RACIK</h3>
                                <h1 id="antrian_bpjs" class="display-1 fw-bold text-primary text-center lh-1 pb-2"></h1>
                            </div>

                            <!-- Tombol pengambilan nomor antrian untuk antrean BPJS -->
                            <a id="insert_bpjs" href="javascript:void(0)" onclick="printAntrianBPJS()"
                                class="btn btn-primary btn-block rounded-pill fs-5 px-5 py-4 mb-2">
                                <i class="bi-person-plus fs-4 me-2"></i> Ambil Nomor
                            </a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-4">
        <div class="container">
            <!-- copyright -->
            <div class="copyright text-center mb-2 mb-md-0">
                <!-- &copy; 2021 - <a href="https://www.indrasatya.com/" target="_blank"
                    class="text-danger text-decoration-none">www.indrasatya.com</a>. All rights reserved. -->
            </div>
        </div>
    </footer>

    <!-- jQuery Core -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // Proses insert untuk antrean umum
            $('#insert_umum').on('click', function () {
                $.ajax({
                    type: 'POST',
                    url: 'insert.php', // Ubah URL ini sesuai dengan skrip PHP yang menangani antrean umum
                    success: function (result) {
                        if (result === 'Sukses') {
                            $('#antrian').load('get_antrian.php').fadeIn('slow');
                        }
                    },
                });
            });

            // Proses insert untuk antrean BPJS
            $('#insert_bpjs').on('click', function () {
                $.ajax({
                    type: 'POST',
                    url: 'insert_non_racik.php', // Ubah URL ini sesuai dengan skrip PHP yang menangani antrean BPJS
                    success: function (result) {
                        if (result === 'Sukses') {
                            $('#antrian_bpjs').load('get_antrian_non_racik.php').fadeIn('slow');
                        }
                    },
                });
            });

            // Fungsi polling
            function pollQueue() {
                // Panggil fungsi untuk mendapatkan jumlah antrian BPJS dan umum
                $.ajax({
                    type: 'POST',
                    url: 'get_antrian_non_racik.php',
                    success: function (response_bpjs) {
                        $('#antrian_bpjs').html(response_bpjs).fadeIn('slow');

                        // Panggil fungsi untuk mendapatkan jumlah antrian umum setelah selesai mendapatkan antrian BPJS
                        $.ajax({
                            type: 'POST',
                            url: 'get_antrian.php',
                            success: function (response_umum) {
                                $('#antrian').html(response_umum).fadeIn('slow');
                            },
                            complete: function () {
                                setTimeout(pollQueue, 100);
                            }
                        });
                    },
                });
            }

            // Mulai polling
            pollQueue();
        });

        // Fungsi untuk mencetak nomor antrian umum
        function printAntrianUmum() {
        window.print();
        }

        // Fungsi untuk mencetak nomor antrian BPJS
        function printAntrianBPJS() {
        window.print();
        }

        document.addEventListener('keydown', function(event) {
        // Periksa apakah Ctrl atau Command (untuk macOS) ditekan bersama dengan tombol 'P'
        if ((event.ctrlKey || event.metaKey) && event.key === 'p') {
        event.preventDefault(); // Mencegah perilaku default (yaitu, membuka dialog pratinjau cetak)
        window.print(); // Memulai proses pencetakan
        // Catatan: Tidak semua browser akan membiarkan Anda melewati dialog pratinjau cetak dengan cara ini
        }
        });
        
    </script>
</body>

</html>


