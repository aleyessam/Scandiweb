import React, { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import "./productlist.css";

const ProductList = () => {
  const [products, setProducts] = useState([]);
  const [error, setError] = useState(null);
  const [checkedProducts, setCheckedProducts] = useState({});

  const navigate = useNavigate();

  const handleAddProduct = () => {
    navigate("/addproduct");
  };

  useEffect(() => {
    fetch("http://scandiwebtestt.000.pe/scandiweb-php/public/products.php")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Failed to fetch products");
        }
        return response.json();
      })
      .then((responseData) => {
        if (responseData.success && Array.isArray(responseData.data)) {
          setProducts(responseData.data);
        } else {
          throw new Error("Invalid data format received from server.");
        }
      })
      .catch((error) => setError(error.message));
  }, []);

  const handleCheckboxChange = (id) => {
    setCheckedProducts((prev) => ({
      ...prev,
      [id]: !prev[id],
    }));
  };

  const handleMassDelete = () => {
    const idsToDelete = Object.keys(checkedProducts).filter(
      (id) => checkedProducts[id]
    );

    fetch(
      "http://scandiwebtestt.000.pe/scandiweb-php/public/delete_products.php",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ ids: idsToDelete }),
      }
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Failed to delete products");
        }
        return response.json();
      })
      .then(() => {
        setProducts((prev) =>
          prev.filter((product) => !idsToDelete.includes(product.id.toString()))
        );
        setCheckedProducts({});
      })
      .catch((error) => setError(error.message));
  };

  if (error) {
    return <div className="error-message">Error: {error}</div>;
  }

  return (
    <div className="prodlist">
      <h1>Product List</h1>
      <button className="add-button" onClick={handleAddProduct}>
        ADD
      </button>
      <button id="delete-product-btn" onClick={handleMassDelete}>
        MASS DELETE
      </button>
      <div className="line"></div>
      <div className="product-container">
        {products.length === 0 ? (
          <div className="no-products">
            <p>No products found!</p>
          </div>
        ) : (
          products.map((product) => (
            <div key={product.id} className="product-card">
              <input
                type="checkbox"
                className="delete-checkbox"
                checked={!!checkedProducts[product.id]}
                onChange={() => handleCheckboxChange(product.id)}
              />
              <p>{product.sku}</p>
              <p>{product.name}</p>
              <p>{product.price} $</p>
              {product.attributes &&
                Object.entries(product.attributes).map(([key, value]) => (
                  <p key={key}>
                    {`${key.charAt(0).toUpperCase() + key.slice(1)}: ${value}`}
                  </p>
                ))}
            </div>
          ))
        )}
      </div>
      <div className="footer">
        <div className="footer-line"></div>
        <p>Scandiweb Test Assignment</p>
      </div>
    </div>
  );
};

export default ProductList;
