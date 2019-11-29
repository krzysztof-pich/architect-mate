import React, {Component} from 'react';
import PropTypes from 'prop-types';

class TextInput extends Component {
    render() {
        const {value, onChange, name, label, placeholder, error} = this.props;

        let inputClass = 'form-control';
        if (error) {
            inputClass += ' is-invalid'
        }

        return (
            <div className="form-group">
                <label htmlFor={name}>{label}</label>
                <input
                    type="text"
                    id={name}
                    name={name}
                    onChange={onChange}
                    value={value}
                    className={inputClass}
                    placeholder={placeholder}
                />
                {error && <div className="invalid-feedback">{error}</div>}
            </div>
        );
    }
}

TextInput.propTypes = {
    value: PropTypes.string.isRequired,
    name: PropTypes.string.isRequired,
    label: PropTypes.string.isRequired,
    placeholder: PropTypes.string.isRequired,
    errors: PropTypes.array
};

export default TextInput;
