/**
 * @category  sc
 * @package   Product_Test
 * @author    Ali Eltahan <info@alieltahan.com>
 */

export default class Validator {

    constructor () {
        const ERRORS = {};
        this.getErrors = () => {
            return ERRORS;
        };

        this.setErrors = (key, value) => {
            ERRORS[key] = value;
        };
    };

    /**
     * @param input Object
     * @returns null
     */
    execute (input) {
        for (const key in input) {
            if (key === 'attr') {
                return this.execute(input[key]);
            }
            this.#MAP[typeof (input[key])](key, input[key]);
        }
    }

    #validateNumber = (key, value) => {
        if (this.#notValidNumber(value)) {
            this.setErrors(key, `${key.toUpperCase()}: must be greater than Zero`);
        }
    };

    #validateString = (key, value) => {
        if (this.#isEmpty(value)) {
            this.setErrors(key, `${key.toUpperCase()}: can't be empty!`);
        }
    };

    #MAP = {
        number: (key, value) => this.#validateNumber(key, value),
        string: (key, value) => this.#validateString(key, value)
    };

    #notValidNumber (input) {
        return input <= 0;
    }

    #isEmpty (input) {
        return input.trim() === '';
    }

}
