import React, { useState } from 'react';
import axios from 'axios';
import { useHistory } from 'react-router-dom';
const AdminLogin = () => {
 const [username, setUsername] = useState('');
 const [password, setPassword] = useState('');
 const history = useHistory();
 const handleSubmit = async (e) => {
 e.preventDefault();
 // Perform admin login here
 if (username === 'admin' && password === 'admin') {
 history.push('/admin-dashboard');
 } else {
 alert('Invalid credentials');
 }
 };
 return (
 <form onSubmit={handleSubmit}>
 <h2>Admin Login</h2>
 <input type="text" placeholder="Username" value={username} onChange={(e) => 
setUsername(e.target.value)} required />
 <input type="password" placeholder="Password" value={password} onChange={(e) => 
setPassword(e.target.value)} required />
 <button type="submit">Login</button>
 </form>
 );
};
export default AdminLogin;