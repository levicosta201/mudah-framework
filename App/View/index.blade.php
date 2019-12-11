<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <link rel="stylesheet" href="{{ url('css/style.css') }}">

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
			                   Sessão: {{ $session_id }}
		                    </a>                    		
                    	</li>
                        <li class="nav-item dropdown main-menu">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                   Alterar Tema
		                    </a>
                            <ul class="dropdown-menu main-menubox" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="#"><i class="fas fa-square-full" style="color: black;"></i> Preto</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-square-full" style="color: blue;"></i> Azul</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-square-full" style="color: orange;"></i> Laranja</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-square-full" style="color: green;"></i> Verde</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <form class="form-inline">
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2" class="sr-only">Password</label>
                                    <input type="password" class="form-control" id="inputPassword2" placeholder="Digite o código do produto" maxlength="4">
                                </div>
                                <button type="submit" class="btn btn-warning mb-2">Buscar <i class="fas fa-search"></i></button>
                            </form>
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
                            <label class="sr-only" for="inlineFormInputGroup">Descrição Produto</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">Descrição Produto</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
							  <label class="form-check-label" for="exampleRadios1">
							    Selecionar
							  </label>
							</div>
                        </div>
                        <div class="col-11">
                            <label class="sr-only" for="inlineFormInputGroup">Preço Home</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">Preço Home</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
							  <label class="form-check-label" for="exampleRadios1">
							    Selecionar
							  </label>
							</div>
                        </div>
                        <div class="col-11">
                            <label class="sr-only" for="inlineFormInputGroup">Título SEO</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">Título SEO</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
							  <label class="form-check-label" for="exampleRadios1">
							    Selecionar
							  </label>
							</div>
                        </div>
                        <div class="col-11">
                            <label class="sr-only" for="inlineFormInputGroup">URL SEO</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">URL SEO</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
							  <label class="form-check-label" for="exampleRadios1">
							    Selecionar
							  </label>
							</div>
                        </div>        
                        <div class="col-11">
                            <label class="sr-only" for="inlineFormInputGroup">Produto</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-warning" style="color: #FFF">Produto</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-check">
							  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
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
		                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" readonly>
		                            </div>
		                        </div>
		                        <div class="col-4">
		                            <label class="sr-only" for="inlineFormInputGroup">Referência</label>
		                            <div class="input-group mb-2">
		                                <div class="input-group-prepend">
		                                    <div class="input-group-text bg-warning" style="color: #FFF">Referência</div>
		                                </div>
		                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" readonly>
		                            </div>
		                        </div>
		                        <div class="col-12">
		                            <label class="sr-only" for="inlineFormInputGroup">Informação do Campo</label>
		                            <div class="input-group mb-2">
		                                <div class="input-group-prepend">
		                                    <div class="input-group-text bg-warning" style="color: #FFF">Informação do Campo</div>
		                                </div>
		                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" readonly>
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
</body>

</html>