import React, { useState, useEffect } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import Table from "react-bootstrap/Table";

const ShowStudents = () => {
    const [students, setStudents] = useState([]);

    useEffect(() => {
        axios.get("/api/students").then((response) => {
            setStudents(response.data);
        });
    }, []);

    return (
        <div className="container">
            <h1>Students</h1>
            <Link to="/students/create" className="btn btn-primary mb-3">
                Add Student
            </Link>
            <Table striped bordered hover>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {students.map((student) => (
                    <tr key={student.id}>
                        <td>{student.id}</td>
                        <td>{student.name}</td>
                        <td>{student.email}</td>
                        <td>
                            <Link
                                to={`/students/${student.id}/edit`}
                                className="btn btn-secondary mr-2"
                            >
                                Edit
                            </Link>
                            <button className="btn btn-danger">
                                Delete
                            </button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </Table>
        </div>
    );
};

export default ShowStudents;
