@extends('layout.base')
@section('css')
<link  rel="stylesheet" type="text/css"  media="all" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
@endsection
@section('content')
<!-- Main Content -->
<main class="content">
    <div class="header-list-page">
        <h1 class="title">Dashboard</h1>
    </div>
    <div class="infor">
        <p>You have {{ count($products_data) }} products added on this store:</p>
        <p><span class="btn-action" id="button_open">Add new Product</span></p>
    </div>
    <table id="table_products">
        <thead>
            <tr>
                <th>Code</th>
                <th>Quantity</th>
                <th>Name</th>
                <th>Categories</th>
                <th>Price</th>
                <th>Image</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products_data as $product)
            <tr id="{{ $product['id'] }}">
                <td class="center-text-table">{{ $product['code'] }}</td>
                <td class="center-text-table">{{ $product['quantity'] }} available</td>
                <td class="center-text-table">{{ $product['name'] }}</td>
                <td class="center-text-table">{{ $product['category'] }}</td>
                <td class="center-text-table">R$ {{ moneyToReal($product['price']) }}</td>
                <td class="center-text-table"><img src="{{ $product['img'] }}" layout="responsive" width="164" height="145" alt="Tênis Runner Bolt" /></td>
                <td class="center-text-table">{{ $product['description'] }}</td>
                <td class="center-text-table"><i class="fas fa-edit" onClick="editProduct({{ $product['id'] }})"></i> | <i class="fas fa-trash" onClick="deleteProduct({{ $product['id'] }})"></i></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
<div id="addProduct" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="openProductModal('#editProduct', 'close')">&times;</a>
    <div class="container">
        <form>
            <h1>Add New Product</h1>
            <div class="form-group">
                <input id="product_code" required="required" />
                <label for="input" class="control-label">Product code</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="product_name" required="required" />
                <label for="input" class="control-label">Product name</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="product_price" required="required" />
                <label for="input" class="control-label">Product price</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="product_quantity" required="required" />
                <label for="input" class="control-label">Product quantity</label><i class="bar"></i>
            </div>
            <div class="form-group">
              <select  multiple="multiple" size="{{ @count($categories_data) }}" id="product_categories" style="height: auto;">
                @foreach($categories_data as $categorie)
                <option value="{{ $categorie['id'] }}">{{ $categorie['name'] }}</option>
                @endforeach
              </select>
              <label for="select" class="control-label">Select Multiple Product</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="product_description" required="required" />
                <label for="input" class="control-label">Product description</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="file" id="product_image" />
                <label for="input" class="control-label">Product image</label><i class="bar"></i>
            </div>
            <div class="button-container">
                <button type="button" id="submitForm" class="button"><span>Submit</span></button>
            </div>
        </form>
    </div>
</div>
<div id="editProduct" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="openProductModal('#editProduct', 'close')">&times;</a>
    <div class="container">
        <form>
            <h1>Add New Product</h1>
            <div class="form-group">
                <input id="product_code_update" required="required" />
                <label for="input" class="control-label">Product code</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="product_name_update" required="required" />
                <label for="input" class="control-label">Product name</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="product_price_update" required="required" />
                <label for="input" class="control-label">Product price</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="product_quantity_update" required="required" />
                <label for="input" class="control-label">Product quantity</label><i class="bar"></i>
            </div>
            <div class="form-group">
              <select  multiple="multiple" size="{{ @count($categories_data) }}" id="product_categories_update" style="height: auto;">
                @foreach($categories_data as $categorie)
                <option value="{{ $categorie['id'] }}">{{ $categorie['name'] }}</option>
                @endforeach
              </select>
              <label for="select" class="control-label">Select Multiple Product</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="product_description_update" required="required" />
                <label for="input" class="control-label">Product description</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="file" id="product_image_update" />
                <label for="input" class="control-label">Product image</label><i class="bar"></i>
            </div>
            <div class="button-container">
                <button type="button" id="submitFormUpdate" class="button"><span>Update</span></button>
            </div>
            <input type="hidden" id="update_id">
        </form>
    </div>
</div>
<!-- Main Content -->
@endsection
@section('javascript')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    var button_open = $("#button_open");
    var button_close = $("#button_close");
    var btn_submit = $("#submitForm");
    var btn_submit_update = $("#submitFormUpdate");

    $('#table_products').DataTable();

    button_open.click(function() {
        openProductModal('#addProduct', 'open');
    });

    button_close.click(function() {
        openProductModal('#addProduct', 'close');
    });

    btn_submit.click(function(e){
        e.preventDefault();

        let product_image = $('#product_image').prop('files')[0];
        let product_code = $("#product_code").val();
        let product_name = $("#product_name").val();
        let product_price = $("#product_price").val();
        let product_quantity = $("#product_quantity").val();
        let product_categories = $("#product_categories").val();
        let product_description = $("#product_description").val();
        let form_data = new FormData();

        form_data.append('product_code', product_code);
        form_data.append('product_name', product_name);        
        form_data.append('product_price', product_price);
        form_data.append('product_quantity', product_quantity);
        form_data.append('product_categories', product_categories);
        form_data.append('product_description', product_description);        
        form_data.append('product_image', product_image);

        $.ajax({
            url: "{{ url('/product/add') }}",
            type: "POST",
            dataType: "json",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                if(data.status == "success"){
                    console.log(data);
                    let products_html ="<tr>"
                                + "<td class='center-text-table' >"+ data.data.code +"</td>"
                                + "<td class='center-text-table'>"+ data.data.quantity +"</td>"
                                + "<td class='center-text-table'>"+ data.data.name +"</td>"
                                + "<td class='center-text-table'>"+ data.data.category +"</td>"
                                + "<td class='center-text-table'>"+ data.data.price +"</td>"
                                + "<td class='center-text-table'><img src='"+ data.data.img +"' layout='responsive' width='164' height='145' /></td>"
                                + "<td class='center-text-table'>"+ data.data.description +"</td>"
                                + "<td class='center-text-table'><i class='fas fa-edit' onClick='editProduct("+ data.data.id +")'></i> | <i class='fas fa-trash' onClick='deleteProduct("+ data.data.id +")'></i></td>"
                            + "</tr>";
                    $("#table_products tbody").append(products_html);
                    openProductModal('#addProduct', 'close');
                }
            }
        });
    });

    btn_submit_update.click(function(e){
        e.preventDefault();

        let product_image_update = $('#product_image_update').prop('files')[0];
        let product_code_update = $("#product_code_update").val();
        let product_name_update = $("#product_name_update").val();
        let product_price_update = $("#product_price_update").val();
        let product_quantity_update = $("#product_quantity_update").val();
        let product_categories_update = $("#product_categories_update").val();
        let product_description_update = $("#product_description_update").val();
        let update_id = $("#update_id").val();
        let form_data = new FormData();

        form_data.append('product_code', product_code_update);
        form_data.append('product_name', product_name_update);        
        form_data.append('product_price', product_price_update);
        form_data.append('product_quantity', product_quantity_update);
        form_data.append('product_categories', product_categories_update);
        form_data.append('product_description', product_description_update);
        form_data.append('product_image', product_image_update);
        form_data.append('update_id', update_id);

        $.ajax({
            url: "{{ url('/product/update') }}",
            type: "POST",
            dataType: "json",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                if(data.status == "success"){
                    openProductModal('#editProduct', 'close');
                    location.reload();
                }
            }
        });

    });

    var openProductModal = function(modal, action) {
        if (action == 'open')
            $(modal).css('height', '100%');
        else
            $(modal).css('height', '0px');
    };

    var editProduct = function(id) {

        let product_image_update = $('#product_image_update');
        let product_code_update = $("#product_code_update");
        let product_name_update = $("#product_name_update");
        let product_price_update = $("#product_price_update");
        let product_quantity_update = $("#product_quantity_update");
        let product_categories_update = $("#product_categories_update");
        let product_description_update = $("#product_description_update");
        let update_id = $("#update_id");
        let form_data = new FormData();

        form_data.append('product_code_update', product_code_update);
        form_data.append('product_name_update', product_name_update);
        form_data.append('product_price_update', product_price_update);
        form_data.append('product_quantity_update', product_quantity_update);
        form_data.append('product_categories_update', product_categories_update);
        form_data.append('product_description_update', product_description_update);
        form_data.append('product_image_update', product_image_update);
        form_data.append('update_id', update_id);
        

        $.ajax({
            url: "{{ url('/product/get') }}",
            type: "GET",
            dataType: "json",
            data: {id:id},
            success: function(data){
                if(data.status == "success"){
                    product_image_update.attr('src', data.data.img);
                    product_code_update.val(data.data.code);
                    product_name_update.val(data.data.name);
                    product_price_update.val(data.data.price);
                    product_quantity_update.val(data.data.quantity);
                    product_categories_update.val(data.data.categories);
                    product_description_update.val(data.data.description);
                    update_id.val(data.data.id);
                    openProductModal('#editProduct', 'open');
                }
            }
        });
    };

    var deleteProduct = function(id) {
        $.ajax({
            url: "{{ url('/product/delete') }}",
            type: "POST",
            dataType: "json",
            data: {id:id},
            success: function(data){
                if(data.status == "success"){
                    location.reload();
                }
            }
        })
    }; 
</script>
@endsection

