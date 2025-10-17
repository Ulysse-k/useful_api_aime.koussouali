import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null,
    isAuthenticated: false,
    token: '',
    email: '',
  }),

  actions: {
    async register(userData) {
      try {
        const url = 'http://127.0.0.1:8000/api/register'; 
        const response = await axios.post(url, userData);
        this.email = userData.email;
        if (response.data.token) {
          this.token = response.data.token;
          console
        }
        return response.data;
      } catch (error) {
        throw error.response?.data || 'Registration error';
      }
    },

    async login(credentials) {
      try {
        const url = 'http://127.0.0.1:8000/api/login'; 
        const response = await axios.post(url, credentials); 
        if (response.data.token) {
          console.log("login success");
          this.user = response.data.user;
          this.isAuthenticated = true;
          this.token = response.data.token;

          //axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        }
        return response.data;
      } catch (error) {
        throw error.response?.data || 'Login error';
      }
    },

    logout() {
      this.user = null;
      this.isAuthenticated = false;
      this.token = '';
      this.email = '';
      //delete axios.defaults.headers.common['Authorization'];
    }
  },
});   