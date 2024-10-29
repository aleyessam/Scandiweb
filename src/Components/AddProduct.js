import React, { useState } from "react";
import DVD from "./DVD";
import Book from "./Book";
import Furniture from "./Furniture";
import "./addproduct.css";
import { useNavigate } from "react-router-dom";

const Addproduct = () => {
  const [productType, setProductType] = useState("");
  const [sku, setSku] = useState("");
  const [name, setName] = useState("");
  const [price, setPrice] = useState("");
  const [size, setSize] = useState("");
  const [weight, setWeight] = useState("");
  const [height, setHeight] = useState("");
  const [width, setWidth] = useState("");
  const [length, setLength] = useState("");

  const [validationMessages, setValidationMessages] = useState({});
  const navigate = useNavigate();

  const productComponents = {
    DVD: DVD,
    Book: Book,
    Furniture: Furniture,
  };

  const handleProductTypeChange = (e) => {
    setProductType(e.target.value);
  };

  const handlecancel = () => {
    navigate("/");
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    const newValidationMessages = {};
    if (!sku) newValidationMessages.sku = "SKU is required !";
    if (!name) newValidationMessages.name = "Name is required !";
    if (!price) newValidationMessages.price = "Price is required !";
    if (!productType)
      newValidationMessages.productType = "Product Type is required !";

    if (productType === "DVD" && !size)
      newValidationMessages.size = "Size is required !";
    if (productType === "Book" && !weight)
      newValidationMessages.weight = "Weight is required !";
    if (productType === "Furniture") {
      if (!height) newValidationMessages.height = "Height is required !";
      if (!width) newValidationMessages.width = "Width is required !";
      if (!length) newValidationMessages.length = "Length is required !";
    }

    setValidationMessages(newValidationMessages);

    if (Object.keys(newValidationMessages).length === 0) {
      const productData = {
        sku,
        name,
        price,
        type: productType,
        size: productType === "DVD" ? size : null,
        weight: productType === "Book" ? weight : null,
        height: productType === "Furniture" ? height : null,
        width: productType === "Furniture" ? width : null,
        length: productType === "Furniture" ? length : null,
      };

      fetch("http://scandiwebtestt.000.pe/scandiweb-php/add_product.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(productData),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Failed to save product");
          }
          return response.json();
        })
        .then((data) => {
          console.log("Product saved successfully", data);
          navigate("/");
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    }
  };

  const ProductSpecificForm = productComponents[productType];

  return (
    <div className="prodadd">
      <h1>Product Add</h1>
      <button type="submit" className="save-button" onClick={handleSubmit}>
        SAVE
      </button>
      <button id="cancel-product-btn" onClick={handlecancel}>
        CANCEL
      </button>
      <div className="line"></div>
      <div className="form-container">
        <form id="product_form" onSubmit={handleSubmit}>
          <div>
            <label htmlFor="sku">SKU:</label>
            <input
              type="text"
              id="sku"
              name="sku"
              value={sku}
              onChange={(e) => setSku(e.target.value)}
              required
            />
            {validationMessages.sku && (
              <p className="error">{validationMessages.sku}</p>
            )}
          </div>

          <div>
            <label htmlFor="name">Name:</label>
            <input
              type="text"
              id="name"
              name="name"
              value={name}
              onChange={(e) => setName(e.target.value)}
              required
            />
            {validationMessages.name && (
              <p className="error">{validationMessages.name}</p>
            )}
          </div>

          <div>
            <label htmlFor="price">Price ($):</label>
            <input
              type="number"
              id="price"
              name="price"
              value={price}
              onChange={(e) => setPrice(e.target.value)}
              required
            />
            {validationMessages.price && (
              <p className="error">{validationMessages.price}</p>
            )}
          </div>

          <div>
            <label htmlFor="productType">Product Type:</label>
            <select
              id="productType"
              value={productType}
              onChange={handleProductTypeChange}
              required
            >
              <option value="">Select a type</option>
              <option id="DVD" value="DVD">
                DVD
              </option>
              <option id="Book" value="Book">
                Book
              </option>
              <option id="Furniture" value="Furniture">
                Furniture
              </option>
            </select>
            {validationMessages.productType && (
              <p className="error">{validationMessages.productType}</p>
            )}
          </div>

          {ProductSpecificForm && (
            <ProductSpecificForm
              size={size}
              setSize={setSize}
              weight={weight}
              setWeight={setWeight}
              height={height}
              setHeight={setHeight}
              width={width}
              setWidth={setWidth}
              length={length}
              setLength={setLength}
              validationMessages={validationMessages}
            />
          )}
        </form>
      </div>
      <div className="footer">
        <div className="footer-line"></div>
        <p>Scandiweb Test Assignment</p>
      </div>
    </div>
  );
};

export default Addproduct;
