import React, { useState } from 'react';
import axios from 'axios';
const Registration = () => {
 const [name, setName] = useState('');
 const [contactNumber, setContactNumber] = useState('');
 const [password, setPassword] = useState('');
 const handleSubmit = async (e) => {
 e.preventDefault();
 await axios.post('http://localhost:5000/api/visitors/register', { name, contactNumber, password });
 alert('Registered successfully!');
 };
 return (
 <form onSubmit={handleSubmit}>
 <h2>Register</h2>
 <input type="text" placeholder="Name" value={name} onChange={(e) => setName(e.target.value)} 
required />
 <input type="text" placeholder="Contact Number" value={contactNumber} onChange={(e) => 
setContactNumber(e.target.value)} required />
 <input type="password" placeholder="Password" value={password} onChange={(e) => 
setPassword(e.target.value)} required />
 <button type="submit">Register</button>
 </form>
 );
};
export default Registration;