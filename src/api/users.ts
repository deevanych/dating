import axiosInstance from '@/plugins/axios';

export default {
  async get(id: number | null = null): Promise<string> {
    const url = id ? `users/${id}` : 'users';

    return axiosInstance.get(url);
  },

  post(data = []): void {
    console.log(data);
  },
};
