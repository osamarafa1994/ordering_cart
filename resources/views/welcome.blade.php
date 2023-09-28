<!-- resources/views/cart.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Product Grid</title>
</head>
<body>
<div class="container">
    <h2>Products list</h2>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">${{ $product->price }}</p>
                        <a class="btn btn-primary btn-block" href="{{ route('add.to.cart', ['productId' => $product->id]) }}">Add to Cart</a>
                    </div>
                </div>
            </div>

        @endforeach
        <a class="btn btn-success" href="{{ route('view.store') }}">Generate Invoice</a>

        <!-- Add more product cards as needed -->
    </div>
</div>

<!-- Bootstrap JavaScript and jQuery (for optional features) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
