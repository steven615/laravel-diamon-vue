import axios from 'axios';


const baseUrl = process.env.MIX_APP_URL + 'tipomovs';


export default class TipoMovsService {

    getAll(filter) {
        const params = { filter };
        return axios.get(`${baseUrl}`, { params }).then((res) => res.data.data);
    }


    store(cliente) {
        return axios.post(`${baseUrl}`, cliente).then((res) => res.data.data);
    }


    edit(id) {
        return axios.get(`${baseUrl}/${id}/edit`).then((res) => res.data.data);
    }


    update(cliente) {
        return axios.put(`${baseUrl}/${cliente.id}`, cliente).then((res) => res.data.data);
    }


    delete(ids) {
        let id = ids.join();
        return axios.delete(`${baseUrl}/${id}`).then((res) => res.data.ids);
    }
}
