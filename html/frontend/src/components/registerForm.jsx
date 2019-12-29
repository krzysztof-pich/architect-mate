import React from "react";
import Form from "../lib/view/form/form";
import Joi from "joi-browser";
import TextInput from "../lib/view/form/textInput";
import http from "../lib/http";
import notification from "../lib/notification";

class RegisterForm extends Form {
    schema = Joi.object({
        email: Joi.string().email().required().label('Email'),
        password: Joi.string().required().label('Password'),
        password_repeat: Joi.required().valid(Joi.ref('password')).options({
            language: {
                any: {
                    allowOnly: '!!Passwords do not match',
                }
            }
        })

    });
    state = {
        data: {
            email: '',
            password: '',
            password_repeat: ''
        },
        errors: {}
    };

    doSubmit = async () => {
        try {
            const {data} = await http.post('user', this.state.data);
        } catch (ex) {
            let errors = {...this.state.errors};
            errors.email = ex.response.data.error;
            this.setState({errors});
        }
    };

    render() {
        const {data, errors} = this.state;
        return (
            <div className="text-center">
                <form onSubmit={this.handleSubmit} className="form-signin">
                    <h1 className="h3 mb-3 font-weight-normal">Register new user</h1>
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
                    />
                    <TextInput
                        type="password"
                        value={data.password_repeat}
                        name="password_repeat"
                        label="Repeat password"
                        error={errors.password_repeat}
                        onChange={this.handleChange}
                    />
                    <button className="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                </form>
            </div>
        );
    }
}

export default RegisterForm;
