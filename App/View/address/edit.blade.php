@extends('static.internal.base')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Editar Endereço</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Adiconar um Endereço
            </h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Cliente</label>
                        <select class="form-control" id="client_id">
                            <option value="0">Selecione um cliente</option>
                            @foreach($clients as $client)
                                <option value="{{ $client['id'] }}">{{ $client['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Endereço</label>
                        <input type="text" class="form-control" id="address" placeholder="R. aleatória N° 312" value="{{ $address['address'] }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">CEP</label>
                        <input type="text" class="form-control" id="postal_code" placeholder="12200-000" value="{{ $address['postal_code'] }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Cidade</label>
                        <input type="text" class="form-control" id="city" placeholder="São Paulo" value="{{ $address['city'] }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Estado</label>
                        <input type="text" class="form-control" id="state" maxlength="2" placeholder="SP" value="{{ $address['state'] }}">
                    </div>
                    <input type="hidden" id="id" value="{{ $address['id'] }}" />
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <a href="#" id="btn-save-address" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-house-user"></i>
                                        </span>
                            <span class="text">Atualizar Endereço</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#postal_code").mask('99999-999');
        $("#state").mask('AA');


        $("#btn-save-address").click(function (e) {
            e.preventDefault();

            if (validateInputs()) {
                let id = $("#id").val();
                let client_id = $("#client_id").val();
                let address = $("#address").val();
                let postal_code = $("#postal_code").val();
                let city = $("#city").val();
                let state = $("#state").val();

                return $.ajax({
                    url: "{{ url('/api/address/edit') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                        client_id: client_id,
                        address: address,
                        postal_code: postal_code,
                        city: city,
                        state: state
                    },
                    success: function (data) {
                        if (data.success) {
                            Swal.fire({
                                title: 'Endereço atualizado com sucesso!',
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
            }
        });

        var validateInputs = function() {
            if ($("#client_id").val() == '0') {
                return Swal.fire('Por favor selecione um cliente');
            }

            if ($("#address").val() == '') {
                return Swal.fire('Por favor informe o endereço');
            }

            if ($("#postal_code").val() == '') {
                return Swal.fire('Por favor informe o CEP');
            }

            if ($("#city").val() == '') {
                return Swal.fire('Por favor informe a cidade');
            }

            if ($("#state").val() == '') {
                return Swal.fire('Por favor informe o estado');
            }

            return true;
        }
    </script>
@endsection