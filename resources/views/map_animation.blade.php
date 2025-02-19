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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- CSS cho Map Animation -->
    <link rel="stylesheet" href="{{ asset('css/map_animation.css') }}">
    </link>
</head>

<style>

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
            return [
                'coords' => array_map('floatval', explode(',', $store->toadoGPS)), // Chuyển tọa độ thành mảng số
                'name' => $store->ten,
                'popupContent' => "<img src=\"assets/img/stores/{$store->hinh}\" width=\"45\">
                                <h3>{$store->ten}</h3>
                                <p>{$store->diachi}</p>
                                <p>SĐT: {$store->SDT}</p>
                                <button class=\"btn btn-primary btn-routing-move\" onclick=\"getUserLocationAndRoute([{$store->toadoGPS}])\">
                                    <i class=\"fa-solid fa-car pe-2\"></i>Đường đi
                                </button>",
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
    console.log("Store name:", location.name);

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
</body>

</html>
