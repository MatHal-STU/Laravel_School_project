import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import Home from "./home";
import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

const Cart = () => {
  const [cart, setCart] = useState({});
  const navigate = useNavigate();
  useEffect(() => {
    const storedCart = JSON.parse(localStorage.getItem('cart')) || {};
    setCart(storedCart);
  }, []);

  const removeFromCart = (productId) => {
    const updatedCart = { ...cart };
    delete updatedCart[productId];
    setCart(updatedCart);
    localStorage.setItem('cart', JSON.stringify(updatedCart));
  };

  const totalPrice = Object.values(cart).reduce((total, item) => {
    return total + (item.price * item.quantity * (1 - item.discount / 100));
  }, 0);

  const handleCheckout = () => {
    // Send cart data to backend
    fetch('http://localhost:8000/api/chechkout/check-order', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(cart),
    })
      .then(response => {
        if (response.ok) {
          // Process successful response
          console.log('Order placed successfully!');
          // Navigate to Checkout page
          navigate('/checkout');
        } else {
          // Handle error response
          console.error('Error placing order:', response.statusText);
        }
      })
      .catch(error => {
        // Handle network errors
        console.error('Error placing order:', error);
      });
  };

  return (
    <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'flex-start', minHeight: '100vh', paddingTop: '50px' }}>
      <div style={{ textAlign: 'center' }}>
        <h1>Shopping Cart</h1>
        <div style={{ display: 'flex', justifyContent: 'center', marginTop: '10px' }}>
          <table style={{ width: '50%', marginRight: '20px' }}>
            <thead>
              <tr>
                <th>Picture</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Individual Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              {Object.values(cart).map(item => (
                <tr key={item.id}>
                  <td><img src={item.photo_path} alt={item.name} style={{ width: '50px', height: '50px' }} /></td>
                  <td>{item.name}</td>
                  <td>{item.quantity}</td>
                  <td>{(item.price * (1 - item.discount / 100)).toFixed(2)}</td>
                  <td><button onClick={() => removeFromCart(item.id)}>Remove</button></td>
                </tr>
              ))}
            </tbody>
          </table>
          <div style={{ width: '50%' }}>
            <h2>Total Price: {totalPrice.toFixed(2)} €</h2>
          </div>
          <div style={{ marginTop: '20px', textAlign: 'right' }}>
        <button onClick={handleCheckout}>Checkout</button>
      </div>
        </div>
      </div>
    </div>
  );
};
  
  export default Cart;