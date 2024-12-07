// Furniture.js
import React from "react";

const Furniture = ({
  height,
  setHeight,
  width,
  setWidth,
  length,
  setLength,
}) => {
  return (
    <div>
      <label htmlFor="height">Height (cm):</label>
      <input
        type="number"
        id="height"
        name="height"
        value={height} // Link to the parent state
        onChange={(e) => setHeight(e.target.value)} // Update parent state on change
        required
      />

      <label htmlFor="width">Width (cm):</label>
      <input
        type="number"
        id="width"
        name="width"
        value={width} // Link to the parent state
        onChange={(e) => setWidth(e.target.value)} // Update parent state on change
        required
      />

      <label htmlFor="length">Length (cm):</label>
      <input
        type="number"
        id="length"
        name="length"
        value={length} // Link to the parent state
        onChange={(e) => setLength(e.target.value)} // Update parent state on change
        required
      />

      <p>
        <b>Please provide dimensions in HxWxL format</b>
      </p>
    </div>
  );
};

export default Furniture;
