import React, {Component} from 'react'
import {Route, Switch} from "react-router-dom";
import LoginForm from "./components/loginForm";
import RegisterForm from './components/registerForm';
import Main from './Main';
import {ToastContainer} from "react-toastify";
import 'react-toastify/dist/ReactToastify.css';


class App extends Component {
    render() {
        return (
            <React.Fragment>
                <ToastContainer/>
                <Switch>
                    <Route exact path="/login" component={LoginForm} />
                    <Route exact path="/register" component={RegisterForm} />
                    <Route path="/" component={Main} />
                </Switch>
            </React.Fragment>
        );
    }
}

export default App;
