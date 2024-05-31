// Seleciona a div alvo pelo ID
const targetDiv = document.getElementById('#p2');

// Cria um novo IntersectionObserver
const observer = new IntersectionObserver((entries, observer) => {
  // Itera sobre as entradas observadas
  entries.forEach(entry => {
    // Verifica se a entrada está intersectando a viewport
    if (entry.isIntersecting) {
      // Mostra a div quando ela entra na viewport
      showDiv(entry.target);
      // Para de observar a div depois que ela é exibida
      observer.unobserve(entry.target);
    }
  });
}, {
  root: null, // Observa em relação ao documento
  threshold: 0 // Executa a callback quando qualquer parte do elemento entra na viewport
});

// Função para mostrar a div
function showDiv(target) {
  target.style.display = 'block'; // Torna a div visível
}

// Inicia a observação da div alvo
observer.observe(targetDiv);
