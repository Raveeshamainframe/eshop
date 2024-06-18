function changeStatus(id) {

    var productId = id;
    var statuscheck = document.getElementById("check");
    var statuslable = document.getElementById("checklable" + productId);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactive") {
                statuslable.innerHTML = "Make Your Product Deactivate";
                window.location = "sellproductview.php";
            } else if (t == "active") {
                statuslable.innerHTML = "Make Your Product Activate";
                window.location = "sellproductview.php";
            }
        }
    };

    r.open("GET", "statusChangeProcess.php?p=" + productId, true);
    r.send()

}

function sendid(id) {

    var id = id;

    var requset = new XMLHttpRequest();
    requset.onreadystatechange = function() {
        if (requset.readyState == 4) {
            var t = requset.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            }
        }
    };
    requset.open("GET", "sendproductprocess.php?id=" + id, true);
    requset.send();
}

function deleteModel(id) {
    var dm = document.getElementById("deleteModel" + id);
    k = new bootstrap.Modal(dm)
    k.show();
}

function deleteproduct(id) {

    var productid = id;

    var requset = new XMLHttpRequest();
    requset.onreadystatechange = function() {
        if (requset.readyState == 4) {
            var t = requset.responseText;
            if (t == "sucsess") {
                k.hide();
            }

        }
    }
    requset.open("GET", "deleteproductprocess.php?id=" + productid, true);
    requset.send();
}

// filters

function addFilters(x) {
    var page = x;
    var search = document.getElementById("s");
    // var filter = document.getElementById("filterdiv");

    var age;

    if (document.getElementById("n").checked) {
        age = 1;
    } else if (document.getElementById("o").checked) {
        age = 2;
    } else {
        age = 0;
    }

    var qty;

    if (document.getElementById("l").checked) {
        qty = 1;
    } else if (document.getElementById("h").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var condition;

    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    } else {
        condition = 0;
    }

    var form = new FormData();
    form.append("page", page);
    form.append("s", search.value);
    form.append("a", age);
    form.append("q", qty);
    form.append("c", condition);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productview").innerHTML = t;

        }
    }
    r.open("POST", "filterProcess.php", true);
    r.send(form);
}

function clearFilters() {
    window.location = "myProduct.php";
}