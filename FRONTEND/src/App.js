import './App.css';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Cart from './pages/cart';
import Home from './pages/home';
import Navbar from './pages/navbar';
import Checkout from './pages/checkout';
import React, { useState, useEffect } from 'react';

const App = () => {

  const [cart, setCart] = useState({});

  useEffect(() => {
    const storedCart = localStorage.getItem('cart');
    if (storedCart) {
      setCart(JSON.parse(storedCart));
    }
  }, []);

  useEffect(() => {
    localStorage.setItem('cart', JSON.stringify(cart));
  }, [cart]);
  
  return (
    <>
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Navbar />}>
          <Route index element={<Home />} />
          <Route path="cart" element={<Cart />} />
          <Route path="/checkout" element={<Checkout />} />
        </Route>
      </Routes>
    </BrowserRouter>
    </>
  );
};

export default App;
