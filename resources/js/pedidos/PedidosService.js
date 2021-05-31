import axios from 'axios';


const baseUrl = process.env.MIX_APP_URL + 'pedidos';


export default class PedidosService {

    downloadPdfNota() {
        console.log('downloadPdfNota');
        console.log(process.env.MIX_APP_URL2 + 'images/nota_exemplo.pdf');
        return axios.get(process.env.MIX_APP_URL2 + 'images/nota_exemplo.pdf', {
            responseType: 'blob', }).then((res) => res)
    }

    downloadPdfBoleto() {
        console.log(process.env.MIX_APP_URL2 + 'images/boleto_exemplo.pdf');
        return axios.get(process.env.MIX_APP_URL2 + 'images/boleto_exemplo.pdf', {
            responseType: 'blob', }).then((res) => res)
    }


    getPedido(id) {
        const params = { id };
        return axios.get(process.env.MIX_APP_URL + `pedidoeditar`, {params}).then((res) => res.data.data);
    }

    getCliente(codigo) {
        const params = { codigo };
        return axios.get(process.env.MIX_APP_URL + `pedidocliente`, {params}).then((res) => res.data.data);
    }

    editPedidoItem(id) {
        const params = { id };
        return axios.get(process.env.MIX_APP_URL + `pedidoitem`, { params } ).then((res) => res.data.data);
    }

    getClientes(){
        return axios.get(process.env.MIX_APP_URL + `pedidoclientes`).then((res) => res.data.data);
    }

    getFretes(){
        return axios.get(process.env.MIX_APP_URL + `pedidofretes`).then((res) => res.data.data);
    }

    getFrete(codigo){
        const params = { codigo };
        return axios.get(process.env.MIX_APP_URL + `pedidofrete`, { params }).then((res) => res.data.data);
    }

    getTipoMovs(){
        return axios.get(process.env.MIX_APP_URL + `pedidotipomovs`).then((res) => res.data.data);
    }

    getTipoMov(codigo){
        const params = { codigo };
        return axios.get(process.env.MIX_APP_URL + `pedidotipomov`, { params }).then((res) => res.data.data);
    }

    getCondPgtos(){
        return axios.get(process.env.MIX_APP_URL + `pedidocondpgtos`).then((res) => res.data.data);
    }

    getCondPgto(codigo){
        const params = { codigo };
        return axios.get(process.env.MIX_APP_URL + `pedidocondpgto`, { params }).then((res) => res.data.data);
    }

    getFormaPgtos(){
        return axios.get(process.env.MIX_APP_URL + `pedidoformapgtos`).then((res) => res.data.data);
    }

    getFormaPgto(codigo){
        const params = { codigo };
        return axios.get(process.env.MIX_APP_URL + `pedidoformapgto`, { params }).then((res) => res.data.data);
    }

    getProdutos(){
        return axios.get(process.env.MIX_APP_URL + `pedidoprodutos`).then((res) => res.data.data);
    }

    getProduto(codigo){
        const params = { codigo };
        return axios.get(process.env.MIX_APP_URL + `pedidoproduto`, { params }).then((res) => res.data.data);
    }

    getPedidoItem(id){
        const params = { id };
        return axios.get(process.env.MIX_APP_URL + `pedidoitem`, { params }).then((res) => res.data.data);
    }

    getItensPedido(pedido_id) {
        //console.log('123456');
        const params = { pedido_id };
        return axios.get(process.env.MIX_APP_URL + `pedidoitens`, { params }).then((res) => res.data.data);
    }

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


    storePedido(pedido) {
        return axios.post(`${baseUrl}`, pedido).then((res) => res.data.data);
    }

    updatePedido(pedido) {
        return axios.put(`${baseUrl}/${pedido.id}`, pedido).then((res) => res.data.data);
    }

    updatePedidoItem(pedidoitem) {
        return axios.put(process.env.MIX_APP_URL + `pedidoitem/${pedidoitem.id}`, pedidoitem).then((res) => res.data.data);
    }

    cancelaPedido(id) {
        const params = { id };
        return axios.get(process.env.MIX_APP_URL + `pedidocancela`, { params }).then((res) => res.data.data);
    }

    confirmaPedido(id) {
        const params = { id };
        return axios.get(process.env.MIX_APP_URL + `pedidoconfirma`, { params }).then((res) => res.data.data);
    }

    deletePedidoItem(id) {
        // console.log('id deletar');
        // console.log(id);
        const params = { id };
        return axios.get(process.env.MIX_APP_URL + `pedidoitemdelete`, { params }).then((res) => res.data.ids);
    }
}
