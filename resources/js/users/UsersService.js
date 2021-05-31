import axios from 'axios';


const baseUrl = process.env.MIX_APP_URL + 'users';


export default class UsersService {

    getAll(filter) {
        const params = { filter };
        return axios.get(`${baseUrl}`, { params }).then((res) => res.data.data);
    }


    store(user) {
        return axios.post(`${baseUrl}`, user).then((res) => res.data.data);
    }


    edit(id) {
        return axios.get(`${baseUrl}/${id}/edit`).then((res) => res.data.data);
    }


    update(user) {
        return axios.put(`${baseUrl}/${user.id}`, user).then((res) => res.data.data);
    }


    delete(ids) {
        let id = ids.join();
        return axios.delete(`${baseUrl}/${id}`).then((res) => res.data.ids);
    }
}
