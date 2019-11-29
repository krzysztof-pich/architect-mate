import React, {Component} from "react";
import "../login.css"

class LoginForm extends Component {
    state = {
        account: {
            email: '',
            password: ''
        }
    };

    handleSubmit = e => {
        //todo finish login
        e.preventDefault();
    };

    handleChange = ({currentTarget: input}) => {
        const account = {...this.state.account};
        account[input.name] = input.value;
        this.setState({account: account});
    };

    render() {
        const account = this.state.account;
        return (
            <div className="text-center">
                <form onSubmit={this.handleSubmit} className="form-signin">
                    <h1 className="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label htmlFor="email" className="sr-only">Email address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value={account.email}
                        onChange={this.handleChange}
                        className="form-control"
                        placeholder="Email address"
                        required
                        autoFocus
                    />
                    <label htmlFor="password" className="sr-only">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        value={account.password}
                        onChange={this.handleChange}
                        className="form-control"
                        placeholder="Password"
                        required
                    />

                    <button className="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </form>
            </div>
        );
    }


};

export default LoginForm;
