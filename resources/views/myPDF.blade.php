<html>
<head>
    <title>Ed Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body><br><br><br>
    <h1 class="text-center">{{ $title }}</h1><br><br><br><br><br><br><br>

    <p>Liste de commandes:</p>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nom de produit</th>
            <th>Image</th>
            <th>description</th>
            <th>prix</th>
        </tr>
        @foreach($products as $products)
        <tr>
            <td>{{ $products->id }}</td>
            <td>{{ $products->name }}</td>
            <td>{{ $products->image }}</td>
            <td>{{ $products->description }}</td>
            <td>{{ $products->prix }}DH</td>
        </tr>
        @endforeach

    </table>
    <p class="flex justify-end">{{ $date }}</p>

</body>
</html>
