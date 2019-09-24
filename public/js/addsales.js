function onInputValidate(item, pattern, errorText) {
    var statetxt = document.getElementById("statetxt"); 
    if (!item.value.match(pattern)) {
        statetxt.style.display = "block";
        statetxt.style.color = "red";
        statetxt.innerHTML = errorText;

    } else {
        statetxt.innerHTML = "";
        statetxt.style.display = "none";
    }
}
function init() {
    var itemID = document.getElementById('itemID');
    var qty = document.getElementById('qty');
    var date = document.getElementById("salesDate");
    var statetxt = document.getElementById("statetxt"); 
    var addSalesForm = document.getElementById("addSalesForm"); 
    
    var idPattern = /^([0-9]){1,10}$/;
    var namePattern = /^[A-Za-z ]{1,40}$/;
    var pricePattern = /^([0-9])+(\.[0-9]{1,2})?$/;
    var qtyPattern = /^[0-9]+$/;

    itemID.oninput = function() {
        onInputValidate(itemID, idPattern, "ID must not be empty and contains only numbers with 10 digits as max");
    }
    qty.oninput = function() {
        onInputValidate(qty, qtyPattern, "Quantity must not be empty and accepts only positive integers");
    } 
    date.onblur = function() {
        if (!date.value) {
            statetxt.innerHTML = "You must specify a date!";
            statetxt.style.color = "red";
            statetxt.style.display = "block";
        } else {
            statetxt.innerHTML = "";
        }       
    }
}
window.onload = init;