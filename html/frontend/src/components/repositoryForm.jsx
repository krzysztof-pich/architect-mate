import React from 'react';
import Joi from "joi-browser";
import TextInput from "./view/form/textInput";
import TextareaInput from "./view/form/textareaInput";
import SelectInput from "./view/form/selectInput";
import Form from "./view/form/form";
import axios from "axios";

class RepositoryForm extends Form {
    schema = {
        name: Joi.string().required().label('Name'),
        description: Joi.string().allow('').label('Description'),
        path: Joi.string().required().label('Path'),
        type: Joi.string().required().label('Type')
    };
    state = {
        data: {
            name: '',
            description: '',
            path: '',
            type: 'git'
        },
        errors: {}
    };

    doSubmit = async () => {
        console.log(this.state.data);
        const { data: repository } = await axios.post('http://localhost/vcs/repository', {name: 'test'});
        console.log(repository);
    };

    render() {
        const {data, errors} = this.state;
        return (
            <form onSubmit={this.handleSubmit}>
                <TextInput
                    value={data.name}
                    name="name"
                    label="Name"
                    placeholder="Repository name"
                    error={errors.name}
                    onChange={this.handleChange}
                />
                <TextareaInput
                    value={data.description}
                    name="description"
                    label="Description"
                    error={errors.description}
                    onChange={this.handleChange}
                />
                <TextInput
                    value={data.path}
                    name="path"
                    label="Path"
                    placeholder="Path to repository"
                    error={errors.path}
                    onChange={this.handleChange}
                />
                <SelectInput
                    value={data.type}
                    name="type"
                    label="Type"
                    options={[{'value': 'git', 'label': 'Git'}]}
                    error={errors.type}
                    onChange={this.handleChange}
                />
                {this.renderButton('Save')}
            </form>
        );
    }
}

export default RepositoryForm;
