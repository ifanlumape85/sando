@extends('layouts.frontend.app')
@section('content')
<section>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <!-- <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/slide.jpg" alt="BOLMONG HEBAT">
                <div class="carousel-caption d-none d-md-block">
                    <!-- <h5>Dashboard Pemantauan Terpadu</h5>
                    <p>Percepatan Pencegahan Stunting</p> -->
                </div>
            </div>
            <!-- <div class="carousel-item">
                <img class="d-block w-100" src=".../800x400?auto=yes&bg=666&fg=444&text=Second slide" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src=".../800x400?auto=yes&bg=555&fg=333&text=Third slide" alt="Third slide">
            </div> -->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<section>
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col text-center">
                <p>&nbsp;</p>
                <h1 class="h1 text-dark text-bold">PERCEPATAN PENURUNAN STUNTING</h1>
                <p>&nbsp;</p>
                <img src="/kadis.png" class="img-circle img-lg" />
                <p class="text-center text-dark text-break  text-lg">Percepatan penurunan stunting pada Balita adalah program prioritas Pemerintah sebagaimana termaktub dalam RPJMN 2020-2024. Target nasional pada tahun 2024, prevalensi stunting turun hingga 14%. Wakil Presiden RI sebagai Ketua Pengarah Tim Percepatan Penurunan Stunting (TP2S) Pusat bertugas memberikan arahan terkait penetapan kebijakan penyelenggaraan Percepatan Penurunan Stunting; serta memberikan pertimbangan, saran, dan rekomendasi dalam penyelesaian kendala dan hambatan penyelenggaraan Percepatan Penurunan Stunting secara efektif, konvergen, dan terintegrasi dengan melibatkan lintas sektor di tingkat pusat dan daerah.</p>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</section>
<section class="bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col text-center mt-4 mb-4">
                <p>&nbsp;</p>
                <h1 class="h1 text-bold">Kerangka Konsep Percepatan Penurunan Stunting</h1>
                <p class="text-center text-bold m-4 h2">Penyebab Tak Langsung</p>
                <p>&nbsp;</p>

                <div class="row mt-4 mb-4">
                    <div class="col text-lg">
                        1. Ketahanan Pangan<br />(Ketersediaan, keterjangkauan dan akses pangan bergizi)
                    </div>
                    <div class="col  text-lg">
                        2. Lingkungan Sosial<br />(Norma, makanan bayi dan anak, hygiene, pendidikan, tempat kerja)
                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col  text-lg">
                        3. Lingkungan Kesehatan<br />(Akses, pelayanan preventif dan kuratif)
                    </div>
                    <div class="col text-lg">
                        4. Lingkungan Pemukiman<br />(Air, sanitasi, kondisi bangunan)
                    </div>
                </div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col text-center">
                <h1 class="h2 text-dark text-bold">Proses</h1>
                <p class="text-center text-dark text-break text-lg">Pendapatan dan kesenjangan ekonomi, perdagangan, urbanisasi, globalisasi, sistem pangan, perlindungan sosial, sistem kesehatan, pembangunan pertanian dan pemberdayaan perempuan.</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col text-center">
                <h1 class="h2 text-dark text-bold">Prasyarat Pendukung</h1>
                <p class="text-center text-dark text-break text-lg">Komitmen politis dan kebijakan pelaksanaan aksi kebutuhan dan tekanan untuk implementasi, tata kelola keterlibatan antar lembaga pemerintah dan non-pemerintah, kapasitas untuk implementasi.</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</section>
@endsection