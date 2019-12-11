import React, {Component} from 'react'
import {Route, Switch} from "react-router-dom";
import LoginForm from "./components/loginForm";
import RegisterForm from './components/registerForm';
import Main from './Main';


class App extends Component {
    render() {
        return (
            <Switch>
                <Route exact path="/login" component={LoginForm} />
                <Route exact path="/register" component={RegisterForm} />
                <Route path="/" component={Main} />
            </Switch>
        );
    }
}

export default App;
