import React from "react";
import {Link} from "react-router-dom";
import "../login.css"
import Form from "../lib/view/form/form";
import TextInput from "../lib/view/form/textInput";
import Joi from "joi-browser";
import http from "../lib/http";

class LoginForm extends Form {
    schema = Joi.object({
        email: Joi.string().email().required().label('Email'),
        password: Joi.string().required().label('Password'),

    });
    state = {
        data: {
            email: '',
            password: ''
        },
        errors: {}
    };

    doSubmit = async e => {
        const {data} = await http.post('login', this.state.data);
    };

    render() {
        const {data, errors} = this.state;
        return (
            <div className="text-center">
                <form onSubmit={this.handleSubmit} className="form-signin">
                    <h1 className="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <TextInput
                        value={data.email}
                        name="email"
                        label="Email"
                        error={errors.email}
                        onChange={this.handleChange}
                        autoFocus="autoFocus"
                    />
                    <TextInput
                        type="password"
                        value={data.password}
                        name="password"
                        label="Password"
                        error={errors.password}
                        onChange={this.handleChange}
                        autoFocus="autoFocus"
                    />
                    <button className="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </form>
                <Link to="/register" className="m-2">Register new user</Link>
            </div>
        );
    }
}

export default LoginForm;
