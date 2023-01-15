import axios from "axios";

const instance = axios.create({
  baseURL: "http://bemo-task/api",
  headers: {
    "Content-Type": "application/json",
    "accept": "application/json"
  },
});

export default instance;