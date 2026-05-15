import React, { useState } from "react";
import "./Forms.css";

function StudentForm() {
  const [student, setStudent] = useState({
    name: "",
    email: "",
    course: ""
  });

  const handleChange = (e) => {
    setStudent({ ...student, [e.target.name]: e.target.value });
  };

  return (
    <div className="form-container">
      <h2>Student Registration</h2>

      <input
        type="text"
        name="name"
        placeholder="Enter Name"
        value={student.name}
        onChange={handleChange}
      />

      <input
        type="email"
        name="email"
        placeholder="Enter Email"
        value={student.email}
        onChange={handleChange}
      />

      <input
        type="text"
        name="course"
        placeholder="Enter Course"
        value={student.course}
        onChange={handleChange}
      />

      <div className="preview">
        <h3>Live Preview</h3>
        <p>Name: {student.name}</p>
        <p>Email: {student.email}</p>
        <p>Course: {student.course}</p>
      </div>
    </div>
  );
}

export default StudentForm;