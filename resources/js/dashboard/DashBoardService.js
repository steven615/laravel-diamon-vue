import axios from 'axios';

const baseUrl = process.env.MIX_APP_URL + 'produtos';


export default class ProductService {
    getProductsSmall() {
        return axios.get('./products-small.json').then((res) => {

            console.log('data data');
            res.data.data
        });
    }


    getPedidosTop10() {
        return axios.get(`${process.env.MIX_APP_URL + 'pedidostop10'}`).then((res) =>
            //console.log('getProducts2');
            //console.log(res.data.data);
            res.data.data
        );
    }


    getProducts() {
        /*return axios.get('./products.json').then((res) => {

            console.log('getProducts');
            res.data.data;
        });*/

        return axios.get(`${baseUrl}`).then((res) =>

            //console.log('getProducts2');
            //console.log(res.data.data);
            res.data.data

        );
    }

    getProductsMixed() {
        return axios.get('./products-mixed.json').then((res) => res.data.data);
    }

    getProductsWithOrdersSmall() {
        return axios.get('./products-orders-small.json').then((res) => res.data.data);
    }
}
