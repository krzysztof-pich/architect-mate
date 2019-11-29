import React, {Component} from 'react';
import TextInput from "./view/form/textInput";
import TextareaInput from "./view/form/textareaInput";
import SelectInput from "./view/form/selectInput";
import Joi from "joi-browser";

class RepositoryForm extends Component {
    schema = Joi.object({
        name: Joi.string().required().label('Name'),
        description: Joi.string().allow('').label('Description'),
        path: Joi.string().required().label('Path'),
        type: Joi.string().required().label('Type')
    });
    state = {
        repository: {
            name: '',
            description: '',
            path: '',
            type: 'git'
        },
        errors: {}
    };

    handleChange = ({currentTarget: input}) => {
        const repository = {...this.state.repository};
        repository[input.name] = input.value;
        this.setState({repository});
    };

    handleSubmit = e => {
        this.validate();
        console.log(this.state.errors);
        e.preventDefault();
    };

    validate = () => {
        const result = this.schema.validate(this.state.repository, {abortEarly: false});
        if (!result.error) return null;

        const errors = {};
        for (let item of result.error.details) {
            console.log(item);
            errors[item.path[0]] = item.message;
        }

        this.setState({errors});
    };

    render() {
        const {repository, errors} = this.state;
        return (
            <form onSubmit={this.handleSubmit}>
                <TextInput
                    value={repository.name}
                    name="name"
                    label="Name"
                    placeholder="Repository name"
                    error={errors.name}
                    onChange={this.handleChange}
                />
                <TextareaInput
                    value={repository.description}
                    name="description"
                    label="Description"
                    error={errors.description}
                    onChange={this.handleChange}
                />
                <TextInput
                    value={repository.path}
                    name="path"
                    label="Path"
                    placeholder="Path to repository"
                    error={errors.path}
                    onChange={this.handleChange}
                />
                <SelectInput
                    value={repository.type}
                    name="type"
                    label="Type"
                    options={[{'value': 'git', 'label': 'Git'}]}
                    error={errors.type}
                    onChange={this.handleChange}
                />
                <button type="submit" className="btn btn-primary">Save</button>
            </form>
        );
    }
}

export default RepositoryForm;
