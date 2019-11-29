import React from 'react';
import {NavLink} from "react-router-dom";

function Nav(props) {
    return (
        <nav className="col-md-2 d-none d-md-block bg-light sidebar">
            <div className="sidebar-sticky">
                <ul className="nav flex-column">
                    <li className="nav-item">
                        <NavLink exact to="/" className="nav-link">
                            <i className="fa fa-dashboard"/> Dashboard
                        </NavLink>
                    </li>
                </ul>
                <ul className="nav flex-column">
                    <li className="nav-item">
                        <NavLink to="/repositories" className="nav-link">
                            <i className="fa fa-code-fork"/> Repositories
                        </NavLink>
                    </li>
                </ul>
            </div>
        </nav>
    );
}

export default Nav;
