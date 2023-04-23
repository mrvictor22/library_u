import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";

const endpoint = "http://localhost:8000/api";

const ShowStudents = () => {
    const [students, setStudents] = useState([]);

    useEffect(() => {
        getAllStudents();
    }, []);

    const getAllStudents = async () => {
        try {
            const response = await axios.get(`${endpoint}/students`);
            setStudents(response.data);
        } catch (error) {
            console.error(error);
        }
    };

    const deleteStudent = async (id) => {
        try {
            await axios.delete(`${endpoint}/students/${id}`);
            getAllStudents();
        } catch (error) {
            console.error(error);
        }
    };

    return (
        <div>
            <div className="d-grid gap-2">
                <Link to="/create" className="btn btn-success btn-lg mt-2 mb-2 text-white">
                    Create
                </Link>
            </div>

            <table className="table table-striped">
                <thead className="bg-primary text-white">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {students.map((student) => (
                    <tr key={student.id}>
                        <td> {student.name} </td>
                        <td> {student.email} </td>
                        <td> {student.created_at} </td>
                        <td>
                            <Link to={`/edit/${student.id}`} className="btn btn-warning me-2">
                                Edit
                            </Link>
                            <button onClick={() => deleteStudent(student.id)} className="btn btn-danger">
                                Delete
                            </button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
};

export default ShowStudents;
