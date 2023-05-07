/**
 * @category  sc
 * @package   Product_Test
 * @author    Ali Eltahan <info@alieltahan.com>
 */

import React, { PureComponent } from 'react';
import './Footer.style.scss';

class FooterComponent extends PureComponent {

   render () {
        return (
            <div className='footer__wrapper'>
                <p>Scandiweb Test assignment</p>
            </div>
        );
    }
}

export default FooterComponent;
