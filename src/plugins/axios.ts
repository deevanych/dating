import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: '/api/v1',
  timeout: 5000,
});

export default axiosInstance;
