{{-- @php
    dd($stores);
@endphp --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Map Interaction</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <!-- Thư viện dẫn đường -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- CSS cho Map Animation -->
    <link rel="stylesheet" href="{{ asset('css/map_animation.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    </link>
</head>

<style>
    .swiper-slide {
        display: flex;
        justify-content: center;
    }

    .swiper-button-next:after {
        font-size: 16px;
    }


    .swiper-button-prev:after {
        font-size: 16px;
    }


    .star-rating input {
        display: none;
    }

    .star-rating label {
        font-size: 2rem;
        color: gray;
        cursor: pointer;
    }

    .star-rating input:checked~label,
    .star-rating label:hover,
    .star-rating label:hover~label {
        color: gold;
    }

    #compareProductPrice {
        width: 70% !important;
        /* Tăng kích thước lên 70% */
        max-width: 600px;
        /* Giới hạn tối đa 900px */
    }
</style>

<body>
    <div class="container-fluid p-0">
        <input type="text" id="search-box" class="form-control" placeholder="Tìm kiếm địa điểm...">
        <a id="back-to-home" href="{{ route('Home') }}" title="Về trang chủ"><i class="fa-solid fa-house"></i></a>
        <button id="search-btn" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
        <ul id="suggestions"></ul>
        <div id="map"></div>
        <button id="locate-btn" title="Xác định vị trí của bạn">
            <i class="fa-solid fa-location-crosshairs"></i>
        </button>
        <button id="nearest-store-btn" title="Tìm cửa hàng gần nhất">
            <i class="fa-solid fa-store"></i>
        </button>
        <button class="d-none" id="close-store-routing">
            <i class="fa-solid fa-x"></i>
        </button>
    </div>

    @php
        $locations = $stores->map(function ($store) {
            $productPrice = number_format($store->product_price * 1000, 0, ',', '.');
            return [
                'coords' => array_map('floatval', explode(',', $store->toadoGPS)), // Chuyển tọa độ thành mảng số
                'name' => $store->ten,
                'popupContent' => "<img src=\"assets/img/stores/{$store->hinh}\" width=\"45\">
                                <h3>{$store->ten}</h3>
                                <p>{$store->diachi}</p>
                                <p>SĐT: {$store->SDT}</p>
                                <div class=\"container my-2\">
                                    <div class=\"swiper mySwiper\">
                                        <div class=\"swiper-wrapper\">
                                            <input type=\"hidden\" name=\"id_store\" value=\"{$store->product_id}\">
                                            <div class=\"swiper-slide\">
                                                <div class=\"card\" style=\"width: 100%;\">
                                                    <div class=\"row p-4 g-0 align-items-center\">
                                                        <!-- Hình ảnh bên trái -->
                                                        <div class=\"col-4 d-flex justify-content-center\">
                                                            <img src=\"assets/img/product/{$store->product_image}\" alt=\"Product 1\" class=\"img-fluid\" width=\"150\">
                                                        </div>
                                                        <!-- Nội dung bên phải -->
                                                        <div class=\"col-8\">
                                                            <div class=\"card-body\">
                                                                <h5 class=\"card-title\">{$store->product_name}</h5>
                                                                <span>Giá: {$productPrice}đ</span>
                                                                <p class=\"card-text\">Mô tả sản phẩm 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type=\"button\" class=\"btn btn-success mb-2 w-50 d-flex m-auto justify-content-center\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#compareProductPrice\" onclick=\"compareProductPrice({$store->product_id}, {$store->id})\">So sánh giá</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Nút điều hướng -->
                                        <div class=\"swiper-button-next\"></div>
                                        <div class=\"swiper-button-prev\"></div>

                                     
                                    </div>
                                </div>

                                <div class=\"d-flex justify-content-between align-content-center\">
                                    <button class=\"btn btn-primary btn-routing-move\" onclick=\"getUserLocationAndRoute([{$store->toadoGPS}])\">
                                        <i class=\"fa-solid fa-car pe-2\"></i>Đường đi
                                    </button>
                                    <button type=\"button\" class=\"btn btn-secondary\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#ratingOffcanvas\">
                                         <i class=\"fa-solid fa-comment pe-2\"></i>Đánh giá
                                    </button>
                                </div>",
                'icon' => "assets/img/stores/{$store->hinh}",
            ];
        });
    @endphp

    <script>
        var map = L.map('map').setView([10.0275903, 105.7664918], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var locations = @json($locations);
        var circleKIcon = L.icon({
            iconUrl: 'assets/img/stores/CircleK.png',
            iconSize: [32, 32],
            iconAnchor: [16, 16], // Điều chỉnh lại anchor point
            popupAnchor: [0, -16] // Điều chỉnh lại popup anchor
        });

        var gs25Icon = L.icon({
            iconUrl: 'assets/img/stores/GS.png', // Đường dẫn tới icon GS25
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        var winmartIcon = L.icon({
            iconUrl: 'assets/img/stores/WM.png', // Đường dẫn tới icon Winmart
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        var markers = [];
        var control = null;

        locations.forEach(location => {
            let currentIcon;

            // Debug: In ra tên cửa hàng để kiểm tra
            // console.log(location);
            // console.log("Store coords:", location.coords);

            // Kiểm tra theo tên cửa hàng
            if (location.name.includes('CircleK') || location.name.includes('Circle K')) {
                currentIcon = circleKIcon;
            } else if (location.name.includes('GS25') || location.name.includes('GS')) {
                currentIcon = gs25Icon;
            } else if (location.name.includes('WinMart') || location.name.includes('WM')) {
                currentIcon = winmartIcon;
            } else {
                currentIcon = L.icon({
                    iconUrl: location.icon,
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                });
            }

            var marker = L.marker(location.coords, {
                icon: currentIcon
            }).addTo(map);

            marker.bindPopup(location.popupContent);

            markers.push({
                marker,
                name: location.name,
                coords: location.coords
            });
        });


        // Gợi ý danh sách khi nhập tìm kiếm
        var searchBox = document.getElementById('search-box');
        var suggestions = document.getElementById('suggestions');

        searchBox.addEventListener('input', function() {
            var searchText = this.value.toLowerCase();
            suggestions.innerHTML = "";
            if (searchText) {
                locations.forEach(location => {
                    if (location.name.toLowerCase().includes(searchText)) {
                        var li = document.createElement('li');
                        li.textContent = location.name;
                        li.addEventListener('click', function() {
                            map.setView(location.coords, 15);
                            L.popup().setLatLng(location.coords).setContent(location.popupContent)
                                .openOn(map);
                            suggestions.innerHTML = "";
                        });
                        suggestions.appendChild(li);
                    }
                });
            }
        });

        // Hàm lấy vị trí hiện tại và vẽ tuyến đường
        function getUserLocationAndRoute(destination) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;

                    // Hiển thị marker tại vị trí người dùng
                    var userMarker = L.marker([userLat, userLng], {
                        title: "Vị trí của bạn"
                    }).addTo(map);
                    userMarker.bindPopup("<h3>Vị trí của bạn</h3>").openPopup();

                    // Xóa tuyến đường cũ nếu có
                    if (control) {
                        map.removeControl(control);
                    }

                    // Vẽ tuyến đường mới
                    control = L.Routing.control({
                        waypoints: [
                            L.latLng(userLat, userLng),
                            L.latLng(destination[0], destination[1])
                        ],
                        routeWhileDragging: true
                    }).addTo(map);

                    // Điều chỉnh bản đồ về vị trí người dùng
                    map.setView([userLat, userLng], 14);
                    document.getElementById("close-store-routing").classList.remove("d-none");
                }, function(error) {
                    alert("Không thể lấy được vị trí của bạn: " + error.message);
                });
            } else {
                alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
            }
        }
    </script>

    <script>
        document.getElementById("locate-btn").addEventListener("click", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;

                    var userMarker = L.marker([userLat, userLng], {
                        title: "Vị trí của bạn"
                    }).addTo(map);
                    userMarker.bindPopup("<h3>Vị trí của bạn</h3>").openPopup();

                    map.setView([userLat, userLng], 14);
                }, function(error) {
                    alert("Không thể lấy vị trí của bạn: " + error.message);
                });
            } else {
                alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
            }
        });
    </script>



    <script>
        document.getElementById("nearest-store-btn").addEventListener("click", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Lấy toạ độ vị trí người dùng lưu => lưu kinh độ, vĩ độ ng dùng
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;

                    // Khởi tạo biến lưu cửa hàng gần nhất và khoảng cách nhỏ nhất
                    var nearestStore = null;
                    var minDistance = Infinity;

                    // Duyệt ds store và tính khoảng cách tìm cửa hàng gần nhất
                    locations.forEach(store => {

                        // Kinh độ và vĩ độ của cửa hàng trong ds
                        var storeLat = store.coords[0];
                        var storeLng = store.coords[1];

                        // Tính khoảng cách giữa vị trí hiện tại của người dùng và cửa hàng
                        var distance = getDistance(userLat, userLng, storeLat, storeLng);

                        // Nếu khoảng cách trả ra nhỏ hơn minDistance thì cập nhật lại nearestStore
                        if (distance < minDistance) {
                            minDistance = distance;
                            nearestStore = store;
                        }
                        /*
                            Ví dụ: duyệt ds có 3 cửa hàng với khoảng cách lần lượt là 5 km, 3 km, 7 km.

                            lần 1: Store A (5 km)
                            → distance = 5 km
                            5 < Infinity → Cập nhật: minDistance = 5
                            => nearestStore = Store A

                            lần 2: Store B (3 km)
                            → distance = 3 km
                            3 < 5 (minDistance) → Cập nhật: minDistance = 3
                            => nearestStore = Store B

                            lần 3: Store C (7 km)
                            → distance = 7 km
                            7 > 3 (minDistance) → Không cập nhật
                            => Kết quả: nearestStore = Store B (3 km gần nhất).
                        */
                    });

                    // Nếu tìm được điểm gần nhất thì vẽ đường đi từ vị trí người dùng đến cửa hàng đó
                    if (nearestStore) {
                        if (control) {
                            // xoá tuyến đường cũ nếu đã tồn tại
                            map.removeControl(control);
                        }
                        control = L.Routing.control({
                            waypoints: [
                                L.latLng(userLat, userLng),
                                L.latLng(nearestStore.coords[0], nearestStore.coords[1])
                            ],
                            routeWhileDragging: true
                        }).addTo(map);
                        // Hiển thị bản đồ tại vị trí cửa hàng gần nhất
                        map.setView(nearestStore.coords, 15);
                        L.popup().setLatLng(nearestStore.coords)
                            .setContent(nearestStore.popupContent)
                            .openOn(map);
                    }
                    document.getElementById("close-store-routing").classList.remove("d-none");
                }, function(error) {
                    alert("Không thể lấy vị trí của bạn: " + error.message);
                });
            } else {
                alert("Trình duyệt không hỗ trợ định vị.");
            }
        });

        document.getElementById("close-store-routing").addEventListener("click", function() {
            if (control) {
                map.removeControl(control);
                document.getElementById("close-store-routing").classList.add("d-none");
            }
        });

        // Hàm tính khoảng cách giữa 2 điểm theo công thức Haversine => Xác định khoảng cách nếu biết kinh độ(lon) và vĩ độ(lat) của 2 điểm
        function getDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Bán kính xấp xĩ của Trái Đất (km)
            // Đổi từ độ sang radian
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;

            // Công thức Haversine
            // Tính khoảng cách theo vĩ độ (Math.sin(dLat / 2) * Math.sin(dLat / 2)).
            // Tính khoảng cách theo kinh độ (Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon / 2) * Math.sin(dLon / 2)).
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            // hàm Math.atan2(y, x) trả về góc giữa (x, y) với gốc tọa độ => Công thức tính góc cung lớn nhất giữa hai điểm trên mặt cầu
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // Khoảng cách giữa hai điểm, đơn vị (km)
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        map.on('popupopen', function() {
            new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                // pagination: {
                //     el: ".swiper-pagination",
                //     clickable: true,
                // },
                loop: true
            });
        });
        // <!-- Dấu hiệu trang -->
        // <div class=\"swiper-pagination\"></div>
    </script>



    <!-- Offcanvas Đánh Giá -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="ratingOffcanvas" aria-labelledby="ratingOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="ratingOffcanvasLabel">Đánh Giá Cửa Hàng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Form Đánh Giá -->
            <form id="ratingForm">
                <div class="mb-3 text-center star-rating">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Nhận xét của bạn</label>
                    <textarea class="form-control" id="comment" rows="3" placeholder="Viết nhận xét..."></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Gửi đánh giá</button>
            </form>

            <!-- Dữ liệu giả - Đánh giá gần đây -->
            <hr>
            <h5 class="mt-3">⭐ Đánh Giá Gần Đây</h5>

            <div id="reviewsList">
                <div class="review-item border-bottom pb-3 mb-3">
                    <h6>Nguyễn Văn A</h6>
                    <div class="text-warning">⭐⭐⭐⭐☆ (4/5)</div>
                    <small class="text-muted">2 ngày trước</small>
                    <p>Shop phục vụ tốt, giao hàng nhanh.</p>
                </div>

                <div class="review-item border-bottom pb-3 mb-3">
                    <h6>Trần Thị B</h6>
                    <div class="text-warning">⭐⭐⭐⭐⭐ (5/5)</div>
                    <small class="text-muted">1 tuần trước</small>
                    <p>Chất lượng sản phẩm rất tốt, mình rất hài lòng.</p>
                </div>

                <div class="review-item border-bottom pb-3 mb-3">
                    <h6>Phạm Văn C</h6>
                    <div class="text-warning">⭐⭐⭐☆☆ (3/5)</div>
                    <small class="text-muted">3 tuần trước</small>
                    <p>Sản phẩm ổn, nhưng giao hàng hơi chậm.</p>
                </div>
            </div>
        </div>
    </div>



    <!-- Offcanvas So Sánh Giá -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="compareProductPrice"
        aria-labelledby="compareProductPriceLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold" id="compareProductPriceLabel">🔍 So Sánh Giá Sản Phẩm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row container-compare-product">
            </div>
        </div>
    </div>

    <script>
        compareProductPrice = (product_id, store_id) => {
            console.log(product_id);
            fetch('/api/compare-product-price/' + product_id + "/" + store_id)
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    document.querySelector(".container-compare-product").innerHTML = "";
                    document.querySelector(".container-compare-product").innerHTML += `
                                <div class="col-md-5 border-end pe-3">
                                        <div class="text-center">
                                            <img src="assets/img/product/${data[0].hinhanh}" class="img-fluid rounded shadow-sm" alt="Sản phẩm">
                                        </div>
                                        <h3>${data[0].store_name}</h3>
                                        <h4 class="fw-bold mt-3">${data[0].ten}</h4>
                                        <p class="text-danger fs-4 fw-bold">💰 ${Intl.NumberFormat('vi-VN').format(data[0].gia*1000)}đ</p>
                                        <p class="text-muted">📌 Mô tả ngắn gön về sản phẩm...</p>
                                </div>
                                <div class="col-md-7 list-product">
                                </div>
                            `
                    let col7 = document.querySelector(".list-product");
                    for (let i = 1; i < data.length; i++) {
                        let col7_content = document.createElement("div");
                        col7_content.classList.add("store-list");
                        col7_content.innerHTML = `
                                            <div class="card mb-3 shadow-sm">
                                                <div class="row g-0">
                                                    <div class="col-md-3 d-flex align-items-center">
                                                        <img src="assets/img/product/${data[i].hinhanh}" class="img-fluid rounded-start"
                                                            alt="Sản phẩm">
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="card-body">
                                                            <h6 class="fw-bold">${data[i].store_name}</h6>
                                                            <h4 class="fw-bold mt-3">${data[i].ten}</h4>
                                                            <p class="text-danger fw-bold fs-5">${Intl.NumberFormat('vi-VN').format(data[i].gia*1000)}đ</p>
                                                            <button class="btn btn-sm btn-primary w-100">🛒 Đến Ngay</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`
                        col7.append(col7_content);
                    }
                    // console.log(col7);
                });
        }
    </script>

</body>


</html>
