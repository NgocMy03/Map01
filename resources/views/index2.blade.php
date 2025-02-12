<!DOCTYPE html>
<html lang="en">

<head>
    <title>Map Interaction</title>
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

</html>
