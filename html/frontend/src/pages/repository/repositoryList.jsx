import React, {Component} from "react"
import _ from 'lodash';
import {getRepositories} from "../../services/repository";
import RepositoriesTable from "../../components/repositoriesTable";
import {Link} from "react-router-dom";
import Toolbar from "../../components/view/toolbar";

class RepositoryList extends Component {
    state = {
        repositories: [],
        sortColumn: {
            path: 'id',
            order: 'asc'
        }
    };
    buttons = [
        {name: 'Add new repository', path: '/repositories/new'}
    ];

    componentDidMount() {
        this.setState({repositories: getRepositories()})
    }

    handleSort = sortColumn => {
        this.setState({sortColumn: sortColumn})
    };

    render() {
        const {sortColumn} = this.state;
        const repositories = _.orderBy(this.state.repositories, [sortColumn.path], [sortColumn.order]);
        return (
            <React.Fragment>
                <Toolbar title="Repositories" buttons={this.buttons}/>
                <RepositoriesTable
                    repositories={repositories}
                    sortColumn={sortColumn}
                    onSort={this.handleSort}
                />
            </React.Fragment>
        );
    }
}

export default RepositoryList;
