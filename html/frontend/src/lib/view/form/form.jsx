import React, {Component} from 'react';
import Joi from "joi-browser";


class Form extends Component {
    state = {
        data: {},
        errors: {}
    };

    validate = () => {
        const result = Joi.validate(this.state.data, this.schema, {abortEarly: false});
        if (!result.error) return null;

        const errors = {};
        for (let item of result.error.details) {
            errors[item.path[0]] = item.message;
        }

        return errors ? errors : null;
    };

    validateProperty = (name, data) => {
        const {error} = this.schema.validate(data, {abortEarly: false});

        if (!error) return null;

        for (let item of error.details) {
            if (item.path[0] === name) {
                return item.message;
            }
        }

        return null;
    };

    handleSubmit = e => {
        e.preventDefault();
        const errors = this.validate();
        this.setState({errors: errors || {}});
        if (errors) return;
        this.doSubmit();
    };

    handleChange = ({currentTarget: input}) => {
        const data = {...this.state.data};
        data[input.name] = input.value;

        const errors = { ...this.state.errors };
        const errorMessage = this.validateProperty(input.name, data);
        if (errorMessage) {
            errors[input.name] = errorMessage;
        } else {
            delete errors[input.name];
        }


        this.setState({data, errors});
    };

    renderButton(label) {
        return <button disabled={this.validate()} type="submit" className="btn btn-primary">{label}</button>
    }
}

export default Form;
