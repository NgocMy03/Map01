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
    <link rel="stylesheet" href="{{ asset('css/map_animation.css') }}"></link>
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
    </div>

    @php
        $locations = $stores->map(function ($store) {
            return [
                'coords' => array_map('floatval', explode(',', $store->toadoGPS)), // Chuyển tọa độ thành mảng số
                'name' => $store->ten,
                'popupContent' => "<img src=\"assets/img/stores/{$store->hinh}\" width=\"45\">
                                <h3>{$store->ten}</h3>
                                <p>{$store->diachi}</p>
                                <p>SĐT: {$store->SDT}</p>",
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

        var markers = [];
        var control = null;

        // Thêm marker cho mỗi địa điểm
        locations.forEach(location => {
            var marker = L.marker(location.coords).addTo(map);
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
                            getUserLocationAndRoute(location.coords);
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
                }, function(error) {
                    alert("Không thể lấy được vị trí của bạn: " + error.message);
                });
            } else {
                alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
            }
        }
    </script>

    <script>
         document.getElementById("locate-btn").addEventListener("click", function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;

                    var userMarker = L.marker([userLat, userLng], {
                        title: "Vị trí của bạn"
                    }).addTo(map);
                    userMarker.bindPopup("<h3>Vị trí của bạn</h3>").openPopup();
                    
                    map.setView([userLat, userLng], 14);
                }, function (error) {
                    alert("Không thể lấy vị trí của bạn: " + error.message);
                });
            } else {
                alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
            }
        });
    </script>
</body>

</html>
