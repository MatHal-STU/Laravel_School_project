import React, { useState, useEffect} from 'react';
import { useNavigate } from 'react-router-dom';

function Checkout() {
  const [formData, setFormData] = useState({
    fname: '',
    lname: '',
    address: '',
    city: '',
    postal_code: '',
    pnumber: '',
    country: '',
    shipping: '',
    payment: '',
    total: 0,
  });
  const navigate = useNavigate();

  useEffect(() => {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    const total = Object.values(cart).reduce((acc, item) => {
      return acc + item.price * item.quantity * (1 - item.discount / 100);
    }, 0);
    setFormData((prevFormData) => ({
      ...prevFormData,
      total: total.toFixed(2),
    }));
  }, []);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await fetch('http://localhost:8000/api/chechkout/make-order', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
      });

      if (!response.ok) {
        throw new Error('Failed to create order');
      }

      const data = await response.json();
      if (data.success) {
        // Redirect to home page
        navigate('/');
        // Show success message
        window.alert('Order created successfully');
      }
    } catch (error) {
      console.error('Error:', error.message);
    }
  };

  return (
    <div >
      <h1>Checkout</h1>
      <div className="row justify-content-center">
      <form onSubmit={handleSubmit}>
        <div>
          <label>First Name:</label>
          <input type="text" name="fname" value={formData.fname} onChange={handleChange} />
        </div>
        <div>
          <label>Last Name:</label>
          <input type="text" name="lname" value={formData.lname} onChange={handleChange} />
        </div>
        <div>
          <label>Address:</label>
          <input type="text" name="address" value={formData.address} onChange={handleChange} />
        </div>
        <div>
          <label>City:</label>
          <input type="text" name="city" value={formData.city} onChange={handleChange} />
        </div>
        <div>
          <label>Postal Code:</label>
          <input type="text" name="postal_code" value={formData.postal_code} onChange={handleChange} />
        </div>
        <div>
          <label>Phone Number:</label>
          <input type="text" name="pnumber" value={formData.pnumber} onChange={handleChange} />
        </div>
        <div>
          <label>Country:</label>
          <input type="text" name="country" value={formData.country} onChange={handleChange} />
        </div>
        <div>
          <label>Shipping Option:</label>
          <div>
            <input type="radio" name="shipping" value="1" onChange={handleChange} />
            <label>UPS</label>
          </div>
          <div>
            <input type="radio" name="shipping" value="2" onChange={handleChange} />
            <label>Candlebox</label>
          </div>
        </div>
        <div>
          <label>Payment Option:</label>
          <div>
            <input type="radio" name="payment" value="1" onChange={handleChange} />
            <label>Card</label>
          </div>
          <div>
            <input type="radio" name="payment" value="2" onChange={handleChange} />
            <label>Paypal</label>
          </div>
        </div>
        <div>
          <label>Total:</label>
          <input type="text" name="total" value={formData.total} onChange={handleChange} disabled />
        </div>
        <button type="submit">Place Order</button>
      </form>
      </div>
    </div>
  );
};

export default Checkout;