import axios from 'axios';

const apiBase = '/api/folder';
const API_KEY = import.meta.env.VITE_API_KEY || '';

axios.defaults.headers.common['X-API-KEY'] = API_KEY;

export async function getFolders() {
    return axios.get(apiBase, { headers: { Accept: 'application/json' } });
}

export async function getFolder(id) {
    return axios.get(`${apiBase}/${id}`, { headers: { Accept: 'application/json' } });
}

export async function createFolder(payload) {
    return axios.post(apiBase, payload, { headers: { 'Accept': 'application/json' } });
}

export async function updateFolder(id, payload) {
    return axios.put(`${apiBase}/${id}`, payload, { headers: { 'Accept': 'application/json' } });
}

export async function deleteFolder(id) {
    return axios.delete(`${apiBase}/${id}`, { headers: { 'Accept': 'application/json' } });
}
