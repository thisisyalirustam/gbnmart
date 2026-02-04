<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            /* =====================
             | PRODUCTS & CATALOG
             ===================== */
            'product.view','product.create','product.update','product.delete',
            'category.view','category.create','category.update','category.delete',
            'subcategory.view','subcategory.create','subcategory.update','subcategory.delete',
            'collection.view','collection.create','collection.update','collection.delete',

            /* =====================
             | ORDERS
             ===================== */
            'order.view','order.update','order.cancel','order.refund',

            /* =====================
             | COUPON & AFFILIATE
             ===================== */
            'coupon.view','coupon.create','coupon.update','coupon.delete',
            'affiliate.view','affiliate.approve',

            /* =====================
             | BLOG
             ===================== */
            'blog.view','blog.create','blog.update','blog.delete',
            'blog.publish','blog.comment.moderate',

            /* =====================
             | WEBSITE / CMS
             ===================== */
            'website.view','website.update',
            'page.create','page.update','page.delete',
            'menu.manage','banner.manage','seo.manage',

            /* =====================
             | USERS & ROLES
             ===================== */
            'user.view','user.create','user.update','user.delete',
            'user.block','user.assign.role',
            'role.manage','permission.manage',

            /* =====================
             | REPORTS
             ===================== */
            'report.view',
            /* =====================
             | Settings
             ===================== */
             'setting.view','setting.update',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /* =====================
         | ROLES
         ===================== */

        // Super Admin
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->syncPermissions(Permission::all());

        // Admin
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions([
            // Catalog
            'product.view','product.create','product.update','product.delete',
            'category.view','category.create','category.update','category.delete',
            'subcategory.view','subcategory.create','subcategory.update','subcategory.delete',
            'collection.view','collection.create','collection.update','collection.delete',

            // Orders
            'order.view','order.update','order.cancel','order.refund',

            // Coupons & Affiliates
            'coupon.view','coupon.create','coupon.update','coupon.delete',
            'affiliate.view','affiliate.approve',

            // Blog
            'blog.view','blog.create','blog.update','blog.publish',

            // CMS
            'website.view','website.update',
            'page.create','page.update',
            'menu.manage','banner.manage','seo.manage',

            // Users
            'user.view','user.create','user.update','user.block',

            // Reports
            'report.view',
             /* =====================
             | Settings
             ===================== */
             'setting.view','setting.update',
        ]);

        // Manager
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $manager->syncPermissions([
            'product.view','product.create','product.update',
            'category.view','subcategory.view','collection.view',
            'order.view','order.update',
            'blog.view',
            'report.view',
        ]);

        // Content Editor (Blog / CMS)
        $editor = Role::firstOrCreate(['name' => 'Content Editor']);
        $editor->syncPermissions([
            'blog.view','blog.create','blog.update','blog.publish',
            'page.create','page.update',
            'menu.manage','banner.manage',
        ]);

        // Affiliate
        $affiliate = Role::firstOrCreate(['name' => 'Affiliate']);
        $affiliate->syncPermissions([
            'coupon.view',
            'affiliate.view',
        ]);

        // Customer Support
        $support = Role::firstOrCreate(['name' => 'Customer Support']);
        $support->syncPermissions([
            'order.view','order.update',
            'user.view',
        ]);

        // Customer
        $customer = Role::firstOrCreate(['name' => 'Customer']);
        $customer->syncPermissions([
            'product.view',
            'blog.view',
        ]);
    }
}
