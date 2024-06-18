function updateproduct(id) {

    var pid = id;

    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");
    var condition;

    if (document.getElementById("bn").checked) {
        condition = document.getElementById("bn").value;
    } else if (document.getElementById("us").checked) {
        condition = document.getElementById("us").value;
    }

    var colour;

    if (document.getElementById("clr1").checked) {
        var colour = document.getElementById("clr1").value;
    } else if (document.getElementById("clr2").checked) {
        var colour = document.getElementById("clr2").value;
    } else if (document.getElementById("clr3").checked) {
        var colour = document.getElementById("clr3").value;
    } else if (document.getElementById("clr4").checked) {
        var colour = document.getElementById("clr4").value;
    } else if (document.getElementById("clr5").checked) {
        var colour = document.getElementById("clr5").value;
    } else if (document.getElementById("clr6").checked) {
        var colour = document.getElementById("clr6").value;
    }

    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delivery_cost_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imguploader");

    var form = new FormData();
    form.append("id", pid);
    form.append("c", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("co", condition);
    form.append("col", colour);
    form.append("qty", qty.value);
    form.append("p", price.value);
    form.append("dwc", delivery_cost_within_colombo.value);
    form.append("doc", delivery_outof_colombo.value);
    form.append("desc", description.value);
    form.append("img", image.files[0]);

    var r1 = new XMLHttpRequest();
    r1.onreadystatechange = function() {
        if (r1.readyState == 4) {
            var text1 = r1.responseText;
            alert(text1);
            window.location = "updateProduct.php";
        }
    }

    r1.open("POST", "updateProductProces.php", true);
    r1.send(form);
}

function changeImage() {
    var image = document.getElementById("imguploader"); //file chooser
    var view = document.getElementById("prev"); //image tag

    image.onchange = function() {
        var file = this.files[0]; //image eka thiyana file path eka
        var url = window.URL.createObjectURL(file); //file location eka tempary url ekak lesa sakasima

        view.src = url; //img tag eke src ekata url eka laba dima
    }
}