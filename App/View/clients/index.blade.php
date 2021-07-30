@extends('static.internal.base')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Clientes</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3 float-right">
                <div class="col-12">
                    <a href="{{ url('clients/add') }}" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                        <span class="text">Adicionar Cliente</span>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data de Nascimento</th>
                        <th>CPF</th>
                        <th>Rg</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Data de Nascimento</th>
                        <th>CPF</th>
                        <th>Rg</th>
                        <th>Ações</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client['name'] ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($client['birthday'])->format('d/m/Y') }}</td>
                            <td>{{ $client['cpf'] }}</td>
                            <td>{{ $client['document_number'] ?? '' }}</td>
                            <td>
                                <a href="{{ url('clients/edit/' . $client['id']) }}" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-edit"></i>
                                        </span>
                                    <span class="text">Editar Cliente</span>
                                </a>
                                <a href="" id="delete-client" data-id="{{ $client['id'] }}" class="btn btn-danger btn-icon-split delete-client">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    <span class="text">Excluir Cliente</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".delete-client").click(function (e) {
            e.preventDefault();

            let clientId = $(this).data("id");

            return $.ajax({
                url: "{{ url('/api/clients/delete') }}",
                type: "POST",
                dataType: "json",
                data: {
                    id: clientId,
                    action: 'delete'
                },
                success: function (data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Cliente deletado com sucesso!',
                            confirmButtonText: `OK`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ url('/clients') }}';
                            }
                        })
                    }
                },
                error: function (data) {
                    console.error(data);
                },
            });
        });
    </script>
@endsection