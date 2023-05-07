/**
 * @category  sc
 * @package   Product_Test
 * @author    Ali Eltahan <info@alieltahan.com>
 */

import React, { Component } from 'react';
import { Route, Routes } from 'react-router-dom';
import AddProduct from '../AddProduct/AddProduct.container';
import Products from '../Products/Products.container';
import Footer from '../Footer/Footer.component';
import './Main.styles.scss'

class MainComponent extends Component {
    render () {
        return (
            <div>
                <div className="main__wrapper">
                    <Routes>
                        <Route path="/add-product" element={<AddProduct/>}/>
                        <Route path="/" element={<Products/>}/>
                    </Routes>
                </div>
                <Footer/>
            </div>
        );
    }
}

export default MainComponent;