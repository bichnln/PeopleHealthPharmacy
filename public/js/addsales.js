function onInputValidate(value, pattern, errorText) {
    var statetxt = document.getElementById("statetxt"); 
    if (!value.match(pattern)) {
        statetxt.style.display = "block";
        statetxt.style.color = "red";
        statetxt.innerHTML = errorText;

    } else {
        statetxt.innerHTML = "";
        statetxt.style.display = "none";
    }
}
function init() {
    var itemID = document.getElementById('ItemId');
    var itemName = document.getElementById('ItemName');
    var price = document.getElementById('Price');
    var qty = document.getElementById('Quantity');
    var date = document.getElementById("Date");
    var statetxt = document.getElementById("statetxt"); 
    var addSalesForm = document.getElementById("addSalesForm"); 
    
    var idPattern = /^([0-9]){1,11}$/;
    var namePattern = /^[A-Za-z ]+$/;
    var pricePattern = /^([0-9])+(\.[0-9]{0,2})?$/;
    var qtyPattern = /^[0-9]+$/;

    itemID.oninput = onInputValidate(itemID.value, idPattern, "ID must not be empty and contains only numbers with 11 digits as max");

    itemName.oninput = onInputValidate(itemName.value, namePattern,  "Item Name must not be empty and contains only letters and spaces");
    
    price.oninput = onInputValidate(price.value, pricePattern, "Price must not be empty and accepts only decimal numbers");

    qty.oninput = onInputValidate(qty.value, qtyPattern, "Quantity must not be empty and accepts only positive integers");
    qty.onkeypress = function() {
        if (!qty.value.match(qtyPattern
    )) {
            statetxt.innerHTML = "Quantity can only has numerical value!";
            statetxt.style.color = "red";
            statetxt.style.display = "block";
        } else {
            statetxt.innerHTML = "";
        }
    }
    date.onfocus = function() {
        if (!date.value == "dd/mm/yy") {
            statetxt.innerHTML = "You must specify a date!";
            statetxt.style.color = "red";
            statetxt.style.display = "block";
        } else {
            statetxt.innerHTML = "";
        }       
    }
}
window.onload = init;