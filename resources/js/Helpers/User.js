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
            window.location = '/forum'; // give e re-load on browser
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();

        if (storedToken) {
            return Token.isValid(storedToken) ? true : this.logout();
        }
        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    logout() {
        AppStorage.clear();
        window.location = '/forum'; // give e re-load on browser
    }

    name() {
        if(this.loggedIn()) {
            return AppStorage.getUser();
        }
    }

    id() {
        if(this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }
    }

    own(user_id) {
        return this.id() === user_id;
    }

    admin() {
        return this.id() === 18;
    }

}

export default User = new User();
