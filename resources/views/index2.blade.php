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
    <style>
        #map { height: 800px; width: 100%; }
        #search-box { width: 300px; padding: 8px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <input type="text" id="search-box" placeholder="Tìm kiếm địa điểm...">
    <div id="map"></div>


    @php
    $locations = $stores->map(function ($store) {
    return [
            'coords' => array_map('floatval', explode(',', $store->toadoGPS)), // Chuyển chuỗi tọa độ thành mảng số
            'popupContent' => "<h3>{$store->ten}</h3><p>{$store->diachi}</p><p>SĐT: {$store->SDT}</p>"
        ];
    });
    @endphp


    <script>
        var map = L.map('map').setView([10.0275903, 105.7664918], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);


        // Dữ liệu stores từ database
        var locations = @json($locations);

        locations.forEach(location => {
            var marker = L.marker(location.coords).addTo(map);
            marker.bindPopup(location.popupContent);
        });


        // Tìm kiếm trong danh sách đánh dấu
        document.getElementById('search-box').addEventListener('input', function () {
            var searchText = this.value.toLowerCase();
            locations.forEach(location => {
                if (location.popupContent.toLowerCase().includes(searchText)) {
                    map.setView(location.coords, 15);
                    L.marker(location.coords, { title: "Kết quả tìm kiếm" })
                        .addTo(map)
                        .bindPopup(location.popupContent)
                        .openPopup();
                }
            });
        });
    </script>
</body>
</html>
