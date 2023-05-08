/**
 * @category  sc
 * @package   Product_Test
 * @author    Ali Eltahan <info@alieltahan.com>
 */

import React, { PureComponent } from 'react';
import ProductsComponent from './Products.component';
import { BE_URI } from './Products.config';
import { withRouter } from '../HOC/Router/withRouter';
import axios from 'axios';
import toast from 'react-hot-toast';

class ProductsContainer extends PureComponent {
    state = {
        products: [],
        selectedProducts: { skus: [] }
    };

    componentDidMount () {
        axios.get(BE_URI).then((data) => this.setState({
            products: data.data.data
        })).catch(err => console.log(err.message));
    }

    handleProductSelect = (sku) => {
        let selectedProductsCopy = [...this.state.selectedProducts.skus];
        if (selectedProductsCopy.includes(sku)) {
            selectedProductsCopy = selectedProductsCopy.filter(val => val !== sku);
        } else {
            selectedProductsCopy.push(sku);
        }
        this.setState({
            ...this.state,
            selectedProducts: {
                skus: selectedProductsCopy
            }
        });
    };

    handleMassDelete = (e) => {
        e.preventDefault();
        const { skus } = this.state.selectedProducts;
        if(!skus.length) return;
        const productsCopy = [...this.state.products];
        const filteredProducts = productsCopy.filter(prod => !skus.includes(prod.sku));
        this.setState({
            ...this.state,
            products: filteredProducts
        });
        axios.delete(BE_URI, { data: JSON.stringify(this.state.selectedProducts) }).then(r => {
            if (r.data.status === 'success') {
                this.setState({
                    selectedProducts: {
                        skus: []
                    }
                });
                toast.success(r.data.data);
            } else {
                this.setState({
                    ...this.state,
                    products: productsCopy
                });
                toast.error(r.data.data);
            }
        }).catch(e => {
            toast.error(e.message);
            this.setState({
                ...this.state,
                products: productsCopy
            });
        });
    };
    containerProps = () => {
        const { products } = this.state;
        const { handleProductSelect, handleMassDelete } = this;
        return { products, handleProductSelect, handleMassDelete };
    };

    render () {
        return <ProductsComponent {...this.containerProps()} />;
    }
}

export default withRouter(ProductsContainer);
