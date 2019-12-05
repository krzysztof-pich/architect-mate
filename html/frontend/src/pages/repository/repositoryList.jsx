import React, {Component} from "react"
import _ from 'lodash';
import RepositoriesTable from "../../components/repositoriesTable";
import Toolbar from "../../components/view/toolbar";
import axios from "axios";

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

    async componentDidMount() {
        const response = await axios.get('http://localhost/vcs/repository');
        this.setState({repositories: response.data})
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
