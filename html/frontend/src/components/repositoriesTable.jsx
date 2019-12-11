import React, {Component} from 'react';
import Table from '../lib/view/table/table';

class RepositoriesTable extends Component {
    columns = [
        {path: 'id', label: 'ID'},
        {path: 'name', label: 'Name'},
        {path: 'type', label: 'Type'}
    ];

    render() {
        const { repositories, onSort, sortColumn } = this.props;

        return (
            <Table
                columns={this.columns}
                sortColumn={sortColumn}
                data={repositories}
                onSort={onSort}
            />
        );
    }
}

export default RepositoriesTable;
