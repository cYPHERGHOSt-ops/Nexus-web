
document.addEventListener('submit', async (event) => {
    const form = event.target.closest('form[data-borus-form]');

    // Por enquanto, apenas formulários da Rotina
   if (!form || !form.closest('.rotina, .financas')) return;

    event.preventDefault();

    if (form.dataset.loading === 'true') return;

    const botao = form.querySelector('button[type="submit"]');

    form.dataset.loading = 'true';
    if (botao) botao.disabled = true;

    try {
        const resposta = await fetch(form.action, {
            method: form.method,
            body: new FormData(form),
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const dados = await resposta.json().catch(() => ({}));

        if (!resposta.ok) {
            const erros = Object.values(dados.errors || {}).flat();

            throw new Error(
                erros[0] || dados.message || 'Erro ao salvar atividade.'
            );
        }

        // Atualiza a Rotina sem recarregar o navegador inteiro
        if (window.Livewire?.navigate) {
            window.Livewire.navigate(window.location.pathname);
        } else {
            window.location.reload();
        }

    } catch (erro) {
        alert(erro.message);
    } finally {
        form.dataset.loading = 'false';
        if (botao) botao.disabled = false;
    }
});
