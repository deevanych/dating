import axiosInstance from '@/plugins/axios';
import { UserType } from '@/models/User';

const endpoint = 'users';

export default {
  async index(offset = '', limit = ''): Promise<{ data: UserType[] }> {
    const url: URLSearchParams = new URLSearchParams();

    if (offset) url.append('offset', offset);
    if (limit) url.append('limit', limit);

    return axiosInstance.get([endpoint, url.toString()].join('?'));
  },

  async show(id: number | null = null): Promise<{ data: UserType }> {
    return axiosInstance.get([endpoint, id].join('/'));
  },
};
