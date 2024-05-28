mport React, { useState } from 'react';
import axios from 'axios';
const RequestManagement = () => {
 const [visitorId, setVisitorId] = useState('');
 const [type, setType] = useState('');
 const [details, setDetails] = useState('');
 const [purpose, setPurpose] = useState('');
 const handleSubmit = async (e) => {
 e.preventDefault();
 const request = { visitorId, type, details, purpose };
 let url;
 switch (type) {
 case 'Barangay Certificate':
 url = 'http://localhost:5000/api/admin/create-certificate';
 break;
 case 'Barangay Indigency':
 url = 'http://localhost:5000/api/admin/create-indigency';
 break;
 case 'Barangay ID':
 url = 'http://localhost:5000/api/admin/create-id';
 break;
 default:
 alert('Invalid request type');
 return;
 }
 await axios.post(url, request);
 alert('Request created successfully!');
 };
 return (
 <form onSubmit={handleSubmit}>
 <h2>Request Management</h2>
 <input
 type="text"
 placeholder="Visitor ID"
 value={visitorId}
 onChange={(e) => setVisitorId(e.target.value)}
 required
 />
 <select value={type} onChange={(e) => setType(e.target.value)} required>
 <option value="">Select Request Type</option>
 <option value="Barangay Certificate">Barangay Certificate</option>
 <option value="Barangay Indigency">Barangay Indigency</option>
 <option value="Barangay ID">Barangay ID</option>
 </select>
 <textarea
 placeholder="Details"
 value={details}
 onChange={(e) => setDetails(e.target.value)}
 required
 />
 <select value={purpose} onChange={(e) => setPurpose(e.target.value)} required>
 <option value="">Select Purpose</option>
 <option value="School Purposes">School Purposes</option>
 <option value="Job Application">Job Application</option>
 <option value="Medical Purposes">Medical Purposes</option>
 <option value="Business Purposes">Business Purposes</option>
 </select>
 <button type="submit">Create Request</button>
 </form>
 );
};
export default RequestManagement;