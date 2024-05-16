import React from 'react';
import { Outlet, Link } from "react-router-dom";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faShoppingBasket } from '@fortawesome/free-solid-svg-icons';

const Navbar = () => {
  return (
    <>
      <nav className="navbar navbar-expand-md navbar-light bg-white shadow py-1">
        <div className="container-fluid row">
          <Link to="/" className="navbar-brand col-2 p-0">
            <img src="./images/logo.svg" height="60" alt="Logo" />
          </Link>
          <div className="col-10 d-flex justify-content-end align-items-center">
            <Link to="/cart" className="nav-icon">
              <FontAwesomeIcon icon={faShoppingBasket} />
            </Link>
          </div>
        </div>
      </nav>
      <Outlet/>
    </>
    
  );
};

export default Navbar;