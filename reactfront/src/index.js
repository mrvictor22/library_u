import React from 'react';
import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';

//importar nuestros componentes
import ShowStudents from './components/ShowStudents';
import App from './App';

function Index() {
    return (
        <div className="App">
            <BrowserRouter>
                <nav className="navbar navbar-expand-lg navbar-light bg-light">
                    <div className="container-fluid">
                        <Link className="navbar-brand" to="/">Library</Link>
                        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span className="navbar-toggler-icon"></span>
                        </button>
                        <div className="collapse navbar-collapse" id="navbarNav">
                            <ul className="navbar-nav">
                                <li className="nav-item">
                                    <Link className="nav-link" to="/">Home</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link" to="/students">Students</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link" to="/create">Create</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <Routes>
                    <Route path='/' element={<App />} />
                    <Route path='/students' element={<ShowStudents />} />
                    <Route path='/create' element={<h1>Create new student form</h1>} />
                </Routes>
            </BrowserRouter>
        </div>
    );
}

export default Index;
