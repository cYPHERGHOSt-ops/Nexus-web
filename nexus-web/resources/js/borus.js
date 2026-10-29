// Intercepta formulários do Borus e atualiza a view sem recarregar toda a página.
// Usa os endpoints JSON que já existem nos controllers de atividades e transações.
document.addEventListener('submit', async (event) => {
    const form = event.target.closest('form[data-borus-form]');
    if (!form) return;

    event.preventDefault();
    const button = form.querySelector('[type="submit"]');
    if (button) button.disabled = true;

    const alert = document.getElementById('borus-form-error');
    if (alert) alert.remove();

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: new FormData(form),
        });

        if (!response.ok) {
            const data = await response.json().catch(() => ({}));
            const detail = data.errors ? Object.values(data.errors).flat().join(' ') : data.message;
            throw new Error(detail || `Erro HTTP ${response.status}`);
        }

        // Navegação interna do Livewire: substitui só a página e busca os dados atualizados.
        if (window.Livewire?.navigate) {
            window.Livewire.navigate(window.location.href);
        } else {
            window.location.reload();
        }
    } catch (error) {
        const message = document.createElement('p');
        message.id = 'borus-form-error';
        message.className = 'borus-alert mt-2';
        message.textContent = `Não foi possível salvar: ${error.message}`;
        form.appendChild(message);
        if (button) button.disabled = false;
    }
});
