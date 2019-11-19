@extends('layout.base')
@section('css')
<link  rel="stylesheet" type="text/css"  media="all" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
@endsection
@section('content')
<!-- Main Content -->
<main class="content">
    <div class="header-list-page">
        <h1 class="title">Logs</h1>
    </div>
    <table id="table_logs">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs_data as $log)
            <tr>
                <td class="center-text-table">{{ $log['id'] }}</td>
                <td class="center-text-table">{{ $log['user_id'] }}</td>
                <td class="center-text-table">{{ $log['action'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection
@section('javascript')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $('#table_logs').DataTable({
        "order": [[0, "desc" ]]
    });
</script>
@endsection