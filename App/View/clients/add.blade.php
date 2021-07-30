@extends('static.internal.base')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Adicionar Clientes</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Adiconar um Cliente
            </h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Nome</label>
                        <input type="email" class="form-control" id="name" name="name" placeholder="Nome">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Data de Nascimento</label>
                        <input type="date" class="form-control" id="birthday" placeholder="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">CPF</label>
                        <input type="text" class="form-control" id="cpf" placeholder="000.000.000-00">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">RG</label>
                        <input type="text" class="form-control" id="document_number" placeholder="RG">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Telefone</label>
                        <input type="phone" class="form-control" id="phone" maxlength="11" placeholder="(11) 99999-9999">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <a href="#" id="btn-save-client" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                            <span class="text">Salvar Cliente</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#phone").mask('(99) 99999-9999');
        $("#cpf").mask('999.999.999-99');

        $("#btn-save-client").click(function (e) {
            e.preventDefault();

            if (validateInputs()) {
                let name = $("#name").val();
                let birthday = $("#birthday").val();
                let cpf = $("#cpf").val();
                let document_number = $("#document_number").val();
                let phone = $("#phone").val();

                return $.ajax({
                    url: "{{ url('/api/clients/add') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        name: name,
                        birthday: birthday,
                        cpf: cpf,
                        document_number: document_number,
                        phone: phone
                    },
                    success: function (data) {
                        if (data.success) {
                            Swal.fire({
                                title: 'Cliente salvo com sucesso!',
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