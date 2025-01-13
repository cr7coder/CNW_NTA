<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
          crossorigin="anonymous">
    <title>Quản lý sản phẩm</title>
</head>
<body>

<h1 style="margin: 50px 50px">Thêm sản phẩm mới</h1>

<form action="{{ route('products.store') }}" method="POST" style="margin: 50px 50px">
    @csrf
    <div class="mb-3">
        <label for="store_id" class="form-label">Cửa hàng</label>
        <select class="form-control" id="store_id" name="store_id" required>
            <option value="">Chọn cửa hàng</option>
            @foreach($stores as $store)
                <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                    {{ $store->name }}
                </option>
            @endforeach
        </select>
        @error('store_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" min="0.01" step="0.01" required>
        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
</form>

</body>
</html>
