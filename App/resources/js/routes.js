import React from 'react';
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Books from './Pages/Books';
import Example from "./components/Example";


export default () => {
    return(
        <Router>
            <Routes>
                <Route path="/" element={<Books />} />
            </Routes>
        </Router>
    );
}
