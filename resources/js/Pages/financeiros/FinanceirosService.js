import axios from 'axios';


const baseUrl = process.env.MIX_APP_URL + 'financeiros';


export default class FinanceirosService {

    getAll(filter) {
        const params = { filter };
        return axios.get(`${baseUrl}`, { params }).then((res) => res.data.data);
    }


    store(financeiro) {
        return axios.post(`${baseUrl}`, financeiro).then((res) => res.data.data);
    }


    edit(id) {
        return axios.get(`${baseUrl}/${id}/edit`).then((res) => res.data.data);
    }


    update(financeiro) {
        return axios.put(`${baseUrl}/${financeiro.id}`, cliente).then((res) => res.data.data);
    }


    delete(ids) {
        let id = ids.join();
        return axios.delete(`${baseUrl}/${id}`).then((res) => res.data.ids);
    }
}
