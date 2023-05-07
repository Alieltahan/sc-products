/**
 * @category  sc
 * @package   Product_Test
 * @author    Ali Eltahan <info@alieltahan.com>
 */

import React, { PureComponent } from 'react';
import AddProductComponent from './AddProduct.component';
import Validator from '../Validator/Validator';
import { BOOK, DVD, FURNITURE } from './AddProduct.config';
import toast from 'react-hot-toast';
import axios from 'axios';
import { withRouter } from '../HOC/Router/withRouter';
import { BE_URI} from '../Products/Products.config';

class AddProductContainer extends PureComponent {
    state = {
        sku: '',
        name: '',
        price: '',
        type: '',
        attr: {},
        errors: {}
    };

    containerProps = () => {
        const { sku, name, price, type, attr, errors } = this.state;
        const { handleChange, handleAttributes, handleSubmit, handleProductChange } = this;
        return {
            sku,
            name,
            price,
            type,
            attr,
            handleChange,
            handleAttributes,
            handleSubmit,
            handleProductChange,
            errors
        };
    };

    handleSubmit = (e) => {
        e.preventDefault();
        const {
            sku,
            name,
            price,
            type,
            attr,
        } = this.state;

        const submitData = {
            sku,
            name,
            price,
            type,
            attr,
        };
        const validate = new Validator();
        validate.execute(submitData);

        if (Object.keys(validate.getErrors()).length) {
            return this.setState({
                ...this.state,
                errors: validate.getErrors()
            }, () => {
                const { errors } = this.state;
                for (const error in errors) {
                    toast.error(`${errors[error]}`);
                }
            });
        }

        axios.post(BE_URI, JSON.stringify(submitData)).then(r => {
            if(r.data.status === 'success') {
                this.props.navigate('/');
            }else {
                r.data.data.forEach(err => toast.error(err));
            }
        })
            .catch(e => console.log(e.message));

    };

    handleChange = (e) => {
        let { name, value } = e.target;
        if (name === 'price') {
            value = +value;
        }
        this.setState({
            ...this.state,
            [name]: value
        });
    };

    handleAttributes = (e) => {
        const { name, value } = e.target;
        this.setState({
            ...this.state,
            attr: {
                ...this.state.attr,
                [name]: +value
            }
        });
    };

    handleProductChange = (e) => {
        const { value } = e.target;
        this.setState({
            ...this.state,
            type: value,
            attr: this.MapProductTypeAttributes[value]
        });
    };

    MapProductTypeAttributes = {
        [DVD]: {
            size: ''
        },
        [BOOK]: {
            weight: ''
        },
        [FURNITURE]: {
            height: '',
            width: '',
            length: ''
        }

    };

    render () {
        return <AddProductComponent {...this.containerProps()} />;
    }
}

export default withRouter(AddProductContainer);
