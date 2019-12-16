<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <link rel="stylesheet" href="<?php echo e(url('css/style.css')); ?>">

    <title>Teste Dinâmica Levi</title>
    <style>
        .hide{
            display: none !important;
        }
    </style>

</head>

<body>
    <div class="loading hide" style="z-index: 9999999;">
      <div class='uil-ring-css' style='transform:scale(0.79);'>
        <div></div>
      </div>
    </div>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
            <div class="container-fluid">
                <a class="navbar-brand js-scroll-trigger" href="index.html">
                    <h2></h2>
                    <!-- <img src="http://www.m2kindia.com/wp-content/uploads/2016/07/dummy-logo.png"> -->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    	<li class="nav-item">
                    		<a class="nav-link" href="#" >
			                   Sessão: <?php echo e($session_id); ?>

		                    </a>                    		
                    	</li>
                        <li class="nav-item dropdown main-menu">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                   Alterar Tema
		                    </a>
                            <ul class="dropdown-menu main-menubox" aria-labelledby="navbarDropdownMenuLink" style="margin-top: -40px !important;">
                                <li>
                                    <a class="dropdown-item" href="#" onclick="changeThemeColor('bg-dark', event)"><i class="fas fa-square-full" style="color: black;"></i> Preto</a>
                                    <a class="dropdown-item" href="#" onclick="changeThemeColor('bg-info', event)"><i class="fas fa-square-full" style="color: blue;"></i> Azul</a>
                                    <a class="dropdown-item" href="#" onclick="changeThemeColor('bg-warning', event)"><i class="fas fa-square-full" style="color: orange;"></i> Laranja</a>
                                    <a class="dropdown-item" href="#" onclick="changeThemeColor('bg-success', event)"><i class="fas fa-square-full" style="color: green;"></i> Verde</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <form class="form-inline">
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="number" class="form-control" id="codeForSearch" placeholder="Digite o código do produto" maxlength="4">
                                </div>
                            </form>
                        </li>
                        <li class="nav-item">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">Ativo Site?</div>
                                </div>
                                <input type="text" class="form-control" id="ativoSite" data-name="Ativo Site" placeholder="" readonly>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <form>
                    <div class="form-row align-items-center">
                        <div class="col-11">
                            <label class="sr-only" for="product">Produto</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">Produto</div>
                                </div>
                                <input type="text" class="form-control" id="product" data-name="Produto" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="radioValidate" value="product">
							  <label class="form-check-label" for="exampleRadios1">
							    Selecionar
							  </label>
							</div>
                        </div>
                        <div class="col-11">
                            <label class="sr-only" for="productDescription">Descrição do Produto</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">Descrição do Produto</div>
                                </div>
                                <input type="text" class="form-control" id="productDescription" data-name="Descrição do Produto" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="radioValidate" value="productDescription">
							  <label class="form-check-label" for="checkProductDescription">
							    Selecionar
							  </label>
							</div>
                        </div>
                        <div class="col-11">
                            <label class="sr-only" for="priceHome">Preço Home</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">Preço Home</div>
                                </div>
                                <input type="text" class="form-control" id="priceHome" data-name="Preço Home" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="radioValidate" value="priceHome">
							  <label class="form-check-label" for="exampleRadios1">
							    Selecionar
							  </label>
							</div>
                        </div>
                        <div class="col-11">
                            <label class="sr-only" for="titleSEO">Título SEO</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">Título SEO</div>
                                </div>
                                <input type="text" class="form-control" id="titleSEO" data-name="Titulo SEO" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="radioValidate" value="titleSEO">
							  <label class="form-check-label" for="exampleRadios1">
							    Selecionar
							  </label>
							</div>
                        </div>
                        <div class="col-11">
                            <label class="sr-only" for="urlSEO">URL SEO</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">URL SEO</div>
                                </div>
                                <input type="text" class="form-control" id="urlSEO" data-name="URL SEO" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="radioValidate" value="urlSEO">
							  <label class="form-check-label" for="exampleRadios1">
							    Selecionar
							  </label>
							</div>
                        </div>
                    </div>
                </form>
                <hr/>
                <div class="row">
                	<div class="col-12 bg-warning">
                		<h3 class="text-center" style="color: white !important;">Validação</h3>
                	</div>
                	<div class="clear-fix"></div>
                </div>
                <div class="row" style="padding-top: 10px;">
                	<div class="col-12">
                		<form>
		                    <div class="form-row align-items-center">
		                        <div class="col-8">
		                            <label class="sr-only" for="inlineFormInputGroup">Campo Selecionado</label>
		                            <div class="input-group mb-2">
		                                <div class="input-group-prepend">
		                                    <div class="input-group-text bg-warning" style="color: #FFF">Campo Selecionado</div>
		                                </div>
		                                <input type="text" class="form-control" id="selectedInput" placeholder="" readonly>
		                            </div>
		                        </div>
		                        <div class="col-4">
		                            <label class="sr-only" for="inlineFormInputGroup">Referência</label>
		                            <div class="input-group mb-2">
		                                <div class="input-group-prepend">
		                                    <div class="input-group-text bg-warning" style="color: #FFF">Referência</div>
		                                </div>
		                                <input type="text" class="form-control" id="referenceInput" placeholder="" readonly>
		                            </div>
		                        </div>
		                        <div class="col-12">
		                            <label class="sr-only" for="inlineFormInputGroup">Informação do Campo</label>
		                            <div class="input-group mb-2">
		                                <div class="input-group-prepend">
		                                    <div class="input-group-text bg-warning" style="color: #FFF">Informação do Campo</div>
		                                </div>
		                                <input type="text" class="form-control" id="infoInput" placeholder="" readonly>
		                            </div>
		                        </div>
		                    </div>
		                </form>
                	</div>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>

    //inputs
    var productDescription = $("#productDescription");
    var product = $("#product");
    var priceHome = $("#priceHome");
    var titleSEO = $("#titleSEO");
    var urlSEO = $("#urlSEO");
    var codeForSearch = $("#codeForSearch");
    var ativoSite = $("#ativoSite");
    var loading = $(".loading");

    //inputs validations
    var selectedInput = $("#selectedInput");
    var referenceInput = $("#referenceInput");
    var infoInput = $("#infoInput");

    //checks
    var checkProductDescription = $("#checkProductDescription");

    //object
    var productReference = '';

    //validate if exists default theme in memory
    checkTheme();

    $('input[type=radio][name=radioValidate]').change(function() {
        
        let input = $(this);
        let input_id = $("#" + input.val());
        let input_val = input_id.val();
        let input_name = input_id.data('name');
        
        if(input_id.val() === '')
            return showBasicAlert('Ooops...', 'Campo em branco 😓 Voce deve selecionar um campo preenchido!');

        setValidation(input_name, productReference, input_val);
    });

    codeForSearch.keyup(function(e){
        e.preventDefault();
        
        var inputLenght = $(this).val().length;
        var keyPressed = e.which;

        if(isArrowPressed(keyPressed)) {
            let normalizedVal = parseInt(normalizeInput($(this).val()));
            $(this).val(normalizedVal);
        }
        if(inputLenght == 4)
            getProduct();    
    });

    var getProduct = function() {
        $.ajax({
            url: "<?php echo e(url('/api/product/get?product_id=')); ?>" +codeForSearch.val(),
            type: "GET",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                loading.removeClass('hide');
            },
            success: function (data) {
                productDescription.val(data.rows[0][10] !== null ?  data.rows[0][10] : '');
                priceHome.val("R$ " + data.rows[0][16] !== null ? data.rows[0][16].toFixed(2) : '');
                titleSEO.val(data.rows[0][4]);
                urlSEO.val(data.rows[0][6]);
                product.val(data.rows[0][1]);
                ativoSite.val(isActive(data.rows[0][12]));

                //store if necessary to access later
                productReference = data.rows[0][3]
            },
            error: function (data) {
                loading.addClass('hide');
            },
            complete: function(){
                loading.addClass('hide');
            }
        });
    }

    //populate validate products
    function setValidation(selectedInputVal, referenceInputVal, infoInputVal) {
        selectedInput.val(selectedInputVal);
        referenceInput.val(referenceInputVal);
        infoInput.val(infoInputVal);
    }

    //change the, if is default or not
    function changeThemeColor(theme, e) {
        
        //get active theme stored in local storage
        let acitveTheme = localStorage.getItem("acitveTheme");

        if(e)
            e.preventDefault();

        //validate if user stored any theme or apply default theme
        if(acitveTheme == null) {
            $(".bg-warning").removeClass("bg-warning").addClass("bg-warning");
            localStorage.setItem("acitveTheme", "bg-warning");
        } else {
            $("." + acitveTheme).removeClass(acitveTheme).addClass(theme);
            localStorage.setItem("acitveTheme", theme);
        }        
    }

    //function to validate if isset the selected by user
    function checkTheme() {

        //get active theme stored in local storage
        let acitveTheme = localStorage.getItem("acitveTheme");

        //validate if user stored any theme or apply default theme
        if(acitveTheme == null)
            //define default theme
            changeThemeColor();
        else {
            $(".bg-warning").removeClass("bg-warning").addClass(acitveTheme);
            changeThemeColor(acitveTheme);
        }
    }

    //funciton to show default alert dialog
    function showBasicAlert(title, message, type) {
        Swal.fire(
            title,
            message,
            type
        )
    }

    //funciton to check product is active in site AD_ATIVO
    function isActive(status) {
        switch (status) {
            case "S":
                return "Sim"
                break;
            case "N":
                return "Não"
                break;        
            default:
                return status
                break;
        }
    }

    //function to check if arrows is pressed
    //38 is up arrow and 40 is down arrow
    function isArrowPressed(input) {
        if(input === 38 || input === 40)
            return true
        return false
    }

    //function to add zero value in input search
    // called only if arrows pressed
    function normalizeInput(val) {
        let lengthStr = val.length;
        switch (lengthStr) {
            case 1:
                return '000' + val
                break;
            case 2:
                return '00' + val
                break;
            case 3:
                return '0' + val
                break;
            case 4:
                return val
                break;
            default:
                val
                break;
        }
    }

</script>
</body>

</html><?php /**PATH /var/www/mudah-framework/App/View/index.blade.php ENDPATH**/ ?>