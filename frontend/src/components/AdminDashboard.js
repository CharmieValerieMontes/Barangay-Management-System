import React, { useState, useEffect } from 'react';
import axios from 'axios';
const AdminDashboard = () => {
 const [requests, setRequests] = useState([]);
 useEffect(() => {
 const fetchRequests = async () => {
 const response = await axios.get('http://localhost:5000/api/admin/requests');
 setRequests(response.data);
 };
 fetchRequests();
 }, []);
 return (
 <div>
 <h2>Admin Dashboard</h2>
 <h3>All Requests:</h3>
 <ul>
 {requests.map((request) => (
 <li key={request._id}>
 {request.type} for {request.purpose} by {request.visitorId.name} - Status: {request.status}
 {request.status === 'Pending' && (
 <button
 onClick={async () => {
 await axios.post('http://localhost:5000/api/admin/confirm-pickup', { requestId: request._id });
 setRequests((prevRequests) =>
 prevRequests.map((r) => (r._id === request._id ? { ...r, status: 'Ready for Pickup' } : r))
 );
 }}
 >
 Confirm Pickup
 </button>
 )}
 </li>
 ))}
 </ul>
 </div>
 );
};
export default AdminDashboard;