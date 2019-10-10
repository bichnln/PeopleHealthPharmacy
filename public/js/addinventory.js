function onInputValidate(item, pattern, errorText) {
    var statetxt = document.getElementById("statetext"); 
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
    var itemName = document.getElementById('itemName');
    var price = document.getElementById('itemPrice');
    var qty = document.getElementById('itemStock');
    var statetxt = document.getElementById("statetext"); 
    var addInventoryForm = document.getElementById("addInventoryForm"); 
    
    var namePattern = /^[A-Za-z ]{1,40}$/;
    var pricePattern = /^([0-9])+(\.[0-9]{1,2})?$/;
    var qtyPattern = /^[0-9]+$/;

    itemName.oninput = function() {
        onInputValidate(itemName, namePattern,  "Item Name must not be empty and contains only letters and spaces");
    }
    price.oninput = function () {
        onInputValidate(price, pricePattern, "Price must not be empty and accepts only decimal numbers");
    }
    qty.oninput = function() {
        onInputValidate(qty, qtyPattern, "Quantity must not be empty and accepts only positive integers");
    } 
}
window.onload = init;