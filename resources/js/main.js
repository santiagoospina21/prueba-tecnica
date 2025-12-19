import { fetchFolders, createFolder, initFolderActions } from './folders';
import './editModal';
import { clearValidationErrors, showValidationErrors, showFeedback, clearFeedback } from './utils/ui';


window.addEventListener('DOMContentLoaded', () => {
    (async function init() {
        await fetchFolders();
        initFolderActions();
        attachFormHandler();
    })();

    function getFormPayload() {
        const payload = {
            name: document.getElementById('name').value || undefined,
            container: document.getElementById('container').value || undefined,
        };
        const ownerVal = document.getElementById('owner').value;
        if (ownerVal !== '') payload.owner = Number(ownerVal);
        return payload;
    }

    function attachFormHandler() {
        const form = document.getElementById('folder-form');
        if (!form) return;
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            clearValidationErrors(['name','owner','container']);
            clearFeedback();
            const payload = getFormPayload();
            try {
                const res = await createFolder(payload);
                if (res.status === 201) {
                    showFeedback('Carpeta creada', 'success');
                    form.reset();
                    await fetchFolders();
                }
            } catch (err) {
                if (err.response && err.response.status === 422) {
                    console.log(err.response.data.errors);
                    showValidationErrors(err.response.data.errors || {});
                    return;
                }
                showFeedback('Error: ' + (err.message || 'Error'), 'danger');
            }
        });
    }
});
