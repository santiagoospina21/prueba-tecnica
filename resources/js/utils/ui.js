export function clearValidationErrors(fields = []) {
    fields.forEach(k => {
        const el = document.getElementById(k);
        if (el) el.classList && el.classList.remove('is-invalid');
        const errEl = document.getElementById('error-' + k);
        if (errEl) errEl.textContent = '';
    });
}

export function showValidationErrors(errors = {}) {
    Object.keys(errors).forEach(k => {
        const el = document.getElementById(k);
        if (el) el.classList.add('is-invalid');
        const errEl = document.getElementById('error-' + k);
        if (errEl) errEl.textContent = errors[k].join(' ');
    });
}

export function showFeedback(message, type = 'info') {
    const container = document.getElementById('form-feedback');
    if (!container) return;
    const cls = type === 'success' ? 'alert-success' : (type === 'danger' ? 'alert-danger' : 'alert-info');
    container.innerHTML = `<div class="alert ${cls}">${message}</div>`;
}

export function clearFeedback() {
    const container = document.getElementById('form-feedback');
    if (container) container.textContent = '';
}
