import axios from 'axios';

axios.defaults.baseURL = process.env.MIX_APP_URL?.replace(/([^/])$/, '$1/');
axios.defaults.withCredentials = true;
