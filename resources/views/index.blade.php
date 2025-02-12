<html>

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

    // Thiết lập thông số cho bản đồ
    var mapOptions = {
        center: [10.0275903, 105.7664918],
        zoom: 10
    };

    // Khai báo đối tượng bản đồ
    var map = new L.map('map', mapOptions);

    // Khai báo lớp bản đồ
    // Bản đồ bình thường
    // var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

    // Bản đồ cho người giàu
    var layer = new L.TileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoidG5tdGhhaSIsImEiOiJjbTV6dmJkdDUwN2Z2MmpvbHFwZTh0ZWx4In0.9mBKVlZGAER20CSY-9NddQ');

    // Thêm mới lớp bản đồ vào bản đồ
    map.addLayer(layer);


    // Tuỳ chỉnh icon
    var customIcon = new L.Icon({
        iconUrl: 'ctu.png', // Đường dẫn đến hình ảnh biểu tượng
        iconSize: [32, 32],         // Kích thước của biểu tượng [width, height]
        iconAnchor: [16, 32],       // Điểm neo của biểu tượng [x, y]
        popupAnchor: [0, -32],      // Điểm xuất hiện của popup so với biểu tượng [x, y]
        shadowUrl: 'path/to/shadow.png', // (Tùy chọn) Đường dẫn đến hình ảnh bóng của biểu tượng
        shadowSize: [32, 32],       // (Tùy chọn) Kích thước bóng
        shadowAnchor: [16, 32]      // (Tùy chọn) Điểm neo bóng
    });

    // Khai báo biến để trỏ đến marker
    // var marker = new L.marker([lat, long]);
    // Cho phép hiển thị marker với icon mặc định tại vị trí lat, long
    // Khai báo marker với tọa độ và các tùy chọn
    var marker = new L.marker(
        [10.030197811576784, 105.77059383715664],
        {
            icon: customIcon,
            title: "Trường đại học Cần Thơ",
            alt: "CTU"
        }
    );

    // Thêm marker vào bản đồ
    marker.addTo(map);


    // Nội dung popup hiển thị khi click vào marker
    var popupContent = `
    <div style="font-family: Arial, sans-serif; font-size: 14px;">
        <h3 style="color: #2584d8;">Thông tin địa điểm</h3>
        <p><strong>Tên địa điểm:</strong> Trường Đại Học Cần Thơ</p>
        <p><strong>Vị trí:</strong> DBSCL</p>
        <p><strong>Chi tiết:</strong> Đại học cần thơ là đại học cần thơ <3</p>
        <img src="dhct.jpg"
             alt="Image" style="width: 300px; height: auto;">
    </div>
`;

    // Gán nội dung popup vào marker và hiển thị khi click
    marker.bindPopup(popupContent);

    // Mở popup ngay lập tức nếu cần
    marker.openPopup();

    // let coordinate = [];
    // fetch('http://127.0.0.1:8000/api/stores')
    //     .then(response => response.json())
    //     .then(data => {
    //         data.
    //     });
    // Thêm các vị trí với marker
    var locations = @json($locations);
    // console.log(locations);

    // Duyệt danh sách địa điểm và tạo các marker cùng với popup
    locations.forEach(location => {
        var marker = L.marker(location.coords, { title: "Vị trí" }).addTo(map);
        marker.bindPopup(location.popupContent, { maxWidth: '500', className: 'custom' }).openPopup();
    });

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


<!-- Xác định vị trí hiện tại -->


<script>
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            // Lấy tọa độ người dùng
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Hiển thị marker tại vị trí người dùng
            var userMarker = L.marker([latitude, longitude], { title: "Vị trí của bạn" }).addTo(map);

            // Gắn nội dung popup
            userMarker.bindPopup(`<h3>Vị trí của bạn</h3><p>Latitude: ${latitude}</p><p>Longitude: ${longitude}</p>`).openPopup();

            // Tự động điều chỉnh bản đồ hiển thị vị trí người dùng
            map.setView([latitude, longitude], 14);
        }, function (error) {
            // Xử lý lỗi nếu không lấy được vị trí
            alert("Không thể lấy được vị trí của bạn: " + error.message);
        });
    } else {
        alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
    }
</script>

</html>
