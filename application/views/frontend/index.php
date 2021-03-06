<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="#">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url(); ?>assets/template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="<?= base_url(); ?>assets/template/css/animate.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url(); ?>assets/template/css/style.css" rel="stylesheet">

    <style>
        div.gallery {
            margin: 7px;
            border: 1px solid #ccc;
            float: left;
            width: 210px;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }
    </style>

</head>

<body id="page-top" class="landing-page no-skin-config">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a class="page-scroll" href="#page-top">Home</a></li>
                        <li><a class="page-scroll" href="#tentang">Tentang</a></li>
                        <li><a class="page-scroll" href="#kegiatan">Kegiatan</a></li>
                        <li><a class="page-scroll" href="#kontak">Kontak</a></li>
                    </ul>
                    <a class="navbar-brand navbar-right" href="<?= base_url(); ?>index.php/auth">LOGIN</a>
                </div>
            </div>
        </nav>
    </div>
    <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#inSlider" data-slide-to="0" class="active"></li>
            <li data-target="#inSlider" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                    <!-- <div class="carousel-caption">
                        <h1>Welcome to<br />
                            SI KBMK Gunadarma</h1>
                        <p>Sistem Informasi <br />
                           Keluarga Besar Mahasiswa Khonghucu <br/>
                           Universitas Gunadarma.</p>
                    </div> -->
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back one"></div>

            </div>
            <div class="item">
                <div class="container">
                    <div class="carousel-caption blank">
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back two"></div>
            </div>
        </div>
        <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section id="tentang" class="container features">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1><b>Visi dan Misi<br /> <span class="navy"></span>KBMK GUNADARMA</h1></b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 text-center wow fadeInLeft" style="padding-right:0px;">
                <i class="fa fa-bell features-icon"></i>
                <h2><b>VISI</b></h2>
                <div style="text-align:justify;">
                    <ul>
                        <bold>
                            <p>1. Menjadi suatu wadah yang dapat memfasilitasi seluruh anggotanya dalam mendalami ajaran dari Agama Khonghucu dengan belajar bersama yang saling melengkapi satu sama lain sehingga juga diharapkan dapat mencapai suasana kekeluargaan.</p>
                            <p>2. Menciptakan suasana kekeluargaan antar anggota KBMK Universitas Gunadarma dan aktif dalam media online sebagai bentuk aktivitas dari KBMK Universitas Gunadarma selama masa pandemi dan aktivitas offline pada saat pandemi berakhir</p>
                    </ul>
                    </bold>
                </div>
            </div>
            <div class="col-md-6 text-center  wow zoomIn">
                <img src="<?= base_url(); ?>assets/template/img/landing/kbmk1.png" alt="dashboard" class="img-responsive">
            </div>
            <div class="col-md-3 text-center wow fadeInRight" style="padding-right:0px;">
                <i class="fa fa-thumb-tack features-icon"></i>
                <h2><b>MISI</b></h2>
                <div style="text-align:justify;">
                    <p>1. Meningkatkan komunikasi antar anggota KBMK </p>
                    <p>2. Melaksanakan kegiatan KBMK baik secara online atau offline.</p>
                    <p>3. Menciptakan kerja sama dan kebersamaan antar anggota KBMK UG dalam menjalankan event-event yang akan dihadiri maupun diadakan KBMK UG.</p>
                    <p>4. Menciptakan lingkungan yang positif antar anggota KBMK.</p>
                    <p>5. Meningkatkan keikutsertaan KBMK UG dalam menghadiri acara internal (UKM atau BEM di dalam Universitas Gunadarma) maupun eksternal..</p>
                </div>
            </div>
        </div>
    </section>

    <section class="gray-section team">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1><b>Kepengurusan KBMK Universitas Gunadarma</h1></b>
                    <p>Bagan Kepengurusan KBMK Gunadarma</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="team-member wow zoomIn">
                        <a href="<?= base_url(); ?>assets/template/img/bagan_kbmk.png" target="_blank">
                            <img src="<?= base_url(); ?>assets/template/img/bagan_kbmk.png" class="img-responsive" alt="">
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kegiatan" class="features">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1><b>Kegiatan KBMK Gunadarma</b></h1>
                </div>
            </div>

            <div class="wrapper wrapper-content  animated fadeInRight blog">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist" style="justify-content: center; display:flex;">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-five-one-tab" data-toggle="pill" href="#custom-tabs-five-one" role="tab" aria-controls="custom-tabs-five-one" aria-selected="true" style="font-weight:bold; font-size:18px;">Photos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-five-two-tab" data-toggle="pill" href="#custom-tabs-five-two" role="tab" aria-controls="custom-tabs-five-two" aria-selected="false" style="font-weight:bold; font-size:18px;">People</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-five-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-five-one" role="tabpanel" aria-labelledby="custom-tabs-five-one-tab">
                                        <div class="gallery">
                                            <a target="_blank" href="<?= base_url() ?>assets/foto_kegiatan/foto1.jpeg">
                                                <img src="<?= base_url() ?>assets/foto_kegiatan/foto1.jpeg" alt="Cinque Terre" width="600" height="400">
                                            </a>
                                            <div class="desc">Foto bersama dengan adik-adik di Yayasan Kasih Mandiri</div>
                                        </div>

                                        <div class="gallery">
                                            <a target="_blank" href="<?= base_url() ?>assets/foto_kegiatan/foto2.jpeg">
                                                <img src=" <?= base_url() ?>assets/foto_kegiatan/foto2.jpeg" alt=" Forest" width="600" height="400">
                                            </a>
                                            <div class="desc">Foto bersama dengan adik-adik di Yayasan Kasih Mandiri</div>
                                        </div>

                                        <div class="gallery">
                                            <a target="_blank" href="<?= base_url() ?>assets/foto_kegiatan/foto3.jpeg">
                                                <img src=" <?= base_url() ?>assets/foto_kegiatan/foto3.jpeg" alt=" Northern Lights" width="600" height="400">
                                            </a>
                                            <div class="desc">Adik terkasih di Yayasan Kasih Mandiri</div>
                                        </div>

                                        <div class="gallery">
                                            <a target="_blank" href="<?= base_url() ?>assets/foto_kegiatan/foto4.jpeg">
                                                <img src=" <?= base_url() ?>assets/foto_kegiatan/foto4.jpeg" alt=" Mountains" width="600" height="400">
                                            </a>
                                            <div class="desc">Perkenalan diri dengan adik-adik di Yayasan Mandiri</div>
                                        </div>

                                        <div class="gallery">
                                            <a target="_blank" href="<?= base_url() ?>assets/foto_kegiatan/foto5.jpeg">
                                                <img src=" <?= base_url() ?>assets/foto_kegiatan/foto5.jpeg" alt=" Mountains" width="600" height="400">
                                            </a>
                                            <div class="desc">Calvin sebagai Ketua KBMK melakukan pembukaan</div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-five-two" role="tabpanel" aria-labelledby="custom-tabs-five-two-tab">
                                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <div class="row features-block">
    <?php foreach ($pengumuman as $pngmmn) : ?>
                <div class="col-lg-3 features-text wow fadeInLeft" >
                    <small>Publish : <?= $pngmmn->TANGGAL_POSTING ?></small>
                    <h2><?= $pngmmn->JUDUL ?></h2>
                    <p><?php
                        $pengum = $pngmmn->HEADLINE_BERITA;
                        $cut = substr($pengum, 0, 50,);
                        echo $cut;
                        echo " .....";

                        ?></p>
                    <a href="<?= base_url('Landing/readmore/' . $pngmmn->ID_PENGUMUMAN); ?>" class="btn btn-primary">Selengkapnya</a>
                </div>
                <?php endforeach; ?>
            </div> -->
    <section id="kontak" class="gray-section contact">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1><b>Hubungi Kami</b></h1>
                    <p>Untuk saran dan kritik dapat menghubungi kami.</p>
                </div>
            </div>
            <div class="row m-b-lg">
                <div class="col-lg-3 col-lg-offset-3">
                    <address>
                        <strong><span class="navy">KBMK Universitas Gunadarma</span></strong><br />
                        Kampus D Universitas Gunadarma <br />
                        Jl. Margonda Raya 100. Pondok Cina, Kecamatan Beji, Kota Depok, Jawa Barat <br />
                        <br>
                        Nomor yang dapat dihubungi: 0895345531188<br />
                    </address>
                </div>
                <div class="col-lg-4">
                    <p class="text-color">
                        Keluarga Besar Mahasiswa Khonghucu Universitas Gunadarma (KBMK UG) merupakan Unit Kegiatan Mahasiswa (UKM) yang bergerak dalam bidang kerohanian agama Khonghucu dibawah naungan Universitas Gunadarma. KBMK Universitas Gunadarma juga merupakan media yang menjadi tempat bagi mahasiswa/mahasiswi beragama Khonghucu di Universitas Gunadarma.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="mailto:kbmkgunadarma@gmail.com" class="btn btn-primary">Send us mail</a>
                    <p class="m-t-sm">
                        Or follow us on social platform
                    </p>
                    <ul class="list-inline social-icon">
                        <li><a href="https://www.instagram.com/kbmk_gundar/"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.instagram.com/kbmk_gundar/"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/kbmk_gundar/"><i class="fa fa-facebook"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                    <p><strong>&copy; Pengurus KBMK Gunadarma </strong><br />
                </div>
            </div>
        </div>
    </section>


    <!-- Mainly scripts -->
    <script src="<?= base_url(); ?>assets/template/js/jquery-3.1.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= base_url(); ?>assets/template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?= base_url(); ?>assets/template/js/plugins/pace/pace.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/js/plugins/wow/wow.min.js"></script>

    <script src="<?= base_url(); ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>

    <script src="<?= base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url(); ?>assets/adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

    <script src="<?= base_url(); ?>assets/adminlte/dist/js/adminlte.min.js"></script>



    <script>
        $(document).ready(function() {

            $('body').scrollspy({
                target: '.navbar-fixed-top',
                offset: 80
            });

            // Page scrolling feature
            $('a.page-scroll').bind('click', function(event) {
                var link = $(this);
                $('html, body').stop().animate({
                    scrollTop: $(link.attr('href')).offset().top - 50
                }, 500);
                event.preventDefault();
                $("#navbar").collapse('hide');
            });
        });

        var cbpAnimatedHeader = (function() {
            var docElem = document.documentElement,
                header = document.querySelector('.navbar-default'),
                didScroll = false,
                changeHeaderOn = 200;

            function init() {
                window.addEventListener('scroll', function(event) {
                    if (!didScroll) {
                        didScroll = true;
                        setTimeout(scrollPage, 250);
                    }
                }, false);
            }

            function scrollPage() {
                var sy = scrollY();
                if (sy >= changeHeaderOn) {
                    $(header).addClass('navbar-scroll')
                } else {
                    $(header).removeClass('navbar-scroll')
                }
                didScroll = false;
            }

            function scrollY() {
                return window.pageYOffset || docElem.scrollTop;
            }
            init();

        })();

        // Activate WOW.js plugin for animation on scrol
        new WOW().init();
    </script>

</body>

</html>