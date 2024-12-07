// DVD.js
import React from "react";

const DVD = ({ size, setSize }) => {
  return (
    <div>
      <label htmlFor="size">Size (MB):</label>
      <input
        type="number"
        id="size"
        value={size}
        onChange={(e) => setSize(e.target.value)}
        required
      />
    </div>
  );
};

export default DVD;
