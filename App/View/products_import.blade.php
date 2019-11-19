@extends('layout.base')
@section('css')
<style>
    .loading{
        width: 60px;
        height: 60px;
    }
    .hide{ display: none; }
</style>
@endsection
@section('content')
<!-- Main Content -->
<main class="content">
    <div class="header-list-page">
        <h1 class="title">Import System</h1>
    </div>
    <form>
      <div class="input-field">
        <label for="category-name" class="label">Select a <b>.csv</b> File to Import</label>
        <input type="file" id="file" class="input-text" />
        <span class="btn-action" id="button_import">Import</span>
        <label class="label"><img src="{{ url('/images/loading.gif') }}" id="loading" class="loading hide" /></label>
      </div>
    </form>
</main>
<!-- Main Content -->
@endsection
@section('javascript')
<script>

    var progress_bar = $("#loading");

	$("#button_import").click(function() {

        let fileType = ".csv";
        let regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        let file = $("#file").prop('files')[0];
        let form_data = new FormData();

        form_data.append('csv', file);

        if (!regex.test($("#file").val().toLowerCase())) {
            alert('Invalid File. Upload online ' + fileType + ' file');
            return;
        }

        $.ajax({
            url: "{{ url('/products/import') }}",
            type: "POST",
            dataType: "json",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(this).html('Importing');
                progress_bar.removeClass('hide');
            },
            success: function(data){
                if(data.status == "success"){
                    console.log(data);
                    $(this).html('Import');
                    progress_bar.addClass('hide');
                    alert('Products imported successfully!');
                }
            },
            error: function (data) {
                console.log(data);
                progress_bar.addClass('hide');
                alert('Error to import!');
            },
            complete: function(){
                progress_bar.addClass('hide');
            }
        });
    });
</script>
@endsection