import { useNavigate, useLocation } from 'react-router-dom';

export const withRouter = (Component) => {
    return function (props) {
        const navigate = useNavigate();
        const location = useLocation();

        return (
            <Component
                navigate={navigate}
                location={location}
                {...props}
            />
        );
    };
};