import React, {Component} from 'react'
import Toolbar from "../../components/view/toolbar";
import RepositoryForm from "../../components/repositoryForm";

class RepositoryNew extends Component {
    render() {
        return (
            <React.Fragment>
                <Toolbar title="Add new repository" />
                <RepositoryForm />
            </React.Fragment>
        );
    }
}

export default RepositoryNew;
