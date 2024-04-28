document.addEventListener("DOMContentLoaded", function() {
    // URL da API de onde os dados serão obtidos
    const apiUrl = "URL_DA_API_AQUI";

    // Função para buscar os dados da API
    function fetchData() {
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then(data => {
                // Atualiza os slides do carousel com os dados recebidos da API
                updateCarousel(data);
            })
            .catch(error => {
                console.error("There was a problem fetching the data:", error);
            });
    }

    // Função para atualizar os slides do carousel com os dados recebidos da API
    function updateCarousel(data) {
        const carouselItems = document.querySelectorAll(".carousel-item");
        const carouselCaptions = document.querySelectorAll(".carousel-content");

        // Itera sobre os slides e atualiza as imagens e textos com os dados da API
        carouselItems.forEach((item, index) => {
            item.style.backgroundImage = `url(${data[index].image})`;
            carouselCaptions[index].querySelector("h2").textContent = data[index].title;
            carouselCaptions[index].querySelector("p").textContent = data[index].description;
        });
    }

    // Chama a função para buscar os dados da API ao carregar a página
    fetchData();
});
