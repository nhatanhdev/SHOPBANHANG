<?php

namespace App\Services;
use Illuminate\Support\Facades\Gate;
class PermissionGateAndPolicy{
    public function SetGateAndPolicy(){

        $this->defineGateCategory();
        $this->defineGateProduct();
        $this->defineGateUser();
        $this->defineGateRole();
        $this->defineGatePermission();
        $this->defineGateSetting();
        $this->defineGateSlider();
        $this->defineGateAttribute();
        $this->defineGateOrder();
        $this->defineGateOrderStatus();
        $this->defineGatePayment();
        $this->defineGateVoucher();
        $this->defineGateInfrastructureCity();
        $this->defineGateInfrastructureDistrict();
        $this->defineGateInfrastructureWard();
        $this->defineGateSaleStatistic();
        $this->defineGateInventory();
        $this->defineGateMedia();
        $this->defineGateSeo();
        $this->defineGateRating();
        $this->defineGateFlashSale();
    }

     /// policy category
     public function defineGateCategory(){
        Gate::define('category-list','App\Policies\CategoryPolicy@view');
        Gate::define('category-add','App\Policies\CategoryPolicy@create');
        Gate::define('category-edit','App\Policies\CategoryPolicy@update');
        Gate::define('category-delete','App\Policies\CategoryPolicy@delete');
    }

    /// product roles
    public function defineGateProduct(){
        Gate::define('product-add','App\Policies\ProductPolicy@create');
        Gate::define('product-edit','App\Policies\ProductPolicy@update');
        Gate::define('product-delete','App\Policies\ProductPolicy@delete');
        Gate::define('product-list','App\Policies\ProductPolicy@view');
    }


    /// user roles
    public function defineGateUser(){
        Gate::define('user-add','App\Policies\UserPolicy@create');
        Gate::define('user-edit','App\Policies\UserPolicy@update');
        Gate::define('user-delete','App\Policies\UserPolicy@delete');
        Gate::define('user-list','App\Policies\UserPolicy@view');
    }


    /// role roles
    public function defineGateRole(){
        Gate::define('role-add','App\Policies\RolePolicy@create');
        Gate::define('role-edit','App\Policies\RolePolicy@update');
        Gate::define('role-delete','App\Policies\RolePolicy@delete');
        Gate::define('role-list','App\Policies\RolePolicy@view');
    }

    /// permission roles
    public function defineGatePermission(){
        Gate::define('permission-add','App\Policies\PermissionPolicy@create');
        Gate::define('permission-edit','App\Policies\PermissionPolicy@update');
        Gate::define('permission-delete','App\Policies\PermissionPolicy@delete');
        Gate::define('permission-list','App\Policies\PermissionPolicy@view');
    }

    public function defineGateSetting(){
        Gate::define('setting-add','App\Policies\SettingPolicy@create');
        Gate::define('setting-edit','App\Policies\SettingPolicy@update');
        Gate::define('setting-delete','App\Policies\SettingPolicy@delete');
        Gate::define('setting-list','App\Policies\SettingPolicy@view');
    }

    public function defineGateSlider(){
        Gate::define('slider-add','App\Policies\SliderPolicy@create');
        Gate::define('slider-edit','App\Policies\SliderPolicy@update');
        Gate::define('slider-delete','App\Policies\SliderPolicy@delete');
        Gate::define('slider-list','App\Policies\SliderPolicy@view');
    }

    public function defineGateAttribute(){
        Gate::define('attribute-add','App\Policies\AttributePolicy@create');
        Gate::define('attribute-edit','App\Policies\AttributePolicy@update');
        Gate::define('attribute-delete','App\Policies\AttributePolicy@delete');
        Gate::define('attribute-list','App\Policies\AttributePolicy@view');
    }
    public function defineGateOrder(){
        Gate::define('order-list','App\Policies\OrderPolicy@view');
        Gate::define('order-delete','App\Policies\OrderPolicy@delete');
        Gate::define('order-edit','App\Policies\OrderPolicy@update');
        Gate::define('order-add','App\Policies\OrderPolicy@create');
    }

    public function defineGateOrderStatus(){
        Gate::define('orderStatus-list','App\Policies\OrderStatusPolicy@view');
        Gate::define('orderStatus-delete','App\Policies\OrderStatusPolicy@delete');
        Gate::define('orderStatus-edit','App\Policies\OrderStatusPolicy@update');
        Gate::define('orderStatus-add','App\Policies\OrderStatusPolicy@create');
    }

    public function defineGatePayment(){
        Gate::define('payment-list','App\Policies\PaymentPolicy@view');
        Gate::define('payment-delete','App\Policies\PaymentPolicy@delete');
        Gate::define('payment-edit','App\Policies\PaymentPolicy@update');
        Gate::define('payment-add','App\Policies\PaymentPolicy@create');
    }

    public function defineGateVoucher(){
        Gate::define('voucher-list','App\Policies\VoucherPolicy@view');
        Gate::define('voucher-delete','App\Policies\VoucherPolicy@delete');
        Gate::define('voucher-edit','App\Policies\VoucherPolicy@update');
        Gate::define('voucher-add','App\Policies\VoucherPolicy@create');
    }

    public function defineGateInfrastructureCity(){
        Gate::define('infrastructureCity-list','App\Policies\InfrastructureCityPolicy@view');
        Gate::define('infrastructureCity-delete','App\Policies\InfrastructureCityPolicy@delete');
        Gate::define('infrastructureCity-edit','App\Policies\InfrastructureCityPolicy@update');
        Gate::define('infrastructureCity-add','App\Policies\InfrastructureCityPolicy@create');
    }

    public function defineGateInfrastructureDistrict(){
        Gate::define('infrastructureDistrict-list','App\Policies\InfrastructureDistrictPolicy@view');
        Gate::define('infrastructureDistrict-delete','App\Policies\InfrastructureDistrictPolicy@delete');
        Gate::define('infrastructureDistrict-edit','App\Policies\InfrastructureDistrictPolicy@update');
        Gate::define('infrastructureDistrict-add','App\Policies\InfrastructureDistrictPolicy@create');
    }

    public function defineGateInfrastructureWard(){
        Gate::define('infrastructureWard-list','App\Policies\InfrastructureWardPolicy@view');
        Gate::define('infrastructureWard-delete','App\Policies\InfrastructureWardPolicy@delete');
        Gate::define('infrastructureWard-edit','App\Policies\InfrastructureWardPolicy@update');
        Gate::define('infrastructureWard-add','App\Policies\InfrastructureWardPolicy@create');
    }



    // Policy for saleStatistics
    public function defineGateSaleStatistic()
    {
        Gate::define('saleStatistic-list', 'App\Policies\SaleStatisticPolicy@view');
        Gate::define('saleStatistic-add', 'App\Policies\SaleStatisticPolicy@create');
        Gate::define('saleStatistic-edit', 'App\Policies\SaleStatisticPolicy@update');
        Gate::define('saleStatistic-delete', 'App\Policies\SaleStatisticPolicy@delete');
    }


    // Policy for inventory
    public function defineGateInventory()
    {
        Gate::define('inventory-list', 'App\Policies\InventoryPolicy@view');
        Gate::define('inventory-add', 'App\Policies\InventoryPolicy@create');
        Gate::define('inventory-edit', 'App\Policies\InventoryPolicy@update');
        Gate::define('inventory-delete', 'App\Policies\InventoryPolicy@delete');
    }


    public function defineGateMedia(){
        Gate::define('media-add','App\Policies\MediaPolicy@create');
        Gate::define('media-edit','App\Policies\MediaPolicy@update');
        Gate::define('media-delete','App\Policies\MediaPolicy@delete');
        Gate::define('media-list','App\Policies\MediaPolicy@view');
    }


    // Policy for seo
    public function defineGateSeo()
    {
        Gate::define('seo-list', 'App\Policies\SeoPolicy@view');
        Gate::define('seo-add', 'App\Policies\SeoPolicy@create');
        Gate::define('seo-edit', 'App\Policies\SeoPolicy@update');
        Gate::define('seo-delete', 'App\Policies\SeoPolicy@delete');
    }


    // Policy for rating
    public function defineGateRating()
    {
        Gate::define('rating-list', 'App\Policies\RatingPolicy@view');
        Gate::define('rating-add', 'App\Policies\RatingPolicy@create');
        Gate::define('rating-edit', 'App\Policies\RatingPolicy@update');
        Gate::define('rating-delete', 'App\Policies\RatingPolicy@delete');
    }


    // Policy for flashSale
    public function defineGateFlashSale()
    {
        Gate::define('flashSale-list', 'App\Policies\FlashSalePolicy@view');
        Gate::define('flashSale-add', 'App\Policies\FlashSalePolicy@create');
        Gate::define('flashSale-edit', 'App\Policies\FlashSalePolicy@update');
        Gate::define('flashSale-delete', 'App\Policies\FlashSalePolicy@delete');
    }
}

