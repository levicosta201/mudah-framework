@extends('static.internal.base')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Endereços</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-3 float-right">
                <div class="col-12">
                    <a href="{{ url('address/add') }}" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                        <span class="text">Adicionar Endereço</span>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Endereço</th>
                        <th>CEP</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Cliente</th>
                        <th>Endereço</th>
                        <th>CEP</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($address as $address)
                        <tr>
                            <td>{{ $address['client_name'] ?? '' }}</td>
                            <td>{{ $address['address'] ?? '' }}</td>
                            <td>{{ $address['postal_code'] ?? '' }}</td>
                            <td>{{ $address['city'] ?? '' }}</td>
                            <td>{{ $address['state'] ?? '' }}</td>
                            <td>
                                <a href="{{ url('address/edit/' . $address['id']) }}" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-edit"></i>
                                        </span>
                                    <span class="text">Editar Endereço</span>
                                </a>
                                <a href="" id="delete-address" data-id="{{ $address['address_id'] }}" class="btn btn-danger btn-icon-split delete-address">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    <span class="text">Excluir Endereço</span>
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
        $(".delete-address").click(function (e) {
            e.preventDefault();

            let addressId = $(this).data("id");
            console.log(addressId);

            return $.ajax({
                url: "{{ url('/api/address/delete') }}",
                type: "POST",
                dataType: "json",
                data: {
                    id: addressId,
                    action: 'delete'
                },
                success: function (data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Endereço deletado com sucesso!',
                            confirmButtonText: `OK`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
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