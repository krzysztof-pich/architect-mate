import React, {Component} from "react";
import {Route, Switch} from "react-router-dom";
import Nav from "./components/nav";
import RepositoryNew from "./pages/repository/repositoryNew";
import RepositoryList from "./pages/repository/repositoryList";
import Home from "./pages/home";
import NotFound from "./pages/notFound";

class Main extends Component {
    render() {
        return (
            <React.Fragment>
                <nav className="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
                    <span className="navbar-brand col-sm-3 col-md-2 mr-0" >Architect Mate</span>
                </nav>
                <div className="container-fluid">
                    <div className="row">
                        <Nav />
                        <main role="main" className="col-md-9 ml-sm-auto col-lg-10 px-4">
                            <Switch>
                                <Route path="/repositories/new" component={RepositoryNew}/>
                                <Route path="/repositories" component={RepositoryList}/>
                                <Route exact path="/" component={Home}/>
                                <Route component={NotFound}/>
                            </Switch>
                        </main>
                    </div>
                </div>
            </React.Fragment>
        );
    }
}

export default Main;
