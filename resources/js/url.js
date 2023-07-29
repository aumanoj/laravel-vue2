import axios from "axios";

let Url = axios.create({
  baseURL: "/api"
});

export default Url; 