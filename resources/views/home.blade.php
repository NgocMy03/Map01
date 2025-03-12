<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Trang chủ</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">CT298 - N01</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('MapAnimation') }}">Đến bản đồ</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('product.index') }}">Đến cửa hàng</a></li>
                </div>
            </div>
        </nav>
        <!-- Convenience Store-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Convenience Store Image-->
                <img class="masthead-avatar mb-5" src="assets/img/supermarket.png" alt="..." />
                <!-- Convenience Store Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">QUẢN LÝ CỬA HÀNG TIỆN LỢI</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Convenience Store Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Tìm Kiếm - Dẫn Đường - Lựa Chọn</p>
            </div>
        </header>
        <!-- Store Section-->
        <section class="page-section store" id="store">
            <div class="container">
                <!-- Store Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Các cửa hàng đồng hành</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Store Grid Items-->
                <div class="row justify-content-center">
                    <!-- Store Item 1-->
                    <div class="col-md-6 col-lg-4 mb-5 text-center">
                        <div class="store-item mx-auto" data-bs-toggle="modal" data-bs-target="#storeModal1">
                            <div class="store-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="store-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/stores/K.png" alt="..." width="200" height="200"/>
                        </div>
                    </div>
                    <!-- Store Item 2-->
                    <div class="col-md-6 col-lg-4 mb-5 text-center">
                        <div class="store-item mx-auto" data-bs-toggle="modal" data-bs-target="#storeModal2">
                            <div class="store-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="store-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/stores/vinmart.png" alt="..." width="200" height="200"/>
                        </div>
                    </div>
                    <!-- Store Item 3-->
                    <div class="col-md-6 col-lg-4 mb-5 text-center">
                        <div class="store-item mx-auto" data-bs-toggle="modal" data-bs-target="#storeModal3">
                            <div class="store-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="store-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/stores/GS25.png" alt="..." width="200" height="200"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Địa điểm</h4>
                        <p class="lead mb-0">
                            Trường CNTT & TT
                            <br />
                            Đại học Cần Thơ
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Liên hệ</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small> &copy;Copyright: CT298 - N01</small></div>
        </div>
        <!-- Store Modals-->
        <!-- Store Modal 1-->
        <div class="store-modal modal fade" id="storeModal1" tabindex="-1" aria-labelledby="storeModal1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Store Modal - Title-->
                                    <h2 class="store-modal-title text-secondary text-uppercase mb-0">Circle K</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Store Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/stores/K.png" alt="..."  width="200"/>
                                    <!-- Store Modal - Text-->
                                    <p class="mb-4">Circle K là chuỗi cửa hàng tiện lợi quốc tế, được thành lập năm 1951 tại El Paso, Texas, Hoa Kỳ. Nó hiện đang được sở hữu và điều hành bởi Alimentation Couche-Tard có trụ sở tại Canada. Nó có mặt ở hầu hết 50 tiểu bang của Hoa Kỳ, tất cả các tỉnh của Canada và một số quốc gia Châu Âu (Đan Mạch, Estonia, Ireland, Latvia, Lithuania, Na Uy, Ba Lan, Nga và Thụy Điển). Ở châu Á và châu Mỹ Latinh, thương hiệu được sử dụng bởi các nhà nhượng quyền. Tại Việt Nam, Circle K có gần 400 cửa hàng.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Store Modal 2-->
        <div class="store-modal modal fade" id="storeModal2" tabindex="-1" aria-labelledby="storeModal2" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Store Modal - Title-->
                                    <h2 class="store-modal-title text-secondary text-uppercase mb-0">VinMart</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Store Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/stores/vinmart.png" alt="..." width="200"/>
                                    <!-- Store Modal - Text-->
                                    <p class="mb-4">Vinmart là hệ thống siêu thị được thành lập bởi tập đoàn Vingroup, Việt Nam. Hệ thống này khai trương ngày 20 tháng 11 năm 2014. Theo thống kê của Vietnam Report, tính đến tháng 11/2017, VinMart và chuỗi cửa hàng con VinMart+ nằm top 2 nhà bán lẻ được người tiêu dùng quan tâm nhất và top 4 trên bảng xếp hạng 10 nhà bán lẻ uy tín năm 2017.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Store Modal 3-->
        <div class="store-modal modal fade" id="storeModal3" tabindex="-1" aria-labelledby="storeModal3" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Store Modal - Title-->
                                    <h2 class="store-modal-title text-secondary text-uppercase mb-0">GS25</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Store Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/stores/GS25.png" alt="..." width="200"/>
                                    <!-- Store Modal - Text-->
                                    <p class="mb-4">GS25 là chuỗi cửa hàng tiện lợi của Hàn Quốc được điều hành và sở hữu bởi GS Retail. GS25 là chuỗi cửa hàng tiện lợi số 1 Hàn Quốc vì công ty này được khách hàng yêu thích đến mức nó đã được xếp hạng số 1 trong 8 năm trong một đánh giá đáng tin cậy được gọi là KS-SQI (Korean Standard Services Quality Index). Tại Việt Nam, GS25 có khoảng 209 cửa hàng.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
