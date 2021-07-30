@extends('static.internal.base')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Editar Cliente</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Editar Cliente
            </h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Nome</label>
                        <input type="email" class="form-control" id="name" name="name" placeholder="Nome" value="{{ $client['name'] }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Data de Nascimento</label>
                        <input type="date" class="form-control" id="birthday" placeholder="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" value="{{ $client['birthday'] }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">CPF</label>
                        <input type="text" class="form-control" id="cpf" placeholder="000.000.000-00" value="{{ $client['cpf'] }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">RG</label>
                        <input type="text" class="form-control" id="document_number" placeholder="RG" value="{{ $client['document_number'] }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Telefone</label>
                        <input type="phone" class="form-control" id="phone" maxlength="11" placeholder="(11) 99999-9999" value="{{ $client['phone'] }}">
                    </div>
                    <input type="hidden" name="id" id="id" value="{{ $client['id'] }}"/>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <a href="#" id="btn-save-client" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-edit"></i>
                                        </span>
                            <span class="text">Atualizar Cliente</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
                        <th>Endereço</th>
                        <th>CEP</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
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
        $("#phone").mask('(99) 99999-9999');
        $("#cpf").mask('999.999.999-99');

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
                                window.location.href = '{{ url('/address') }}';
                            }
                        })
                    }
                },
                error: function (data) {
                    console.error(data);
                },
            });
        });

        $("#btn-save-client").click(function (e) {
            e.preventDefault();

            if (validateInputs()) {
                let name = $("#name").val();
                let birthday = $("#birthday").val();
                let cpf = $("#cpf").val();
                let document_number = $("#document_number").val();
                let phone = $("#phone").val();
                let id = $("#id").val();

                return $.ajax({
                    url: "{{ url('/api/clients/edit') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                        name: name,
                        birthday: birthday,
                        cpf: cpf,
                        document_number: document_number,
                        phone: phone
                    },
                    success: function (data) {
                        if (data.success) {
                            return Swal.fire({
                                title: 'Cliente editado com sucesso!',
                                confirmButtonText: `OK`,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '{{ url('/clients') }}';
                                }
                            })
                        } else {
                            return Swal.fire(
                                'Oooops...',
                                data.data
                            )
                        }
                    },
                    error: function (data) {
                        console.error(data);
                    },
                });
            }
        });

        var validateInputs = function() {
            if ($("#name").val() == '') {
                return Swal.fire('Por favor informe o nome do cliente');
            }

            if ($("#birthday").val() == '') {
                return Swal.fire('Por favor informe a data de nascimento do cliente');
            }

            if ($("#cpf").val() == '') {
                return Swal.fire('Por favor informe o CPF do cliente');
            }

            if ($("#document_number").val() == '') {
                return Swal.fire('Por favor informe o CPF do cliente');
            }

            if ($("#phone").val() == '') {
                return Swal.fire('Por favor informe o telefone do cliente');
            }

            return true;
        }
    </script>
@endsection