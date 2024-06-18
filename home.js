function goToAddProduct() {
    window.location = "addProduct.php";
}

function signout() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "home.php";
            }

        }
    };

    r.open("GET", "signout.php", true);
    r.send();

}

function basicSearch(x) {
    var page = x;
    var searchText = document.getElementById("basic_search_text").value;
    var searchSelect = document.getElementById("basic_search_category").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "empty") {
                window.location = "home.php";
            } else {
                document.getElementById("product_view_div").innerHTML = t;
            }
        }
    }

    r.open("GET", "basicSearchProccess.php?t=" + searchText + "&s=" + searchSelect + "&p=" + page, true);
    r.send();
}

function addToWatchList(id) {

    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + pid, true);
    r.send();

}

function deleteformwatchlist(id) {
    var wid = id;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "success") {
                window.location = "watchlist.php";
            }
        }
    }

    request.open("GET", "removeWatchlistItemProccess.php?id=" + wid, true);
    request.send();

}

function gotoCart() {
    window.location = "cart.php";
}

function addToCart(id) {
    var qtytxt = document.getElementById("qtytxt" + id).value;
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            window.location = "cart.php";
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + pid + "&txt=" + qtytxt, true);
    r.send();

}


function deleteformcart(id) {

    var cid = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            }
            alert(t);
        }
    }
    r.open("GET", "deleteFormCartPrcess.php?id=" + cid, true);
    r.send();
}

// detailsmodel

function detailsmodel(id) {
    alert(id);
}

//feedback 

function addFeedback(id) {

    var feedmodel = document.getElementById("feedbackModal" + id);
    k = new bootstrap.Modal(feedmodel);
    k.show();

}

//save feedback

function saveFeedback(id) {
    var pid = id;
    var feedtxt = document.getElementById("feedtxt").value;

    var f = new FormData();
    f.append("i", pid);
    f.append("ft", feedtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                k.hide();
            }
        }
    }

    r.open("POST", "savefeedbackProccess.php", true);
    r.send(f);
}

function advanceSearch() {

    var viewResults = document.getElementById("viewResults");
    var keyword = document.getElementById("k").value;
    var category = document.getElementById("c").value;
    var brand = document.getElementById("b").value;
    var model = document.getElementById("m").value;
    var condition = document.getElementById("con").value;
    var color = document.getElementById("clr").value;
    var pricefrom = document.getElementById("pf").value;
    var priceto = document.getElementById("pt").value;

    var f = new FormData();
    f.append("k", keyword);
    f.append("c", category);
    f.append("b", brand);
    f.append("m", model);
    f.append("con", condition);
    f.append("clr", color);
    f.append("pf", pricefrom);
    f.append("pt", priceto);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == 2) {
                alert("You must enter a keyword to search...");
            } else {
                viewResults.innerHTML = t;
            }
        }
    }

    r.open("POST", "advancesearchProccess.php", true);
    r.send(f);


}