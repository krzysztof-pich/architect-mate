import React, {Component} from 'react';
import PropTypes from 'prop-types';
import _ from 'lodash';

class Pagination extends Component {
    render() {
        const pagesCount = Math.ceil(this.props.itemsCount / this.props.pageSize);
        if (pagesCount === 1) {
            return null;
        }

        const pages = _.range(1, pagesCount +1);
        return (
            <nav aria-label="Page navigation">
                <ul className="pagination">
                    { pages.map( (page) =>(
                        <li
                            key={page} onClick={() => this.props.onPageChange(page)}
                            className={page === this.props.currentPage ? 'page-item active' : 'page-item'}
                        >
                            <a className="page-link">{page}</a>
                        </li>
                    ))}
                </ul>
            </nav>
        );
    }
}

Pagination.propTypes = {
    onPageChange: PropTypes.func.isRequired,
    itemsCount: PropTypes.number.isRequired,
    pageSize: PropTypes.number.isRequired,
    currentPage: PropTypes.number.isRequired
};

export default Pagination;
