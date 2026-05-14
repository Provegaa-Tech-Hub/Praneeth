import React from "react";

function StudentTable() {
  const students = [
    { id: 1, name: "Praneeth", course: "React" },
    { id: 2, name: "Ravi", course: "Java" },
    { id: 3, name: "Sita", course: "Python" }
  ];

  return (
    <div>
      <h2>Student List</h2>

      <table border="1" cellPadding="10">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Course</th>
          </tr>
        </thead>

        <tbody>
          {students.map((stu) => (
            <tr key={stu.id}>
              <td>{stu.id}</td>
              <td>{stu.name}</td>
              <td>{stu.course}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default StudentTable;