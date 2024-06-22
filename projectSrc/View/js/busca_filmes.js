
document.addEventListener("DOMContentLoaded", function() {
    fetch('buscar_filmes.php')
    .then(response => response.json())
    .then(data => {
        let carouselInner = document.querySelector('.carousel-inner');
        let moviesScroller = document.querySelectorAll('.movies-scroller');

        // Limpar os placeholders
        carouselInner.innerHTML = '';
        moviesScroller.forEach(scroller => scroller.innerHTML = '');

        data.forEach((movie, index) => {
            // Adicionar os itens no carrossel
            if(index < 3) {
                let activeClass = index === 0 ? 'active' : '';
                carouselInner.innerHTML += `
                    <div class="carousel-item ${activeClass}">
                        <div class="slideOne">
                            <img src="${movie.image_url}" class="d-block w-100" alt="${movie.title}">
                            <div class="infos">
                                <h1 class="movieName">${movie.title}</h1>
                                <p class="movieText">${movie.description}</p>
                                <button class="animated-button" onclick="window.location.href='detalhamento.html'">
                                    <span class="text">SAIBA MAIS</span>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Adicionar os itens nas seções de filmes
            moviesScroller.forEach(scroller => {
                scroller.innerHTML += `
                    <div class="moviebox">
                        <img src="${movie.image_url}" class="miniImg" onerror="this.src='images/not_found.png';" />
                        <h1 class="movieMiniName">${movie.title}</h1>
                        <p class="movieGenre">${movie.genre}</p>
                    </div>
                `;
            });
        });
    });
});

