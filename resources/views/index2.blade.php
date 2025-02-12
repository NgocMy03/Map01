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

    <style>
        #map { height: 800px; width: 100%; }
        #search-box { width: 300px; padding: 8px; margin-bottom: 10px; }
        #suggestions { list-style-type: none; padding: 0; }
        #suggestions li { padding: 5px; cursor: pointer; background: #f8f9fa; border-bottom: 1px solid #ccc; }
        #suggestions li:hover { background: #e9ecef; }
    </style>
</head>
<body>

    <input type="text" id="search-box" placeholder="Tìm kiếm địa điểm...">
    <ul id="suggestions"></ul>
    <div id="map"></div>

    @php
    $locations = $stores->map(function ($store) {
        return [
            'coords' => array_map('floatval', explode(',', $store->toadoGPS)), // Chuyển tọa độ thành mảng số
            'name' => $store->ten,
            'popupContent' => "<img src=\"images/{$store->hinh}\" width=\"45\">
                                <h3>{$store->ten}</h3>
                                <p>{$store->diachi}</p>
                                <p>SĐT: {$store->SDT}</p>"
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
            markers.push({ marker, name: location.name, coords: location.coords });
        });

        // Gợi ý danh sách khi nhập tìm kiếm
        var searchBox = document.getElementById('search-box');
        var suggestions = document.getElementById('suggestions');

        searchBox.addEventListener('input', function () {
            var searchText = this.value.toLowerCase();
            suggestions.innerHTML = "";
            if (searchText) {
                locations.forEach(location => {
                    if (location.name.toLowerCase().includes(searchText)) {
                        var li = document.createElement('li');
                        li.textContent = location.name;
                        li.addEventListener('click', function () {
                            map.setView(location.coords, 15);
                            L.popup().setLatLng(location.coords).setContent(location.popupContent).openOn(map);
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
                navigator.geolocation.getCurrentPosition(function (position) {
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;

                    // Hiển thị marker tại vị trí người dùng
                    var userMarker = L.marker([userLat, userLng], { title: "Vị trí của bạn" }).addTo(map);
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
                }, function (error) {
                    alert("Không thể lấy được vị trí của bạn: " + error.message);
                });
            } else {
                alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
            }
        }
    </script>
</body>
</html>





























{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <title>Map Interaction Animation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Import Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Import Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Import Leaflet Control Geocode -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <meta charset="utf-8">
</head>

<body>
    <div id="left">Left content</div>
    <div id="map">Map content</div>
    <div id="right">Right content</div>
</body>

@php
    $locations = $stores->map(function ($store) {
    return [
            'coords' => array_map('floatval', explode(',', $store->toadoGPS)), // Chuyển chuỗi tọa độ thành mảng số
            'popupContent' => "<h3>{$store->ten}</h3><p>{$store->diachi}</p><p>SĐT: {$store->SDT}</p>"
        ];
    });
@endphp

<script>

      // Thêm các vị trí với marker
      var locations = @json($locations);
    // console.log(locations);
    // Duyệt danh sách địa điểm và tạo các marker cùng với popup
    locations.forEach(location => {
        var marker = L.marker(location.coords, { title: "Vị trí" }).addTo(map);
        marker.bindPopup(location.popupContent, { maxWidth: '500', className: 'custom' }).openPopup();
    });
</script>

<script>
    var map = L.map('map').setView([10.027903, 105.766918], 13);
    // Thêm lớp bản đồ OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Tích hợp Leaflet Control Geocoder
    var geocoder = L.Control.Geocoder.nominatim();
    // Tích hợp Leaflet Control Geocoder
    var control = L.Control.geocoder({
        defaultMarkGeocode: true
    }).addTo(map);
    // Lắng nghe sự kiện khi tìm kiếm
    control.on('markgeocode', function (e) {
        var center = e.geocode.center; // Tọa độ được trả về
        L.marker(center).addTo(map) // Thêm marker tại vị trí
            .bindPopup(e.geocode.name) // Thông báo tên địa điểm
            .openPopup();
        map.setView(center, 15); // Di chuyển bản đồ tới vị trí
    });



</script>

</html> --}}

