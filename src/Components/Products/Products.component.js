/**
 * @category  sc
 * @package   Product_Test
 * @author    Ali Eltahan <info@alieltahan.com>
 */
import React, { PureComponent } from 'react';
import './Products.style.scss';
import { Link } from 'react-router-dom';

class ProductsComponent extends PureComponent {

    renderHeader = () => {
        return <div className="Products_header">
            <h1>Products List</h1>
            <div className="btnWrapper">
                <Link to="/add-product">
                    <button className="Products_addBtn">ADD</button>
                </Link>
                <button onClick={this.props.handleMassDelete} className="Products_massDeleteBtn" id="delete-product-btn">MASS DELETE</button>
            </div>
        </div>;
    };

    MapProductAttr = {
        'book': (attr) => `Weight: ${attr}`,
        'dvd': (attr) => `Size: ${attr}`,
        'furniture': (attr) => `Dimension: ${attr}`
    };
    renderProducts = () => {
        return <div className="Products__wrapper">
            {this.props?.products?.map(product =>
                <div className='Products__card' key={product.id}>
                    <input onChange={() =>this.props.handleProductSelect(product.sku)} className='delete-checkbox' type="checkbox" id={product.id}/>
                    <p>{product.sku}</p>
                    <p>{product.name}</p>
                    <p>{product.price} $</p>
                    <p>{this.MapProductAttr[product.type.toLowerCase()](product.attr)}</p>
                </div>
            )}
        </div>;
    };

    render () {
        return (
            <>
                {this.renderHeader()}
                {this.renderProducts()}
            </>
        );
    }
}

export default ProductsComponent;
