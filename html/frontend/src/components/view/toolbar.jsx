import React, {Component} from "react"
import {Link} from "react-router-dom";

class Toolbar extends Component {
    render() {
        const {title, buttons} = this.props;
        let buttonsPart = "";
        if (buttons) {
            buttonsPart = (
                <div className="btn-toolbar mb-2 mb-md-0">
                    {buttons.map(button => (
                        <div key={button.path} className="btn-group mr-2">
                            <Link className="btn btn-sm btn-outline-primary" to={button.path}>
                                {button.name}
                            </Link>
                        </div>
                    ))}
                </div>
            );
        }
        return (
            <div
                className="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>{title}</h2>
                {buttonsPart}
            </div>
        );
    }
}

export default Toolbar;
