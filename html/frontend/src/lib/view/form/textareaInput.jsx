import React, {Component} from 'react';
import PropTypes from 'prop-types';

class TextareaInput extends Component {
    render() {
        const {value, onChange, name, label, rows, error, ...rest} = this.props;

        let inputClass = 'form-control';
        if (error) {
            inputClass += ' is-invalid'
        }

        return (
            <div className="form-group">
                <label htmlFor={name}>{label}</label>
                <textarea
                    defaultValue={value}
                    onChange={onChange}
                    className={inputClass}
                    id={name}
                    name={name}
                    rows={rows ? rows : 3}
                    {...rest}
                >

                </textarea>
                {error && <div className="invalid-feedback">{error}</div>}
            </div>
        );
    }
}

TextareaInput.propTypes = {
    name: PropTypes.string.isRequired,
    label: PropTypes.string.isRequired,
    rows: PropTypes.number,
    errors: PropTypes.array
};

export default TextareaInput;
