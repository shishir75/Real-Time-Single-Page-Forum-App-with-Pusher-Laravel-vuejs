import Token from "./Token";
import AppStorage from "./AppStorage";

class User {
    login(formData) {
        axios.post('/api/auth/login', formData)
            .then(res => this.responseAfterLogin(res))
            .catch(error => console.log(error.response.data));
    }

    responseAfterLogin(res) {
        const access_token = res.data.access_token;
        const username = res.data.user;
        if(Token.isValid(access_token)) {
            AppStorage.store(username, access_token);
        }
    }
}

export default User = new User();
