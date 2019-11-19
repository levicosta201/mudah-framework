@extends('layout.base')
@section('css')
<link  rel="stylesheet" type="text/css"  media="all" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
@endsection
@section('content')
<!-- Main Content -->
<main class="content">
    <div class="header-list-page">
        <h1 class="title">Categories</h1>
        <span class="btn-action" id="button_open">Add new Category</span>
    </div>
    <table id="table_categories">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories_data as $categories)
            <tr>
                <td class="center-text-table">{{ $categories['id'] }}</td>
                <td class="center-text-table">{{ $categories['code'] }}</td>
                <td class="center-text-table">{{ $categories['name'] }}</td>
                <td class="center-text-table"><i class="fas fa-edit" onClick="editCategory({{ $categories['id'] }})"></i> | <i class="fas fa-trash" onClick="deleteCategory({{ $categories['id'] }})"></i></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
<div id="addCategory" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="openCategoryModal('#addCategory', 'close')">&times;</a>
    <div class="container">
        <form>
            <h1>Add New Category</h1>
            <div class="form-group">
                <input type="number" id="category_code" required="required" />
                <label for="input" class="control-label">Category code</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="category_name" required="required" />
                <label for="input" class="control-label">Category name</label><i class="bar"></i>
            </div>
            <div class="button-container">
                <button type="button" id="submitForm" class="button"><span>Submit</span></button>
            </div>
        </form>
    </div>
</div>

<div id="editCategory" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="openCategoryModal('#editCategory', 'close')">&times;</a>
    <div class="container">
        <form>
            <h1>Edit Category</h1>
            <div class="form-group">
                <input type="number" id="category_code_update" required="required" />
                <label for="input" class="control-label">Category code</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input type="text" id="category_name_update" required="required" />
                <label for="input" class="control-label">Category name</label><i class="bar"></i>
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

    $('#table_categories').DataTable({
        "order": [[0, "asc" ]]
    });

    button_open.click(function() {
        openCategoryModal('#addCategory', 'open');
    });

    button_close.click(function() {
        openCategoryModal('#addCategory', 'close');
    });

    btn_submit.click(function(e){
        e.preventDefault();
        
        let category_code = $("#category_code").val();
        let category_name = $("#category_name").val();

        $.ajax({
            url: "{{ url('/category/add') }}",
            type: "POST",
            dataType: "json",
            data: {category_code:category_code, category_name:category_name},
            success: function(data){
                if(data.status == "success"){
                    console.log(data);
                    let news_html ="<tr>"
                                + "<td class='center-text-table' >"+ data.data.id +"</td>"
                                + "<td class='center-text-table'>"+ data.data.code +"</td>"
                                + "<td class='center-text-table'>"+ data.data.name +"</td>"
                                + "<td class='center-text-table'><i class='fas fa-edit' onClick='editCategory("+ data.data.id +")'></i> | <i class='fas fa-trash' onClick='deleteCategory("+ data.data.id +")'></i></td>"
                            + "</tr>";
                    $("#table_categories tbody").append(news_html);
                    openCategoryModal('#addCategory', 'close');
                }
            }
        })
    });

    btn_submit_update.click(function(e){
        let category_code_update = $("#category_code_update").val();
        let category_name_update = $("#category_name_update").val();
        let update_id = $("#update_id").val();

        $.ajax({
            url: "{{ url('/category/update') }}",
            type: "POST",
            dataType: "json",
            data: {update_id:update_id, category_code_update:category_code_update, category_name_update:category_name_update},
            success: function(data){
                if(data.status == "success"){
                    openCategoryModal('#editCategory', 'close');
                    location.reload();
                }
            }
        });

    });

    var openCategoryModal = function(modal, action) {
        if (action == 'open')
            $(modal).css('height', '100%');
        else
            $(modal).css('height', '0px');
    };

    var deleteCategory = function(id) {
        $.ajax({
            url: "{{ url('/category/delete') }}",
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

    var editCategory = function(id) {

        let category_code_update = $("#category_code_update");
        let category_name_update = $("#category_name_update");
        let update_id = $("#update_id");

        $.ajax({
            url: "{{ url('/category/get') }}",
            type: "GET",
            dataType: "json",
            data: {id:id},
            success: function(data){
                if(data.status == "success"){
                    category_code_update.val(data.data.code);
                    category_name_update.val(data.data.name);
                    update_id.val(data.data.id);
                    openCategoryModal('#editCategory', 'open');
                }
            }
        });
    }
</script>
@endsection