<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Đường dẫn hiển thị danh sách đồ án (trang chủ)

Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Đường dẫn để tạo mới một đồ án (hiển thị form thêm mới)
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Đường dẫn để lưu dữ liệu đồ án mới (thực hiện thêm mới)
Route::post('/issues', [ProductController::class, 'store'])->name('products.store');

// Đường dẫn để hiển thị chi tiết một đồ án cụ thể (tuỳ chọn)
Route::get('/issues/{id}', [ProductController::class, 'show'])->name('products.show');

// Đường dẫn để chỉnh sửa thông tin đồ án (hiển thị form chỉnh sửa)
Route::get('/issues/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Đường dẫn để cập nhật thông tin đồ án (thực hiện cập nhật)
Route::put('/issues/{id}', [ProductController::class, 'update'])->name('products.update');

// Đường dẫn để xóa đồ án (thực hiện xóa sau khi có modal xác nhận)
Route::delete('/issues/{id}', [ProductController::class, 'destroy'])->name('products.destroy');