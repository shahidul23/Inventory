import Token from './token'
import AppStorage from './AppStorage'

class User{
    responseAfterLogin(res){
        const access_token = res.data.access_token
        const first_name = res.data.first_name
        const last_name = res.data.last_name
        if(Token.isValid(access_token)){
            AppStorage.store(access_token, first_name,last_name)

        }
    }
    hasToken(){
        const storeToken = localStorage.getItem('token')
        if(storeToken){
            return Token.isValid(storeToken) ? true : false
        }
        return false
    }
    loggedIn(){
        return this.hasToken()
    }

    logout(){
        AppStorage.clear()
        this.$router.push({name: 'login'})
    }
    name(){
        if(this.loggedIn()){
            return localStorage.getItem('user')
        }

    }
    id(){
        if(this.loggedIn()){
            const payload = Token.payload(localStorage.getItem('token'))
            return payload.sub
        }
        return false
    }

}

export default User = new User();