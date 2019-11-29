import React, {Component} from 'react';
import PropTypes from 'prop-types';

class SelectInput extends Component {
    render() {
        const {value, onChange, name, label, options, error} = this.props;

        let inputClass = 'form-control';
        if (error) {
            inputClass += ' is-invalid'
        }

        return (
            <div className="form-group">
                <label htmlFor={name}>{label}</label>
                <select name={name} value={value} onChange={onChange} className={inputClass} id={name}>
                    {options.map((option) => <option key={option.value} value={option.value}>{option.label}</option>)}
                </select>
                {error && <div className="invalid-feedback">{error}</div>}
            </div>
        );
    }
}

SelectInput.propTypes = {
    name: PropTypes.string.isRequired,
    label: PropTypes.string.isRequired,
    options: PropTypes.array.isRequired,
    errors: PropTypes.array
};

export default SelectInput;
