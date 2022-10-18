var URL_BASE = param;

function pay(){
    document.getElementById("form-checkout-shipment").submit(); 
}

function openAndClose(selection) {
    if(selection == 'pixSelection'){
        let pixDiv = document.getElementById("pixDiv");
        let pixContent = document.getElementById("pixContent");
        pixDiv.style.cssText ='background:#F4F6F8;border-color:#333;';
        pixContent.style.cssText ='display:block!important;';
    } else {

    }
}
$( "#quantityHTML" ).change(function() {
    updateCart($('#quantityHTML').val())
  });
  function addQtd() {
    updateCart((parseFloat(quantityHTML.value)+1));
}
function addMais10() {
    updateCart((parseFloat(quantityHTML.value)+10));
}
function updateCart(number){
    var qtd = (number == 0) ? 1 : parseFloat(number);
    quantityHTML.value = number;
    $('#quantityHTML').val(number);
    const minhaUrl = URL_BASE+"/sections/carrinho.php?adicionar="+qtd;
    
    var subtx =  valor_produto*qtd;
    var subt =  parseFloat(subtx);
    var desctx = subt*parseFloat('0.05');
    var desct =  desctx.toFixed(2);
    var desctmod =  parseFloat(desctx.toFixed(2)).toLocaleString('pt-BR', {
        currency: 'BRL',
        minimumFractionDigits: 2
      });
    var subtotalx = parseFloat(subt);
    var subtotal =  parseFloat(subtotalx.toFixed(2)).toLocaleString('pt-BR', {
        currency: 'BRL',
        minimumFractionDigits: 2
      });
    resumoQtd.innerHTML = "("+qtd+")"
    valorTotal.innerHTML = "R$ "+subtotal
    valorTotal2.innerHTML = "R$ "+subtotal
    valorTotal3.innerHTML = "R$ "+subtotal
    valorTotal4.innerHTML = "R$ "+subtotal
    descontodivvalue.innerHTML = "- R$ "+desctmod
    descontodivvalue2.innerHTML = "- R$ "+desctmod
    $('#totalnopix').html(parseFloat((subtotalx-desct).toFixed(2)).toLocaleString('pt-BR', {
      currency: 'BRL',
      minimumFractionDigits: 2
    }));
  $('#valorTotal5').html(parseFloat((subtotalx-desct).toFixed(2)).toLocaleString('pt-BR', {
      currency: 'BRL',
      minimumFractionDigits: 2
    }));
      $.get( minhaUrl, function( data ) {});
}

function removeQtd() {

    updateCart(parseFloat(quantityHTML.value)-1)
}
