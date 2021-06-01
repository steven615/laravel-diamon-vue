import axios from "axios";

const baseUrl =  process.env.MIX_APP_URL + 'eventos';

export default class CalendarioService {


    getEvents() {

        const params = {  };
        return axios.get(`${baseUrl}`, { params }).then((res) => res.data.data);
    }
}
