<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;
use App\Models\Product;
use App\Models\Category;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


// Home
Breadcrumbs::for('home.index', function (BreadcrumbTrail $trail) {
    $trail->push('Trang Chủ', route('home.index'));
});

// Sản Phẩm
Breadcrumbs::for('home.product', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Sản Phẩm', route('home.product'));
});

Breadcrumbs::for('home.product_slug', function (BreadcrumbTrail $trail , $slug) {
    $trail->parent('home.index');
    $category = Category::where('slug',$slug)->first();
    $trail->push($category->name, route('home.product_slug',$slug));
});

// Sản Phẩm Single
Breadcrumbs::for('home.product_single', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('home.product');
    // Fetch the product using the ID
    $product = Product::findOrFail($id);

    $trail->push($product->name, route('home.product_single', $id));
});

// About
Breadcrumbs::for('home.about', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Giới Thiệu', route('home.about'));
});

// Service
Breadcrumbs::for('home.service', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Dịch Vụ', route('home.service'));
});

// Service Detail
Breadcrumbs::for('home.service_detail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('home.service');
    $trail->push('Service Detail', route('home.service_detail', $id));
});

// Blog
Breadcrumbs::for('home.blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Blog', route('home.blog'));
});

// Blog Detail
Breadcrumbs::for('home.blog_detail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('home.blog');

    $trail->push('Blog Detail', route('home.blog_detail', $id));
});

// Contact
Breadcrumbs::for('home.contact', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Liên Hệ', route('home.contact'));
});

// Pricing Package
Breadcrumbs::for('home.pricing_package', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Báo Giá', route('home.pricing_package'));
});

// History
Breadcrumbs::for('home.history', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Lịch Sử Phát Triển', route('home.history'));
});

// Checkout
Breadcrumbs::for('home.checkout', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Thanh Toán', route('home.checkout'));
});

// Complete Order
Breadcrumbs::for('home.complete_order', function (BreadcrumbTrail $trail, $sku) {
    $trail->parent('home.checkout');
    $trail->push('Đặt Hàng Thành Công', route('home.complete_order', $sku));
});

// My Account
Breadcrumbs::for('home.account', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Tài Khoản Của Tôi', route('home.account'));
});

// Search
Breadcrumbs::for('home.search', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Tìm Kiếm', route('home.search'));
});

// wishlist
Breadcrumbs::for('wishlist.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Sản Phẩm Yêu Thích', route('wishlist.index'));
});

// Cart
Breadcrumbs::for('cart.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Giỏ Hàng', route('cart.index'));
});

Breadcrumbs::for('cart.add', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('home.index');
    $trail->push('Giỏ Hàng', route('cart.add',$id));
});

Breadcrumbs::for('cart.update', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Giỏ Hàng', route('cart.update'));
});

Breadcrumbs::for('cart.remove', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Giỏ Hàng', route('cart.remove'));
});
// Login

Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Đăng Nhập', route('login'));
});


Breadcrumbs::for('register', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Đăng Ký', route('register'));
});
