import '../App.css';
import React, { useState, useEffect } from 'react';
import Carousel from 'react-bootstrap/Carousel';


const Home = () => {

  const [candles, setCandles] = useState([]);
  const [cart, setCart] = useState({});
  
  useEffect(() => {
    fetch('http://localhost:8000/api/product/search/Candle')
      .then(response => response.json())
      .then(data => setCandles(data.products.data.slice(0, 3)))
      .catch(error => console.error('Error fetching candles:', error));
  }, []);

  const handleAddToCart = (candle) => {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    const updatedCart = {
      ...cart,
      [candle.id]: { ...candle, quantity: (cart[candle.id]?.quantity || 0) + 1 }
    };
    localStorage.setItem('cart', JSON.stringify(updatedCart));
  };

  useEffect(() => {
    fetch('http://localhost:8000/api/product/search/Candle')
      .then(response => response.json())
      .then(data => setCandles(data.products.data.slice(0, 3)))
      .catch(error => console.error('Error fetching candles:', error));
  }, []);

  return (
    <>
      <Carousel>
      <Carousel.Item>
        <img
          className="d-block w-100"
          src="./images/Carousel/1.png"
          alt="First slide"
        />
        <Carousel.Caption>
          <h5>Romance Collection</h5>
          <p>Set the mood for a romantic evening with this collection of sensual and alluring scents.
               From the sweet and spicy aroma of cinnamon to the warm and musky scent of sandalwood, 
               these candles are perfect for creating a cozy and intimate atmosphere.</p>
        </Carousel.Caption>
      </Carousel.Item>
      <Carousel.Item>
      <img
          className="d-block w-100"
          src="./images/Carousel/2.png"
          alt="First slide"
        />
        <Carousel.Caption>
          <h5>Spa Collection</h5>
          <p>Create a spa-like ambiance in your own home with this collection of calming
              and soothing scents. Each candle is formulated to promote relaxation and reduce 
              stress, making them perfect for unwinding after a long day.</p>
        </Carousel.Caption>
      </Carousel.Item>
      <Carousel.Item>
        <img
          className="d-block w-100"
          src="./images/Carousel/3.png"
          alt="First slide"
        />  
        <Carousel.Caption>
          <h5>Wanderlust Collection</h5>
          <p>
          This collection features scents inspired by different parts of the world, 
              allowing you to travel through your senses. Each candle is crafted to capture 
              the unique essence of a particular region.
          </p>
        </Carousel.Caption>
      </Carousel.Item>
    </Carousel>
    <div className="row">
      {candles.map(candle => (
        <div key={candle.id} className="col-xl-4 col-md-6 mb-4">
          <div className="card h-100">
            <img src={candle.photo_path} className="card-img-top" alt={candle.name} />
            <div className="card-body">
              <h5 className="card-title">{candle.name}</h5>
              <p className="card-text">Price: {(candle.price * (1 - candle.discount / 100)).toFixed(2)} €</p>
              <a href={`route('product_detail', { id: ${candle.id} })`} className="btn btn-primary mr-2">View Details</a>
              <button onClick={() => handleAddToCart(candle)} className="btn btn-success">Add to Cart</button>
            </div>
          </div>
        </div>
      ))}
    </div>
    </>
  );
};

export default Home;
