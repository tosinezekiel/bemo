import axiosInstance from "./api";

const setup = () => {
  axiosInstance.interceptors.response.use(
    (res) => {
      return res;
    },
    async (err) => {
      const originalConfig = err.config;

      if (err.response) {
        
        if (err.response.status === 401 && !originalConfig._retry) {
          originalConfig._retry = true;
          try {
            return axiosInstance(originalConfig);
          } catch (_error) {
            return Promise.reject(_error);
          }
        }
      }

      return Promise.reject(err);
    }
  );
};

export default setup;