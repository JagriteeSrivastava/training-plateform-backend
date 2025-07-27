import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Login from './auth/Login';
import Register from './auth/Register';
import Dashboard from './Dashboard';

export default function App() {
  return (
    <Routes>
      <Route path="/" element={<Login />} />
      <Route path="/register" element={<Register />} />
      <Route path="/dashboard/*" element={<Dashboard />} />
    </Routes>
  );
}
