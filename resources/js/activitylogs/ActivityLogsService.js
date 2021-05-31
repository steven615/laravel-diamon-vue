import axios from 'axios';


const baseUrl = process.env.MIX_APP_URL + 'activitylogs';


export default class ActivityLogsService {

    getAll(filter) {
        const params = { filter };
        return axios.get(`${baseUrl}`, { params }).then((res) => res.data.data);
    }


    store(activitylog) {
        return axios.post(`${baseUrl}`, activitylog).then((res) => res.data.data);
    }


    edit(id) {
        return axios.get(`${baseUrl}/${id}/edit`).then((res) => res.data.data);
    }


    update(activitylog) {
        return axios.put(`${baseUrl}/${activitylog.id}`, cliente).then((res) => res.data.data);
    }


    delete(ids) {
        let id = ids.join();
        return axios.delete(`${baseUrl}/${id}`).then((res) => res.data.ids);
    }
}
