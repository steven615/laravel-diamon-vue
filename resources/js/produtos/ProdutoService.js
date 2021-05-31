import axios from 'axios';


const baseUrl = process.env.MIX_APP_URL + 'produtos';


export default class ProdutoService {

    getAll(filter) {
        const params = { filter };
        return axios.get(`${baseUrl}`, { params }).then((res) => res.data.data);
    }


    store(product) {
        return axios.post(`${baseUrl}`, product).then((res) => res.data.data);
    }


    edit(id) {
        return axios.get(`${baseUrl}/${id}/edit`).then((res) => res.data.data);
    }


    update(product) {
        return axios.put(`${baseUrl}/${product.id}`, product).then((res) => res.data.data);
    }


    delete(ids) {
        let id = ids.join();
        return axios.delete(`${baseUrl}/${id}`).then((res) => res.data.ids);
    }
}
