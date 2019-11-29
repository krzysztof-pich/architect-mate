import React, {Component} from 'react'
import {Route, Switch} from "react-router-dom";
import LoginForm from "./pages/loginForm";
import Main from './Main';


class App extends Component {
    render() {
        return (
            <Switch>
                <Route exact path="/login" component={LoginForm} />
                <Route path="/" component={Main} />
            </Switch>
        );
    }
}

export default App;
