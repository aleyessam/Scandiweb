// import "./App.css";
import ProductList from "./Components/ProductList";
import Addproduct from "./Components/AddProduct";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<ProductList />} />
        <Route path="/addproduct" element={<Addproduct />} />
      </Routes>
    </Router>
  );
}

export default App;
