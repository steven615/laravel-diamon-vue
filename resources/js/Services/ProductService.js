import axios from 'axios';

// server base url for axios request
const baseUrl = 'product';

// Products service for products crud
export default class ProductService {
    /**
     * Get filtered products
     * 
     * @param {string} filter 
     * @returns promise
     */
    getAll(filter) {
        const params = filter ? { filter } : {};
        return axios.get(`${baseUrl}`, { params }).then((res) => res.data.data);
    }
    /**
     * Save new product
     * 
     * @param {object} product 
     * @returns promise
     */
    store(product) {
        return axios.post(`${baseUrl}`, product).then((res) => res.data.data);
    }

    /**
     * Get product for edit
     * 
     * @param {int|string} id product id
     * @returns 
     */
    edit(id) {
        return axios.get(`${baseUrl}/${id}/edit`).then((res) => res.data.data);
    }

    /**
     * Save editted product
     * 
     * @param {object} product 
     * @returns 
     */
    update(product) {
        return axios.put(`${baseUrl}/${product.id}`, product).then((res) => res.data.data);
    }

    /**
     * Delete products by ids array
     * 
     * @param {array} ids 
     * @returns 
     */
    delete(ids) {
        let id = ids.join();
        return axios.delete(`${baseUrl}/${id}`).then((res) => res.data.ids);
    }
}
