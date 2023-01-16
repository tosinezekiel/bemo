import api from "./api";

const API_URL = 'http://bemo.test/api';

class Column {
    get() {
      return api.get(`${API_URL}/columns`)
        .then((response) => {
          return response.data;
        });
    }

    save(data) {
      return api.post(`${API_URL}/columns`, data)
        .then((response) => {
          return response.data;
        });
    }

    show(columnId) {
      let plans = [];
      return api.get(`${API_URL}/columns/${columnId}`)
        .then((response) => {
            return response.data;
        });
    }

    delete(columnId) {
      return api.delete(`${API_URL}/columns/${columnId}`)
        .then((response) => {
            return response.data;
        });
    }

    download() {
      return api.get(`${API_URL}/download`)
        .then((response) => {
            return response.data;
        });
    }
}

export default new Column();