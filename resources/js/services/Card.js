import api from "./api";

const API_URL = 'http://bemo.test/api';

class Card {

    show(cardId) {
      return api.get(`${API_URL}/cards/${cardId}`)
        .then((response) => {
            return response.data;
        });
    }

    save(columnId, data) {
      return api.post(`${API_URL}/columns/${columnId}/cards`, data)
        .then((response) => {
          return response.data;
        });
    }

    update(columnId, cardId, data) {
      return api.put(`${API_URL}/columns/${columnId}/cards/${cardId}`, data)
        .then((response) => {
          return response.data;
        });
    }
}

export default new Card();