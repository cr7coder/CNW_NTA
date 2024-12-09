<?php include 'header.php'; ?>
<?php include 'products.php'; ?>
<main>
<h2>Danh Sách Sản Phẩm</h2>
<?php if (empty($products)): ?>
<p>Không có sản phẩm nào.</p>
<?php else: ?>
<ul>
<?php foreach ($products as $product): ?>
<li><?= htmlspecialchars($product['name']) ?>:
<?= htmlspecialchars($product['price']) ?> VND</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</main>
<?php include 'footer.php'; ?>