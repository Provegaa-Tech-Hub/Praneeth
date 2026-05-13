import React, { useState } from "react";

const StudentForm = () => {
  const [form, setForm] = useState({
    name: "",
    email: "",
    course: ""
  });

  const handleChange = (e) => {
    setForm({
      ...form,
      [e.target.name]: e.target.value
    });
  };

  return (
    <div>
      <h2>Student Form</h2>

      <input name="name" placeholder="Name" onChange={handleChange} />
      <br /><br />

      <input name="email" placeholder="Email" onChange={handleChange} />
      <br /><br />

      <input name="course" placeholder="Course" onChange={handleChange} />
      <br /><br />

      <h3>Live Preview</h3>
      <p>Name: {form.name}</p>
      <p>Email: {form.email}</p>
      <p>Course: {form.course}</p>
    </div>
  );
};

export default StudentForm;