import React, { useState } from 'react';
import axios from 'axios';
import { useHistory } from 'react-router-dom';
const Login = () => {
 const [contactNumber, setContactNumber] = useState('');
 const [password, setPassword] = useState('');
 const history = useHistory();
 const handleSubmit = async (e) => {
 e.preventDefault();
 const response = await axios.post('http://localhost:5000/api/visitors/login', { contactNumber, 
password });
 if (response.status === 200) {
 history.push('/dashboard');
 } else {
 alert('Login failed');
 }
 };
 return (
 <form onSubmit={handleSubmit}>
 <h2>Login</h2>
 <input type="text" placeholder="Contact Number" value={contactNumber} onChange={(e) => 
setContactNumber(e.target.value)} required />
 <input type="password" placeholder="Password" value={password} onChange={(e) => 
setPassword(e.target.value)} required />
 <button type="submit">Login</button>
 </form>
 );
};
export default Login;