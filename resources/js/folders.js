import { getFolders, createFolder as apiCreateFolder, deleteFolder as apiDeleteFolder } from './api/folderApi';

export async function fetchFolders() {
    try {
        const res = await getFolders();
        const items = res.data.data || [];
        renderTree(items);
        populateContainerSelect(items);
    } catch (err) {
        showListError();
    }
}

function buildTree(items) {
    const map = {};
    items.forEach(i => { map[i.id] = { ...i, children: [] }; });
    const roots = [];
    items.forEach(i => {
        if (i.container && map[i.container]) map[i.container].children.push(map[i.id]);
        else roots.push(map[i.id]);
    });
    return roots;
}

function renderTree(items) {
    const roots = buildTree(items);
    const container = document.getElementById('folders-tree');
    container.innerHTML = '';
    if (roots.length === 0) { container.textContent = 'No hay carpetas'; return; }
    const ul = document.createElement('ul');
    ul.className = 'list-group';
    roots.forEach(r => ul.appendChild(renderNode(r)));
    container.appendChild(ul);
}

function renderNode(node) {
    const li = document.createElement('li');
    li.className = 'list-group-item';
    const title = document.createElement('div');
    title.className = 'd-flex justify-content-between align-items-center';
    const text = document.createElement('div');
    text.textContent = `#${node.id} ${node.name} ${node.owner ? '(owner: '+node.owner+')' : '(root)'}`;
    const actions = document.createElement('div');
    actions.innerHTML = `
        <button class="btn btn-sm btn-outline-primary me-2" data-action="edit" data-id="${node.id}">Editar</button>
        <button class="btn btn-sm btn-outline-danger" data-action="delete" data-id="${node.id}">Eliminar</button>
    `;
    title.appendChild(text);
    title.appendChild(actions);
    li.appendChild(title);
    if (node.children && node.children.length) {
        const sub = document.createElement('ul');
        sub.className = 'list-group mt-2';
        node.children.forEach(c => sub.appendChild(renderNode(c)));
        li.appendChild(sub);
    }
    return li;
}

export function populateContainerSelect(items, includeSelfId=null) {
    const roots = buildTree(items);
    const select = document.getElementById('container');
    const editSelect = document.getElementById('edit-container');
    if (!select) return;
    select.innerHTML = '<option value="">-- Ninguno (raíz) --</option>';
    if (editSelect) editSelect.innerHTML = '<option value="">-- Ninguno (raíz) --</option>';
    function addOptions(nodes, depth=0) {
        nodes.forEach(n => {
            if (n.id === includeSelfId) return;
            const opt = document.createElement('option');
            opt.value = n.id;
            opt.textContent = `${'— '.repeat(depth)}${n.name} (id:${n.id})`;
            select.appendChild(opt.cloneNode(true));
            if (editSelect) editSelect.appendChild(opt);
            if (n.children) addOptions(n.children, depth+1);
        });
    }
    addOptions(roots);
}

function showListError() {
    const list = document.getElementById('folders-tree');
    list.innerHTML = '<div class="text-danger p-2">Error cargando carpetas</div>';
}

export async function createFolder(payload) {
    return apiCreateFolder(payload);
}

export async function deleteFolder(id) {
    return apiDeleteFolder(id);
}

export async function updateFolder(id, payload) {
    const module = await import('./api/folderApi');
    return module.updateFolder(id, payload);
}

export function initFolderActions() {
    const tree = document.getElementById('folders-tree');
    if (!tree) return;
    tree.addEventListener('click', async (e) => {
        const btn = e.target.closest('button[data-action]');
        if (!btn) return;
        const action = btn.getAttribute('data-action');
        const id = btn.getAttribute('data-id');
        if (action === 'delete') {
            if (!confirm('Eliminar carpeta #' + id + '?')) return;
            try {
                await deleteFolder(id);
                fetchFolders();
            } catch (err) {
                alert('Error eliminando');
            }
        }
        if (action === 'edit') {
            try {
                const res = await getFolders();
                const item = (res.data.data || []).find(x => String(x.id) === String(id));
                if (!item) return alert('Elemento no encontrado');
                // dispatch custom event for edit modal
                window.dispatchEvent(new CustomEvent('folders:edit', { detail: item }));
            } catch (err) {
                alert('Error al abrir edición');
            }
        }
    });
}

if (typeof window !== 'undefined') {
    window.addEventListener('DOMContentLoaded', () => {
        window.foldersModule = {
            fetchFolders,
            createFolder,
            deleteFolder,
            updateFolder,
            initFolderActions,
            populateContainerSelect,
        };
    });
}
