import axios from "axios"
import { BASE_URL } from "./constants"

axios.defaults.baseURL = BASE_URL

axios.interceptors.request.use(config => {
    if (localStorage.getItem("token")) {
        config.headers.authorization = localStorage.getItem("token")
    }

    console.log(config);
    if(config.method !== "get" && config.method !== "post") {

        config.url = config.url.includes("?") ? `${config.url}&_method=${config.method}` : `${config.url}?_method=${config.method}`

        config.method = "post"
    }

    return config

}, error => Promise.reject(error))

axios.interceptors.response.use(response => response, error => {
    if (error.response.status === 401) {
        localStorage.removeItem("token")
        window.location.href = "/login"
    }

    return Promise.reject(error)
})

export default axios