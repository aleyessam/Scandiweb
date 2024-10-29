// Book.js
import React from "react";

const Book = ({ weight, setWeight }) => {
  return (
    <div>
      <label htmlFor="weight">Weight (Kg):</label>
      <input
        type="number"
        id="weight"
        name="weight"
        value={weight} // Link to the parent state
        onChange={(e) => setWeight(e.target.value)} // Update parent state on change
        required
      />
      <p>
        <b>Please provide book weight in Kg format</b>
      </p>
    </div>
  );
};

export default Book;
