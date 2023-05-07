/**
 * @category  sc
 * @package   Product_Test
 * @author    Ali Eltahan <info@alieltahan.com>
 */

import React, { PureComponent } from 'react';
import './AddProduct.style.scss';
import { Link } from 'react-router-dom';
import { BOOK, DVD, FURNITURE } from './AddProduct.config';

class AddProductComponent extends PureComponent {

    DVDAttributes = () => {
        const { attr, handleAttributes } = this.props;

        return <> <label htmlFor="size">Size (MB)</label>
            <input name='size'  value={attr.size} onChange={handleAttributes} type="number"
                   id="size" placeholder="Please, provide size"/></>;
    };

    bookAttributes = () => {
        const { attr, handleAttributes } = this.props;

        return <><label htmlFor="weight">Weight (KG)</label>
            <input name='weight' value={attr.weight} onChange={handleAttributes} type="number"
                   id="weight" placeholder='Please, provide weight'/></>;
    };

    furnitureAttributes = () => {
        const { handleAttributes, attr } = this.props;
        return <>
            <label htmlFor="height">Height (CM)</label>
            <input min="0" type="number" name='height' id="height" value={attr.height}
                   onChange={handleAttributes} placeholder='Please, provide height' required/>
            <label htmlFor="width">Width (CM)</label>
            <input min="0" type="number" name='width' id="width" value={attr.width}
                   onChange={handleAttributes} placeholder='Please, provide width' required/>
            <label htmlFor="length">Length(CM)</label>
            <input min="0" type="number" name='length' id="length" placeholder='Please, provide length' value={attr.length}
                   onChange={handleAttributes} required/></>;
    };

    MapProductAttr = {
        [DVD]: this.DVDAttributes,
        [BOOK]: this.bookAttributes,
        [FURNITURE]:this.furnitureAttributes,
    };

    productAttributes = (type) => {
        return this.MapProductAttr[type]();
    };

    renderHeader = () => {
        const { handleSubmit } = this.props;
        return <div className="AddProduct__header">
            <h1>Product Add</h1>
            <div className="btnWrapper">
                <button className="AddProduct__saveBtn" onClick={handleSubmit}>Save</button>
                <Link to="/">
                    <button className="AddProduct_cancelBtn" id="">Cancel</button>
                </Link>
            </div>
        </div>;
    };
    renderForm = () => {
        const { type, handleProductChange, handleChange, sku, name, price, handleSubmit } = this.props;

        return <form onSubmit={handleSubmit} method="POST" id="product_form" className="AddProduct__form">
            <label htmlFor="sku">SKU</label>
            <input onChange={handleChange} name='sku' id="sku" value={sku} type="text" required/>
            <label htmlFor="name">Name</label>
            <input onChange={handleChange} name='name' id="name" value={name} type="text" required/>
            <label htmlFor="price">Price ($)</label>
            <input min="0" onChange={handleChange} name='price' id="price" value={price} type="number" required/>
            <label htmlFor="productType">Type Switcher:</label>

            <select onChange={handleProductChange} value={type} name="type" id="productType"
                    required>
                <option label="Type Switcher" disabled={type}></option>
                <option id={DVD} value={DVD}>DVD</option>
                <option id={BOOK} value={BOOK}>Book</option>
                <option id={FURNITURE} value={FURNITURE}>Furniture</option>
            </select>

            {type && this.productAttributes(type)}

        </form>;
    };

    render () {
        return (
            <>
                {this.renderHeader()}
                {this.renderForm()}
            </>
        );
    }
}

export default AddProductComponent;
