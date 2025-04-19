<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<b style="font-size: 18px;">🚀 Hướng Dẫn Cài Đặt Và Chạy Dự Án Laravel</b>
<br><b>Yêu cầu hệ thống:</b><br>
- PHP >= 8.<br>
- Composer<br>
- MySQL<br>
- Visual Studio Code<br>

<br><b>Cài Đặt:</b><br>
- Clone dự án về máy qua câu lệnh: 
  <code>git clone https://github.com/NgocMy03/Map01.git</code><br>
- Cài đặt các package PHP: 
  <code>composer install</code><br>
- Tạo file <code>.env</code><br>
- Copy nội dung từ file <code>.env.example</code> và chỉnh sửa lại phần kết nối cơ sở dữ liệu trong file <code>.env</code>:<br>
  <code>DB_DATABASE=ct298map01</code><br>

<b>Khôi phục cơ sở dữ liệu bằng phpMyAdmin:</b><br>
+ Mở: <a href="http://localhost/phpmyadmin" target="_blank">http://localhost/phpmyadmin</a><br>
+ Tạo database tên <code>ct298map01</code><br>
+ Import file <code>ct298map01.sql</code> vào database vừa tạo<br>

- Tạo key ứng dụng:
  <code>php artisan key:generate</code><br>
- Chạy Laravel Server: 
  <code>php artisan serve</code> 
  (Sử dụng <b>Ctrl + Click chuột</b> vào đường dẫn để mở dự án)<br>

<br><b>✅ Kết quả:</b><br>
Truy cập ứng dụng tại địa chỉ: 
<a href="http://localhost:8000" target="_blank">http://localhost:8000</a>








