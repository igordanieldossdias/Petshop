document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const faqItem = question.parentElement;
        const isOpen = faqItem.classList.contains('open');

        // Fecha todas as perguntas
        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('open');
        });

        // Abre a pergunta clicada, se não estiver aberta
        if (!isOpen) {
            faqItem.classList.add('open');
        }
    });
});
