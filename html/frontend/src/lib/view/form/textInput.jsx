import React, {Component} from 'react';
import PropTypes from 'prop-types';

class TextInput extends Component {
    render() {
        const {name, label, error, type, ...rest} = this.props;

        let inputClass = 'form-control';
        if (error) {
            inputClass += ' is-invalid'
        }

        return (
            <div className="form-group">
                <label htmlFor={name}>{label}</label>
                <input
                    type={type ? type : 'text'}
                    id={name}
                    name={name}
                    className={inputClass}
                    {...rest}

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
    placeholder: PropTypes.string,
    errors: PropTypes.array
};

export default TextInput;
