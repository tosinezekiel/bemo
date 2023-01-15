import api from "./api";

const API_URL = 'http://bemo.test/api';

class Card {

    show(columnId, cardId) {
      let plans = [];
      return api.get(`${API_URL}/columns/${columnId}/cards/${cardId}`)
        .then((response) => {
            return response.data;
        });
    }

    delete(cardId) {
      return api.delete(`${API_URL}/columns/${cardId}`)
        .then((response) => {
            return response.data;
        });
    }
}

export default new Card();