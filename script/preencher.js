document.getElementById("pu").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    var selectedValue = selectedOption.value;

    if (selectedValue) {
        // Fazer uma requisição AJAX para buscar o nome correspondente ao PU
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("nome").value = this.responseText;
            }
        };

        xhr.open("GET", "../manager/function.php?pu=" + selectedValue, true);
        xhr.send();
    } else {
        document.getElementById("nome").value = "";
    }
});
