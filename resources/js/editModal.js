import { populateContainerSelect, fetchFolders } from './folders';
import { getFolders, updateFolder as apiUpdateFolder } from './api/folderApi';
import { clearValidationErrors, showValidationErrors, showFeedback, clearFeedback } from './utils/ui';

export function openEditModal(item) {
    if (!document.getElementById('editModal')) {
        const html = `
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"><h5 class="modal-title">Editar carpeta</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
              <div class="modal-body">
                <form id="edit-form">
                  <input type="hidden" id="edit-id">
                  <div class="mb-3"><label class="form-label">Nombre</label><input id="edit-name" class="form-control" required></div>
                  <div class="mb-3"><label class="form-label">Owner (opcional)</label><input id="edit-owner" class="form-control" type="number"></div>
                  <div class="mb-3"><label class="form-label">Contenedor</label><select id="edit-container" class="form-select"></select></div>
                  <div class="d-flex justify-content-end"><button class="btn btn-primary" type="submit">Guardar</button></div>
                </form>
              </div>
            </div>
          </div>
        </div>`;
        document.body.insertAdjacentHTML('beforeend', html);
        attachEditHandler();
    }
    document.getElementById('edit-id').value = item.id;
    document.getElementById('edit-name').value = item.name;
    document.getElementById('edit-owner').value = item.owner || '';

    getFolders().then(r => {
      const items = r.data.data || [];
      populateContainerSelect(items, item.id);
      document.getElementById('edit-container').value = item.container || '';
      const modalEl = document.getElementById('editModal');
      const modal = new bootstrap.Modal(modalEl);
      modal.show();
    });
}

function attachEditHandler() {
    document.body.addEventListener('submit', async (e) => {
      if (e.target && e.target.id === 'edit-form') {
        e.preventDefault();
        clearValidationErrors(['edit-name','edit-owner','edit-container']);
        clearFeedback();
        const id = document.getElementById('edit-id').value;
        const name = document.getElementById('edit-name').value;
        const owner = document.getElementById('edit-owner').value;
        const containerValue = document.getElementById('edit-container').value;
        const payload = { name };
        if (owner !== '') payload.owner = Number(owner);
        if (containerValue !== '') payload.container = Number(containerValue);
        try {
          await apiUpdateFolder(id, payload);
          const modalEl = document.getElementById('editModal');
          const modal = bootstrap.Modal.getInstance(modalEl);
          modal.hide();
          // Ensure any leftover backdrop or modal-open class is removed
          document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
          document.body.classList.remove('modal-open');
          await fetchFolders();
        } catch (err) {
          if (err.response && err.response.status === 422) {
            showValidationErrors(err.response.data.errors || {});
            return;
          }
          showFeedback('Error actualizando', 'danger');
        }
      }
    });
}


if (typeof window !== 'undefined') {
  window.addEventListener('folders:edit', (e) => {
    const item = e.detail;
    if (item) openEditModal(item);
  });
}
