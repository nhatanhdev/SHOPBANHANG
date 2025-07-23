<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\AttributeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\OrderStatusController;
use App\Http\Controllers\admin\VoucherController;
use App\Http\Controllers\admin\InfrastructureCityController;
use App\Http\Controllers\admin\InfrastructureDistrictController;
use App\Http\Controllers\admin\InfrastructureWardController;
use App\Http\Controllers\admin\MediaController;
use App\Http\Controllers\admin\SaleStatisticController;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\SearchController;
use App\Http\Controllers\admin\SeoController;
use App\Http\Controllers\admin\RatingController;
use App\Http\Controllers\admin\FlashSaleController;



Route::prefix('admin')->middleware('login')->group(function () {
    Route::get('/dashboard', [SaleStatisticController::class, 'index'])->name('admin.saleStatistic.index');

    Route::get('/search', [SearchController::class, 'search'])->name('admin.search');

    Route::prefix('categories')->group(function () {
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create')->middleware('can:category-add');
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index')->middleware('can:category-list');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store')->middleware('can:category-add');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit')->middleware('can:category-edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update')->middleware('can:category-edit');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete')->middleware('can:category-delete');
        Route::get('/search', [CategoryController::class, 'search'])->name('admin.category.search')->middleware('can:category-list');


    });

    Route::prefix('products')->group(function () {
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create')->middleware('can:product-add');
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index')->middleware('can:product-list');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store')->middleware('can:product-add');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit')->middleware('can:product-edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update')->middleware('can:product-edit');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete')->middleware('can:product-delete');
        Route::post('/options', [ProductController::class, 'Html_options'])->name('admin.product.options')->middleware('can:product-edit');
        Route::get('/search', [ProductController::class, 'search'])->name('admin.product.search')->middleware('can:product-list');

    });


    Route::prefix('users')->group(function () {
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create')->middleware('can:user-add');
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index')->middleware('can:user-list');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store')->middleware('can:user-add');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit')->middleware('can:user-edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('admin.user.update')->middleware('can:user-edit');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.delete')->middleware('can:user-delete');
        Route::get('/search', [UserController::class, 'search'])->name('admin.user.search')->middleware('can:user-list');

    });

    Route::prefix('roles')->group(function () {
        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create')->middleware('can:role-add');
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index')->middleware('can:role-list');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.role.store')->middleware('can:role-add');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit')->middleware('can:role-edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('admin.role.update')->middleware('can:role-edit');
        Route::get('/delete/{id}', [RoleController::class, 'destroy'])->name('admin.role.delete')->middleware('can:role-delete');
        Route::get('/search', [RoleController::class, 'search'])->name('admin.role.search')->middleware('can:role-list');

    });


    Route::prefix('permissions')->group(function () {
        Route::get('/create', [PermissionController::class, 'create'])->name('admin.permission.create')->middleware('can:permission-add');
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permission.index')->middleware('can:permission-list');
        Route::post('/store', [PermissionController::class, 'store'])->name('admin.permission.store')->middleware('can:permission-add');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit')->middleware('can:permission-edit');
        Route::post('/update/{id}', [PermissionController::class, 'update'])->name('admin.permission.update')->middleware('can:permission-edit');
        Route::get('/delete/{id}', [PermissionController::class, 'destroy'])->name('admin.permission.delete')->middleware('can:permission-delete');
        Route::get('/search', [PermissionController::class, 'search'])->name('admin.permission.search')->middleware('can:permission-list');

    });


    Route::prefix('settings')->group(function () {
        Route::get('/create', [SettingController::class, 'create'])->name('admin.setting.create')->middleware('can:setting-add');
        Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index')->middleware('can:setting-list');
        Route::post('/store', [SettingController::class, 'store'])->name('admin.setting.store')->middleware('can:setting-add');
        Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('admin.setting.edit')->middleware('can:setting-edit');
        Route::post('/update/{id}', [SettingController::class, 'update'])->name('admin.setting.update')->middleware('can:setting-edit');
        Route::get('/delete/{id}', [SettingController::class, 'destroy'])->name('admin.setting.delete')->middleware('can:setting-delete');
        Route::get('/search', [SettingController::class, 'search'])->name('admin.setting.search')->middleware('can:setting-list');

    });

    Route::prefix('sliders')->group(function () {
        Route::get('/create', [SliderController::class, 'create'])->name('admin.slider.create')->middleware('can:slider-add');
        Route::get('/', [SliderController::class, 'index'])->name('admin.slider.index')->middleware('can:slider-list');
        Route::post('/store', [SliderController::class, 'store'])->name('admin.slider.store')->middleware('can:slider-add');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('admin.slider.edit')->middleware('can:slider-edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('admin.slider.update')->middleware('can:slider-edit');
        Route::get('/delete/{id}', [SliderController::class, 'destroy'])->name('admin.slider.delete')->middleware('can:slider-delete');
        Route::get('/search', [SliderController::class, 'search'])->name('admin.slider.search')->middleware('can:slider-list');

    });
    Route::prefix('attributes')->group(function () {
        Route::get('/create', [AttributeController::class, 'create'])->name('admin.attribute.create')->middleware('can:attribute-add');
        Route::get('/', [AttributeController::class, 'index'])->name('admin.attribute.index')->middleware('can:attribute-list');
        Route::post('/store', [AttributeController::class, 'store'])->name('admin.attribute.store')->middleware('can:attribute-add');
        Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('admin.attribute.edit')->middleware('can:attribute-edit');
        Route::get('/edit1/{id}', [AttributeController::class, 'edit1'])->name('admin.attribute.edit1')->middleware('can:attribute-edit');
        Route::post('/update/{id}', [AttributeController::class, 'update'])->name('admin.attribute.update')->middleware('can:attribute-edit');
        Route::get('/delete/{id}', [AttributeController::class, 'destroy'])->name('admin.attribute.delete')->middleware('can:attribute-delete');
        Route::get('/search', [AttributeController::class, 'search'])->name('admin.attribute.search')->middleware('can:attribute-list');



    });

    Route::prefix('orders')->group(function () {
        Route::get('/create', [OrderController::class, 'create'])->name('admin.order.create')->middleware('can:order-add');
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index')->middleware('can:order-list');
        Route::post('/store', [OrderController::class, 'store'])->name('admin.order.store')->middleware('can:order-add');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('admin.order.edit')->middleware('can:order-edit');
        Route::post('/update/{id}', [OrderController::class, 'update'])->name('admin.order.update')->middleware('can:order-edit');
        Route::get('/delete/{id}', [OrderController::class, 'destroy'])->name('admin.order.delete')->middleware('can:order-delete');
        Route::post('/detail', [OrderController::class, 'detail'])->name('admin.order.detail')->middleware('can:order-list');
        Route::get('/search', [OrderController::class, 'search'])->name('admin.order.search')->middleware('can:order-list');

    });

    Route::prefix('payments')->group(function () {
        Route::get('/create', [PaymentController::class, 'create'])->name('admin.payment.create')->middleware('can:payment-add');
        Route::get('/', [PaymentController::class, 'index'])->name('admin.payment.index')->middleware('can:payment-list');
        Route::post('/store', [PaymentController::class, 'store'])->name('admin.payment.store')->middleware('can:payment-add');
        Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('admin.payment.edit')->middleware('can:payment-edit');
        Route::post('/update/{id}', [PaymentController::class, 'update'])->name('admin.payment.update')->middleware('can:payment-edit');
        Route::get('/delete/{id}', [PaymentController::class, 'destroy'])->name('admin.payment.delete')->middleware('can:payment-delete');
        Route::post('/detail', [PaymentController::class, 'detail'])->name('admin.payment.detail')->middleware('can:payment-list');
        Route::get('/search', [PaymentController::class, 'search'])->name('admin.payment.search')->middleware('can:payment-list');

    });
    Route::prefix('orderStatuses')->group(function () {
        Route::get('/create', [OrderStatusController::class, 'create'])->name('admin.orderStatus.create')->middleware('can:orderStatus-add');
        Route::get('/', [OrderStatusController::class, 'index'])->name('admin.orderStatus.index')->middleware('can:orderStatus-list');
        Route::post('/store', [OrderStatusController::class, 'store'])->name('admin.orderStatus.store')->middleware('can:orderStatus-add');
        Route::get('/edit/{id}', [OrderStatusController::class, 'edit'])->name('admin.orderStatus.edit')->middleware('can:orderStatus-edit');
        Route::post('/update/{id}', [OrderStatusController::class, 'update'])->name('admin.orderStatus.update')->middleware('can:orderStatus-edit');
        Route::get('/delete/{id}', [OrderStatusController::class, 'destroy'])->name('admin.orderStatus.delete')->middleware('can:orderStatus-delete');
        Route::post('/detail', [OrderStatusController::class, 'detail'])->name('admin.orderStatus.detail')->middleware('can:orderStatus-list');
        Route::get('/search', [OrderStatusController::class, 'search'])->name('admin.orderStatus.search')->middleware('can:orderStatus-list');

    });
    Route::prefix('vouchers')->group(function () {
        Route::get('/create', [VoucherController::class, 'create'])->name('admin.voucher.create')->middleware('can:voucher-add');
        Route::get('/', [VoucherController::class, 'index'])->name('admin.voucher.index')->middleware('can:voucher-list');
        Route::post('/store', [VoucherController::class, 'store'])->name('admin.voucher.store')->middleware('can:voucher-add');
        Route::get('/edit/{id}', [VoucherController::class, 'edit'])->name('admin.voucher.edit')->middleware('can:voucher-edit');
        Route::post('/update/{id}', [VoucherController::class, 'update'])->name('admin.voucher.update')->middleware('can:voucher-edit');
        Route::get('/delete/{id}', [VoucherController::class, 'destroy'])->name('admin.voucher.delete')->middleware('can:voucher-delete');
        Route::post('/detail', [VoucherController::class, 'detail'])->name('admin.voucher.detail')->middleware('can:voucher-list');
        Route::get('/search', [VoucherController::class, 'search'])->name('admin.voucher.search')->middleware('can:voucher-list');

    });

    Route::prefix('inventories')->group(function () {
        Route::get('/create', [InventoryController::class, 'create'])->name('admin.inventory.create')->middleware('can:inventory-add');
        Route::get('/', [InventoryController::class, 'index'])->name('admin.inventory.index')->middleware('can:inventory-list');
        Route::post('/store', [InventoryController::class, 'store'])->name('admin.inventory.store')->middleware('can:inventory-add');
        Route::get('/edit/{id}', [InventoryController::class, 'edit'])->name('admin.inventory.edit')->middleware('can:inventory-edit');
        Route::post('/update/{id}', [InventoryController::class, 'update'])->name('admin.inventory.update')->middleware('can:inventory-edit');
        Route::get('/delete/{id}', [InventoryController::class, 'destroy'])->name('admin.inventory.delete')->middleware('can:inventory-delete');
        Route::post('/detail', [InventoryController::class, 'detail'])->name('admin.inventory.detail')->middleware('can:inventory-list');
        Route::get('/search', [InventoryController::class, 'search'])->name('admin.inventory.search')->middleware('can:inventory-list');

    });

    Route::prefix('medias')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('admin.media.index');
    });

    Route::prefix('saleStatistics')->group(function () {
        Route::get('/', [SaleStatisticController::class, 'index'])->name('admin.saleStatistic.index')->middleware('can:saleStatistic-list');
        Route::post('/show', [SaleStatisticController::class, 'show'])->name('admin.saleStatistic.show')->middleware('can:saleStatistic-list');

    });


    Route::prefix('seos')->group(function () {
        Route::get('/create', [SeoController::class, 'create'])->name('admin.seo.create')->middleware('can:seo-add');
        Route::get('/', [SeoController::class, 'index'])->name('admin.seo.index')->middleware('can:seo-list');
        Route::post('/store', [SeoController::class, 'store'])->name('admin.seo.store')->middleware('can:seo-add');
        Route::get('/edit/{id}', [SeoController::class, 'edit'])->name('admin.seo.edit')->middleware('can:seo-edit');
        Route::post('/update/{id}', [SeoController::class, 'update'])->name('admin.seo.update')->middleware('can:seo-edit');
        Route::get('/delete/{id}', [SeoController::class, 'destroy'])->name('admin.seo.delete')->middleware('can:seo-delete');
        Route::post('/detail', [SeoController::class, 'detail'])->name('admin.seo.detail')->middleware('can:seo-list');
        Route::get('/search', [SeoController::class, 'search'])->name('admin.seo.search')->middleware('can:seo-list');

    });

    Route::prefix('ratings')->group(function () {
        Route::get('/create', [RatingController::class, 'create'])->name('admin.rating.create')->middleware('can:rating-add');
        Route::get('/', [RatingController::class, 'index'])->name('admin.rating.index')->middleware('can:rating-list');
        Route::post('/store', [RatingController::class, 'store'])->name('admin.rating.store')->middleware('can:rating-add');
        Route::get('/edit/{id}', [RatingController::class, 'edit'])->name('admin.rating.edit')->middleware('can:rating-edit');
        Route::post('/update/{id}', [RatingController::class, 'update'])->name('admin.rating.update')->middleware('can:rating-edit');
        Route::get('/delete/{id}', [RatingController::class, 'destroy'])->name('admin.rating.delete')->middleware('can:rating-delete');
        Route::post('/detail', [RatingController::class, 'detail'])->name('admin.rating.detail')->middleware('can:rating-list');
        Route::get('/search', [RatingController::class, 'search'])->name('admin.rating.search')->middleware('can:rating-list');

    });

    Route::prefix('flashSales')->group(function () {
        Route::get('/create', [FlashSaleController::class, 'create'])->name('admin.flashSale.create')->middleware('can:flashSale-add');
        Route::get('/', [FlashSaleController::class, 'index'])->name('admin.flashSale.index')->middleware('can:flashSale-list');
        Route::post('/store', [FlashSaleController::class, 'store'])->name('admin.flashSale.store')->middleware('can:flashSale-add');
        Route::get('/edit/{id}', [FlashSaleController::class, 'edit'])->name('admin.flashSale.edit')->middleware('can:flashSale-edit');
        Route::post('/update/{id}', [FlashSaleController::class, 'update'])->name('admin.flashSale.update')->middleware('can:flashSale-edit');
        Route::get('/delete/{id}', [FlashSaleController::class, 'destroy'])->name('admin.flashSale.delete')->middleware('can:flashSale-delete');
        Route::post('/detail', [FlashSaleController::class, 'detail'])->name('admin.flashSale.detail')->middleware('can:flashSale-list');
        Route::get('/search', [FlashSaleController::class, 'search'])->name('admin.flashSale.search')->middleware('can:flashSale-list');

    });

    Route::prefix('infrastructures')->group(function () {
        Route::prefix('cities')->group(function () {
            Route::get('/create', [InfrastructureCityController::class, 'create'])->name('admin.infrastructureCity.create')->middleware('can:infrastructureCity-add');
            Route::get('/', [InfrastructureCityController::class, 'index'])->name('admin.infrastructureCity.index')->middleware('can:infrastructureCity-list');
            Route::post('/store', [InfrastructureCityController::class, 'store'])->name('admin.infrastructureCity.store')->middleware('can:infrastructureCity-add');
            Route::get('/edit/{id}', [InfrastructureCityController::class, 'edit'])->name('admin.infrastructureCity.edit')->middleware('can:infrastructureCity-edit');
            Route::post('/update/{id}', [InfrastructureCityController::class, 'update'])->name('admin.infrastructureCity.update')->middleware('can:infrastructureCity-edit');
            Route::get('/delete/{id}', [InfrastructureCityController::class, 'destroy'])->name('admin.infrastructureCity.delete')->middleware('can:infrastructureCity-delete');
            Route::get('/search', [InfrastructureCityController::class, 'search'])->name('admin.infrastructureCity.search')->middleware('can:infrastructureCity-list');

        });

        Route::prefix('wards')->group(function () {
            Route::get('/create', [InfrastructureWardController::class, 'create'])->name('admin.infrastructureWard.create')->middleware('can:infrastructureWard-add');
            Route::get('/', [InfrastructureWardController::class, 'index'])->name('admin.infrastructureWard.index')->middleware('can:infrastructureWard-list');
            Route::post('/store', [InfrastructureWardController::class, 'store'])->name('admin.infrastructureWard.store')->middleware('can:infrastructureWard-add');
            Route::get('/edit/{id}', [InfrastructureWardController::class, 'edit'])->name('admin.infrastructureWard.edit')->middleware('can:infrastructureWard-edit');
            Route::post('/update/{id}', [InfrastructureWardController::class, 'update'])->name('admin.infrastructureWard.update')->middleware('can:infrastructureWard-edit');
            Route::get('/delete/{id}', [InfrastructureWardController::class, 'destroy'])->name('admin.infrastructureWard.delete')->middleware('can:infrastructureWard-delete');
            Route::get('/search', [InfrastructureWardController::class, 'search'])->name('admin.infrastructureWard.search')->middleware('can:infrastructureWard-list');

        });

        Route::prefix('districts')->group(function () {
            Route::get('/create', [InfrastructureDistrictController::class, 'create'])->name('admin.infrastructureDistrict.create')->middleware('can:infrastructureDistrict-add');
            Route::get('/', [InfrastructureDistrictController::class, 'index'])->name('admin.infrastructureDistrict.index')->middleware('can:infrastructureDistrict-list');
            Route::post('/store', [InfrastructureDistrictController::class, 'store'])->name('admin.infrastructureDistrict.store')->middleware('can:infrastructureDistrict-add');
            Route::get('/edit/{id}', [InfrastructureDistrictController::class, 'edit'])->name('admin.infrastructureDistrict.edit')->middleware('can:infrastructureDistrict-edit');
            Route::post('/update/{id}', [InfrastructureDistrictController::class, 'update'])->name('admin.infrastructureDistrict.update')->middleware('can:infrastructureDistrict-edit');
            Route::get('/delete/{id}', [InfrastructureDistrictController::class, 'destroy'])->name('admin.infrastructureDistrict.delete')->middleware('can:infrastructureDistrict-delete');
            Route::get('/search', [InfrastructureDistrictController::class, 'search'])->name('admin.infrastructureDistrict.search')->middleware('can:infrastructureDistrict-list');

        });
    });
});
