<h1>Product List</h1>

<table border="1">
    <tr>
        <td>ID</td>
        <td>Product</td>
        <td>Price</td>
        <td>Description</td>
        <td>Photo</td>
        <td>Delete</td>
        <td>Edit</td>
    </tr>

    @foreach ($products as $product)
    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->title}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->description}}</td>
        <td>{{$product->photo}}</td>
        <td><a href="{{'delete/'.$product->id}}">Delete</a></td>
        <td><a href="{{'edit/'.$product->id}}">Edit</a></td>
    </tr>
    @endforeach

</table>
