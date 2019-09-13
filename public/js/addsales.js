
function init() {
    var itemID = document.getElementById('ItemId');
    var itemName = document.getElementById('ItemName');
    var price = document.getElementById("Price");
    var qty = document.getElementById("Quantity");
    var date = document.getElementById("Date");
    var statetxt = document.getElementById("statetxt");
    var addSalesForm = document.getElementById("addSalesForm");
    
    
    var idPattern = /^[a-zA-Z]+$/;
    var namePattern = /^[A-Za-z ]+/;
    var numberPattern = /^[0-9]+]/;
    itemName.onkeypress = function() {  
        if (!itemName.value.match(namePattern)) {
            statetxt.innerHTML = "Item name can contain only letters and whitespaces!";
            statetxt.style.color = "red";
            statetxt.style.display = "block";
        } else {
            statetxt.innerHTML = "";
        }

    }
    itemID.onkeypress = function() {
        if (!itemID.value.match(idPattern)) {
            statetxt.innerHTML = "Item id can contain only letters!";
            statetxt.style.color = "red";
            statetxt.style.display = "block";
        } else {
            statetxt.innerHTML = "";
        }
    }
    price.onkeypress = function() {
        if (!price.value.match(numberPattern)) {
            statetxt.innerHTML = "Price can only has numerical value!";
            statetxt.style.color = "red";
            statetxt.style.display = "block";
        } else {
            statetxt.innerHTML = "";
        }
    }
    qty.onselect = function() {
        if (!qty.value.onkeypress(numberPattern)) {
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