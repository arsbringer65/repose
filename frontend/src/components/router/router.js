import React from 'react';
import { BrowserRouter, Route, Routes } from "react-router-dom";

// Components
import Sidebar from "../Sidebar";
import Navbar from "../Navbar";

// Pages
import Calendar from "../../pages/Calendar";
import Dashboard from "../../pages/Dashboard";
import Leaves from "../../pages/Leaves";
import Encoding from '../../pages/Encoding';
import Login from '../../pages/Login';

const Router = () => {
    return (
      <div>
        <BrowserRouter>
          <Navbar />
          <Sidebar>
            <Routes>
              <Route path="/" element={<Dashboard />} />
              <Route path="/calendar" element={<Calendar />} />
              <Route path="/leaves" element={<Leaves />} />
              <Route path="/encoding" element={<Encoding />} />
            </Routes>
          </Sidebar>

          <Routes>
            <Route path="/admin/auth" element={<Login />} />
          </Routes>
        </BrowserRouter>
      </div>
    );
}

export default Router;
