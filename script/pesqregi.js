var search = document.getElementById('pesquisar')

// Evento para quando clicar "Enter" tambem fazer a pesquisa
search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") 
    {
        searchdata();
    }
});

function searchdata()
{
    window.location = 'registros.php?search='+search.value;
}