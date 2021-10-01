import axios from 'axios';

const API = axios.create({
    baseURL: 'https://evsu-organization-system-be.herokuapp.com/api'
});

export default API;