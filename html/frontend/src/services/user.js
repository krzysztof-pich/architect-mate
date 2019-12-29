import http from "../lib/http";
import config from "./../config";

const registerLink = 'user/register';

async function registerUser(email, password) {
    const result = await http.post(config.api + registerLink, {user: email, password: password});
}

export default {
    addUser: registerUser,
}
