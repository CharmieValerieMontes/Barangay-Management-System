import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Dashboard = () => {
  const [visitor, setVisitor] = useState(null);

  useEffect(() => {
    const fetchVisitor = async () => {
      try {
        const response = await axios.get('http://localhost:5000/api/visitors/dashboard', {
          params: { visitorId: 'visitorId' }, // Replace with actual visitor ID
        });
        setVisitor(response.data);
      } catch (error) {
        console.error('Error:', error.message);
      }
    };

    fetchVisitor();
  }, []);

  return (
    <div>
      <h2>Dashboard</h2>
      {visitor && (
        <div>
          <p>Name: {visitor.name}</p>
          <p>Contact Number: {visitor.contactNumber}</p>
          <h3>Requests:</h3>
          <ul>
            {visitor.requests.map((request) => (
              <li key={request._id}>
                {request.type} for {request.purpose} - Status: {request.status}
              </li>
            ))}
          </ul>
        </div>
      )}
    </div>
  );
};

export default Dashboard;